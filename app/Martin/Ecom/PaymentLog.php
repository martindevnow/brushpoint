<?php


namespace Martin\Ecom;


use Illuminate\Support\Facades\Log;
use Martin\Core\Address;
use PayPal\Api\ShippingAddress;

class PaymentLog {

    protected $paymentRepo;
    protected $payerRepo;

    protected $dbPayment;
    protected $dbPayer;
    protected $dbAddress;
    protected $dbTransactions;

    protected $payPalPayment;
    protected $payPalAddress;

    protected $api;

    function __construct($api)
    {
        $this->api = $api;
        $this->paymentRepo = new \Martin\Ecom\Repositories\PaymentRepository();
        // TODO: Implement __construct() method.
    }


    public function fetchPaymentFromPayPal($paymentId)
    {
        $this->payPalPayment = \PayPal\Api\Payment::get($paymentId, $this->api);
        return $this->fetchFromDbByPayPalPayment();

    }


    public function isDuplicateEntry()
    {
        if (!$this->dbPayment)
            $this->fetchFromDbByPayPalPayment();
        if ($this->dbPayment->state == "created" || $this->dbPayment->state == "approved")
            return true;
        return false;
    }


    public function logPayment()
    {
        Log::info(print_r($this->payPalPayment,1));
    }


    public function fetchFromDbByPayPalPayment()
    {
        return $this->dbPayment = $this->paymentRepo->findOrCreateFromPayPal($this->payPalPayment);
    }


    public function updateState()
    {
        if (!$this->dbPayment)
            $this->fetchFromDbByPayPalPayment();
        $this->dbPayment->state = $this->payPalPayment->getState();
        $this->dbPayment->intent = $this->payPalPayment->getIntent();
        $this->dbPayment->save();


    }


    public function findOrCreatePayer()
    {
        if (! $this->dbPayment->payer)
        {
            $this->payerRepo = new \Martin\Ecom\Repositories\PayerRepository();
            Log::info('paypal payer: '. print_r($this->payPalPayment->getPayer(),1));

            $this->dbPayer = $this->payerRepo->findOrCreateFromPayPal($this->payPalPayment->getPayer());

            $this->dbPayer->payments()->save($this->dbPayment);
            Log::info("payer: ". print_r($this->dbPayer,1));

            return $this->dbPayer;
        }
        return $this->dbPayer = $this->dbPayment->payer;
    }


    public function findOrCreateAddress()
    {
        $addressesRegisteredToPayer = $this->getPayersAddresses();

        foreach($addressesRegisteredToPayer as $registeredAddress)
        {
            if ($this->addressesMatch($registeredAddress))
            {
                // is registered
                // can return this model, it matches the payer and the details.
                $this->dbAddress->payments()->save($registeredAddress);
                return $registeredAddress;
            }
        }


        // no addresses registered
        if ( ! $this->dbPayment->address)
            return $this->addNewAddress();

        // has addresses registered
        if ($this->addressesMatch($this->dbPayment->address))
            return $this->dbPayment->address;

        // no match found
        return $this->addNewAddress();
    }



    public function addNewAddress()
    {
        $addressRepo = new \Martin\Core\Repositories\AddressRepository();
        $this->dbAddress = $addressRepo->createFromPayPal($this->dbPayer, $this->payPalPayment);
        $this->dbPayer->addresses()->save($this->dbAddress);
        $this->dbAddress->payments()->save($this->dbPayment);

        return $this->dbAddress;
    }


    public function getPayersAddresses() {
        return $this->dbPayer->addresses;
    }


    public function addressesMatch(Address $address)
    {
        // TODO: Compare the Address (Eloquent Object) to the PayPal Address
        $this->payPalAddress = $this->payPalPayment->getPayer()->getPayerInfo()->getShippingAddress();

        if ($this->payPalAddress->getId() != $address->ppid)
            return false;

        if ($this->payPalAddress->getLine1() != $address->street_1)
            return false;

        if ($this->payPalAddress->getLine2() != $address->street_2)
            return false;

        if ($this->payPalAddress->getCity() != $address->city)
            return false;

        if ($this->payPalAddress->getPostalCode() != $address->postal_code)
            return false;

        if ($this->payPalAddress->getState() != $address->province)
            return false;

        if ($this->payPalAddress->getRecipientName() != $address->name)
            return false;
        return true;
    }


    public function createTransactions()
    {
        $transRepo = new \Martin\Ecom\Repositories\TransactionRepository();
        return $this->dbTransactions = $transRepo->createFromPaypal($this->payPalPayment, $this->dbPayment);
    }
}