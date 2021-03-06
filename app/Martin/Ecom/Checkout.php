<?php


namespace Martin\Ecom;


use Martin\Notifications\Flash;
use Martin\Products\CartRepository;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

// use PayPal\Api\Item;
// use Paypal\Api\ItemList;

class Checkout {

    protected $api;

    protected $payer;
    protected $details;
    protected $amount;
    protected $transaction;
    protected $payment;
    protected $redirectUrls;
    protected $itemList;

    protected $ecomPayment;

    protected $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new CartRepository();

        $this->api = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );

        $this->api->setConfig([
            'mode' => env('PAYPAL_ENV'),
            'http.ConnectionTimeOut'    => 30,
            'log.LogEnabled'            => true,
            'log.FileName'              => storage_path() . '/logs/paypal.log',
            'log.LogLevel'              => 'FINE',
        ]);
    }


    public function getApi()
    {
        return $this->api;
    }



    public function cartHasItemOutOfStock()
    {
        $cartItems = $this->cartRepository->getCartData();

        foreach($cartItems as $item)
        {
            $DBItem = \Martin\Products\Item::find($item['id']);

            if ($DBItem->on_hand == 0)
                return $item;
        }
        return false;
    }

    /**
     * Build the Payment for PayPal and store all relevant information to the DB
     *
     * @param CartRepository $cartRepository
     */
    public function newPayment(CartRepository $cartRepository)
    {
        $this->ecomPayment = new \Martin\Ecom\Payment;
        $this->ecomPayment->setUniqueId();

        $this->payer = new \PayPal\Api\Payer();
        $this->details = new \PayPal\Api\Details();
        $this->amount = new \PayPal\Api\Amount();
        $this->transaction = new \PayPal\Api\Transaction();
        $this->payment = new \PayPal\Api\Payment();
        $this->redirectUrls = new \PayPal\Api\RedirectUrls();
        $this->itemList = new \PayPal\Api\ItemList();


        $cartItems = $cartRepository->getCartData();
        foreach($cartItems as $item)
        {
            if ($item['quantity'] > 0)
            {
                $i = new Item();
                $i->setName($item['name'])
                    ->setPrice($item['price'])
                    ->setQuantity($item['quantity'])
                    ->setCurrency('USD')
                    ->setSku($item['sku']);
                $order[] = $i;
            }
        }
        $shippingCost = $this->calculateShippingCost($cartRepository);

        $this->payer->setPaymentMethod('paypal');

        $this->details->setShipping($shippingCost)
            ->setTax("0.00")
            ->setSubtotal($cartRepository->getCartTotal());

        $this->amount->setCurrency('USD')
            ->setTotal($cartRepository->getCartTotal() + $shippingCost)
            ->setDetails($this->details);

        $this->itemList->setItems($order);
        $this->transaction->setAmount($this->amount)
            ->setDescription("Your BrushPoint.com Purchase")
            ->setItemList($this->itemList);

        $this->redirectUrls->setReturnUrl(url('/').'/checkout/status')
            ->setCancelUrl(url('/'). '/checkout/cancel');

        $this->payment->setIntent('sale')
            ->setPayer($this->payer)
            ->setTransactions([$this->transaction])
            ->setRedirectUrls($this->redirectUrls);


        try
        {
            $this->payment->create($this->api);
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex)
        {
            $err_data = json_decode($ex->getData(), true);
            Flash::message("Exception: " . $ex->getMessage() . PHP_EOL . print_r($err_data, true));
            header('Location: '. url('/') .'/checkout/error');
            exit;
        }

        session()->put('paypal_payment_id', $this->payment->getId());

        $hash = md5($this->payment->getId());
        session()->put('paypal.hash', $hash);

        $this->ecomPayment->payment_id = $this->payment->getId();
        $this->ecomPayment->hash = $hash;
        $this->ecomPayment->save();
        // return $this->savePaymentToDB();
    }


    /**
     * Calculate the Shipping Cost (Move to Cart Repo????)
     *
     * @param CartRepository $cartRepository
     * @return string
     */
    public function calculateShippingCost(CartRepository $cartRepository)
    {
        /**
         * The is the shipping cost to the customer
         */
        return $cartRepository->getShippingAndHandling();
    }


    /**
     * Redirect the user to Paypal
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        $approvalUrl = $this->payment->getApprovalLink();

        if ($approvalUrl)
            return redirect()->away($approvalUrl);

        Flash::error('Unknown Error Occurred');
        return redirect()->route('payment_status')
            ->with('error', 'unknown error occurred');
    }


    public function getPayment($paymentId)
    {
        $payment = \PayPal\Api\Payment::get($paymentId, $this->api);
        return $payment;
    }


} 