<?php namespace App\Http\Controllers;

use App\Commands\ProcessPaymentStatusCommand;
use App\Events\ProductWasPurchased;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Martin\Ecom\Checkout;
use Martin\Ecom\PaymentLog;
use Martin\Products\CartRepository;
use PayPal\Api\Payment;


class CheckoutController extends Controller {

    protected $cartRepository;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }



    public function expressCheckout()
    {
        $checkout = new \Martin\Ecom\Checkout();

        $checkout->newPayment($this->cartRepository);

        return $checkout->redirect();
    }



    public function getPaymentStatus(Request $request)
    {
        dd('This function should not be called anymore. Once confirmed, delete this function.');


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


    public function status(Request $request, Checkout $checkout)
    {

        $payment = $this->dispatch(new ProcessPaymentStatusCommand($request->get('paymentId')));

        $paymentLog = new PaymentLog($checkout->getApi());

        $payment = $paymentLog->fetchPaymentFromPayPal($request->get('paymentId'));

        $response = Event::fire(new ProductWasPurchased($payment));

        session(['payment' => $payment]);

        return redirect('checkout/thankyou/'. $payment->id);

        // return true;
        // $paymentId = $request->get('paymentId');
        // $checkout = new Checkout();
        // $payment = $checkout->getPayment($paymentId);
        // dd($payment);



        // TODO: Show the thank you page with invoice number etc..
        // TODO: Make an email template to send to the customer to complete the transaction
        // TODO: Fire off an email to the user
    }

    public function thankyou($invoiceId, Checkout $checkout)
    {
        $payment = \Martin\Ecom\Payment::find($invoiceId);

        $paymentLog = new PaymentLog($checkout->getApi());

        $payment = $paymentLog->fetchPaymentFromPayPal($payment->payment_id);

        return view('checkout.thankyou')->withPayment($payment);
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
            "total": "7.47",
            "currency": "USD",
            "details": {
              "tax": "0.03",
              "shipping": "0.03"
            }
          },
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
