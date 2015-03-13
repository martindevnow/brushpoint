<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SetPayerInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Martin\Notifications\Flash;
use Martin\Products\CartRepository;
use Martin\Products\Product;
use Martin\Products\Item;
use Martin\Sales\Sale as MSale;;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item as PPItem;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PPConnectionException;
use PayPal\Rest\ApiContext;

use PayPal\Api\ExecutePayment;


class CartController extends Controller {

    protected $cartRepository;
    protected $_oauthCredential;
    protected $_accessToken;
    protected $_api_context;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;

        // setup PayPal Api Context
        $paypal_conf = Config::get('paypal');
        $this->_oauthCredential = new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']);
        $this->_api_context     = new ApiContext($this->_oauthCredential);
        $this->_api_context->setConfig($paypal_conf['settings']);
        //$this->_accessToken     = $this->_oauthCredential->getAccessToken(array('mode' => 'sandbox'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // show the contents of the cart
        return view('cart.index');

    }

    public function confirmAddToCart($id)
    {
        $product = Product::find($id);
        $cart = $this->cartRepository->getCartByProductId($id);

        $selections = array();
        if ($product->items()->count())
        {
            foreach($product->items()->get() as $item)
            {
                $selections[$item->id] = $item->name;
            }
        }

        return view('cart.confirmAdd')->with(['product' => $product,
                                                    'cart' => $cart,
                                                    'selections' => $selections]);

    }

    public function addToCartConfirmed($product_id, Request $request)
    {
        // $input = Input::all();
        $fields = $request->only(['item_id', 'quantity']);
        //  dd($fields);

        //fetch the item
        $item = Item::find($fields['item_id']);

        $success = $this->cartRepository->addToCart($item, $fields['quantity']);

        if ($success)
        {
            Flash::message('It has been added to your cart.');
            return redirect('/purchase/id-'. $product_id);
        }
        else
        {
            Flash::error('There was an error');
            return redirect()->back()->withInput();
        }


    }


    public function getPayerInfo()
    {
        // SAVE the cart to the DB (DONE AUTOMATICALLY BY unique_id)

        // DISPLAY a form to get name and address from user, save it, add that key to session

        // DISPLAY total and a confirm button

        return view('cart/address');


    }

    public function confirmPayerInfo(SetPayerInfoRequest $request)
    {
        // RECEIVE the form filled out by the user with name and address.

        // SAVE this info into the DB
        //      Associate the unique_id to it too.
        //      rare, but this id is save to cookies.
        //      IF we want, we can use that to fill in their address for them

        // PUT the id of the address into the session

        // DISPLAY the info received from the user

        // DISPLAY the items to be purchased

        // USE a hidden field with the total amount and some other reference to make sure
        //    no changes have been made to the cart between confirmation and check out etc..

        // DISPLAY a Checkout Now button -> CartCOntroller@checkout
    }

    public function checkout()
    {
        // RECEIVE confirmation

        // CONFIRM that the order is the same as what was pushed from the last page.

        // SAVE a payment object to the Database with all relevant information for tracking purposes
            // link to address, cart items, etc...

        // BUILD the paypal payment and payer objects etc according to paypal's API

        // SEND the user to paypal to complete their purchase

    }


    public function expressCheckout()
    {


        // NO ADDRESS ENTERING
        // Let PAYPAL handle everything.


        $sale = new MSale();

        $sale->setSessionId();


        /**
         * Set up the Payer
         */
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $cart = $this->cartRepository->getCartData();
        /**
         * Set up the products ordered
         */

        // $products = Product::all();

        // dd($cart);

        // $quantity_ordered = $cart;

        // $product_number = 0;
        $order_number = 0;
        // $total_cost = 0;

        //dd($quantity_ordered);
        // fetch the item selected from the DB and populate the fields
        foreach($cart as $item)
        {
            if ($item['quantity'] > 0)
            {
                $i = new PPItem();
                $i->setName($item['name'])
                    ->setPrice($item['price'])
                    ->setQuantity($item['quantity'])
                    ->setCurrency('USD');
                $order[$order_number] = $i;
                $order_number ++;
            }


            /*
            if (isset($quantity_ordered[$product['id']])) {
                $order[$order_number] = new Item();
                $order[$order_number]->setName($product['name'])
                    ->setCurrency('USD')
                    ->setPrice($product['price'])
                    ->setQuantity($quantity_ordered[$product['id']]);
                $total_cost = $total_cost + $quantity_ordered[$product['id']] * $product['price'];
                $order_number++;
            }*/
        }

        $total_cost = $this->cartRepository->getCartTotal();
        $sale->setSubtotalCost($total_cost);



        /**
         * Build the List
         */
        $item_list = new ItemList();
        $item_list->setItems($order);




        $shipping_cost = $this->cartRepository->calculateShipping();
        $sale->setShippingCost($shipping_cost);


        /**
         * Set the details of the transaction
         */
        $details = new Details();
        $details->setShipping($shipping_cost)
            ->setTax('0.00')
            ->setSubtotal($total_cost);

        $sale->setTaxCost(0);



        /**
         * Set the total amount (subtotal + shipping and tax)
         */
        $total_cost += $shipping_cost;
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total_cost)
            ->setDetails($details);
        $sale->setTotalCost($total_cost);


        /**
         * Build the transaction
         */
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your BrushPoint Innovations Order')
            ->setInvoiceNumber(md5(time()));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('payment_status'))
            ->setCancelUrl(route('payment_status'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        // echo '<pre>';print_r($payment);echo '</pre>';exit;

        // dd ($this->_api_context);

        try {
            $payment->create($this->_api_context);
        } catch(PPConnectionException $ex) {
            //if (\Config::get('app.debug')) {
            $err_data = json_decode($ex->getData(), true);
            echo "Exception: " . $ex->getMessage() . PHP_EOL . print_r($err_data, true);

            exit;
            //} else {
            die('Some error occurred, sorry!');
            // }
        }

        foreach ($payment->getLinks() as $link)
        {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        session()->put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)){
            return redirect()->away($redirect_url);

        }

        return redirect()->route('original.route')
            ->with('error', 'unknown error occurred');
    }

    public function getPaymentStatus(Request $request)
    {
        // get the payment ID before session clear
        $payment_id = session()->get('paypal_payment_id');

        //clear session ID
        session()->forget('paypal_payment_id');

        if (! $request->get('PayerID') || !$request->get('token'))
        {
            return redirect()->route('original.route')
                ->with('error', 'Payment Failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        // echo '<pre>';print_r($result);echo '</pre>';exit;


        DB::table('dump')->insert([
                'dumped_text' => serialize($result)
            ]
        );


        if ($result->getState() == 'approved') {

            // do the logging of the payment
            // create invoice
            // add to the database // or log it as paid
            // look up code for integrating php paypal rest api with mysql, mvc, or objects
            // there must be someone who wanted to track it by buyer, or transaction, or somehting
            // i might have to really read the documentation
            // hopefully it is broken up by "object" in some sence. liek the variables are dependant on each criteria.
            Flash::message("Thank you for your purchase!");
            return redirect()->route('original.route')
                ->with('success', 'Payment success');
        }
        return redirect()->route('original.route')
            ->with('error', 'Payment Failed');


    }


    public function completed()
    {
        // DISPLAY a message to thank the user for their purchase
        // DISPLAY a receipt number for the user

    }

    public function cancelled()
    {
        // DISPLAY a message to the user that the payment could not be completed
        // DISPLAY any error messages from PayPal
    }

    public function IPN()
    {
        // THIS METHOD WILL NOT EXIST

        // TODO: build the IPN notification file so that paypal can notify us when a payment haas been processed correctly.
        // this will update the purchase/payment object generated in the checkout method
        // from there, generate an invoice and send it to the user in HTML format to their email address

        // also, generate an invoice/receipt in PDF form to send to BrushPoint for printing.

        // TODO: add to one of the methods above a way to calculate the shipping cost based on several criteria
            // such as weight, number of items, thickness of some items etc.

        /*
         * if ($cart->has(FLOSSERS)
         *      $smallPacket = true;
         *
         * if ($cart->numberOfItems() > 4
         *      $smallPacket = true;
         *
         * if ($smallPacket){
         *      switch($orcerWeight):
         *          case (,...)
         *
         *      break;
         *
         * }
         *
         *
         */
    }

    public function paymentTest()
    {
        $addr = new Address();
        $addr->setLine1('52 N Main ST');
        $addr->setCity('Johnstown');
        $addr->setCountry_code('US');
        $addr->setPostal_code('43210');
        $addr->setState('OH');

        $payer = new Payer();
        $payer->setPayment_method('credit_card');
        $payer->setFunding_instruments(array($fi));

        $amountDetails = new AmountDetails();
        $amountDetails->setSubtotal('7.41');
        $amountDetails->setTax('0.03');
        $amountDetails->setShipping('0.03');

        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal('7.47');
        $amount->setDetails($amountDetails);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('This is the payment transaction description.');

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        $payment->create($this->_api_context);
    }


    public function paymentTextExecute()
    {

        session_start();
        if(isset($_GET['success']) && $_GET['success'] == 'true') {


            // payment id was previously stored in session in
            // create.php
            $paymentId_session = $_SESSION['paymentId'];
            // if you used database to store product id and payment id
            // use below mysqli code to fetch payment_id from database

            /*

               #### GET PAYMENT ID ###

               //Open a new connection to the MySQL server
               $mysqli = new mysqli('host','username','password','database_name');

               //Output any connection error
               if ($mysqli->connect_error) {
                   die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
               }

               $payment_info = $mysqli->query("SELECT * FROM payment_records
                                             WHERE payment_id = '".$mysqli->mysqli_real_escape_string($paymentId_session)."'");

               if(mysqli_num_rows($payment_info) > 0){
                   $row = mysqli_fetch_assoc($payment_info);

                   // Assign values fetched from database
                   $productid = $row['product_id'];
                   $paymentId = $row['payment_id'];


               }else{
                   die('Error : ('. $mysqli->errno .') '. $mysqli->error);
               }

               if( $paymentId != $paymentId_session){
                   die("Payment id not verified");

                   // only use below lines for testing, comment them in live website
                   // echo "Payment id from session:" . $paymentId_session;
                   // echo "Payment id from database:" . $paymentId ;
               }

           */


            // Get the payment Object by passing paymentId
            $payment = Payment::get($paymentId, $apiContext);

            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            //Execute the payment
            // (See bootstrap.php for more on `ApiContext`)
            $result = $payment->execute($execution, $apiContext);

            echo "<html><body><pre>";
            print_r($result);


        } else {
            echo "User cancelled payment.";
        }
    }
}
