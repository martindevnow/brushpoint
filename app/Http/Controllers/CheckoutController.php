<?php namespace App\Http\Controllers;

use App\Commands\ProcessPaymentStatusCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Martin\Ecom\Checkout;
use Martin\Products\CartRepository;
use PayPal\Api\Payment;


class CheckoutController extends Controller {




    protected $cartRepository;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
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

        $checkout = new \Martin\Ecom\Checkout();

        $checkout->newPayment($this->cartRepository);

        return $checkout->redirect();


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
            return redirect()->route('payment_status')
                ->with('success', 'Payment success');
        }

        Flash::error('Unknown Error Occurred');

        return redirect()->route('payment_status')
            ->with('error', 'Payment Failed');


    }


    public function status(Request $request)
    {

        // dd($request->all());
        $this->dispatch(new ProcessPaymentStatusCommand($request->get('paymentId')));

        // return true;




        // $paymentId = $request->get('paymentId');


        // $checkout = new Checkout();
        // $payment = $checkout->getPayment($paymentId);

        // dd($payment);
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
}


/*


Payment {#316 ▼
  -_propMap: array:8 [▼
    "id" => "PAY-0ED230570R273814BKUDA5OI"
    "create_time" => "2015-03-15T22:59:05Z"
    "update_time" => "2015-03-15T22:59:05Z"
    "state" => "created"
    "intent" => "sale"
    "payer" => Payer {#323 ▼
      -_propMap: array:3 [▼
        "payment_method" => "paypal"
        "status" => "VERIFIED"
        "payer_info" => PayerInfo {#318 ▼
          -_propMap: array:5 [▼
            "email" => "benjaminm+test@brushpoint.com"
            "first_name" => "Ben"
            "last_name" => "Martin"
            "payer_id" => "P69HMJQPKX258"
            "shipping_address" => ShippingAddress {#320 ▼
              -_propMap: array:6 [▼
                "line1" => "1 Main St"
                "city" => "San Jose"
                "state" => "CA"
                "postal_code" => "95131"
                "country_code" => "US"
                "recipient_name" => "Ben Martin"
              ]
            }
          ]
        }
      ]
    }
    "transactions" => array:1 [▼
      0 => Transaction {#322 ▼
        -_propMap: array:4 [▼
          "amount" => Amount {#326 ▶}
          "description" => "Your BrushPoint.com Purchase"
          "item_list" => ItemList {#330 ▼
            -_propMap: array:1 [▼
              "items" => array:1 [▼
                0 => Item {#332 ▼
                  -_propMap: array:4 [▼
                    "name" => "Dual Motion Replacement Heads - (4 Pack) [Soft]"
                    "price" => "5.50"
                    "currency" => "USD"
                    "quantity" => "1"
                  ]
                }
              ]
            ]
          }
          "related_resources" => []
        ]
      }
    ]
    "links" => array:3 [▼
      0 => Links {#335 ▼
        -_propMap: array:3 [▼
          "href" => "https://api.sandbox.paypal.com/v1/payments/payment/PAY-0ED230570R273814BKUDA5OI"
          "rel" => "self"
          "method" => "GET"
        ]
      }
      1 => Links {#336 ▼
        -_propMap: array:3 [▼
          "href" => "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-9NX58250UB561911P"
          "rel" => "approval_url"
          "method" => "REDIRECT"
        ]
      }
      2 => Links {#337 ▼
        -_propMap: array:3 [▼
          "href" => "https://api.sandbox.paypal.com/v1/payments/payment/PAY-0ED230570R273814BKUDA5OI/execute"
          "rel" => "execute"
          "method" => "POST"
        ]
      }
    ]
  ]
}


 */
