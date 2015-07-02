<?php namespace App\Http\Controllers;

use App\Commands\ProcessPaymentStatusCommand;
use App\Events\ProductWasPurchased;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Martin\Ecom\Checkout;
use Martin\Ecom\PaymentLog;
use Martin\Notifications\Flash;
use Martin\Products\CartRepository;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


class CheckoutController extends Controller {

    protected $cartRepository;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }



    public function expressCheckout()
    {
        if (!session('country'))
        {
            Flash::error('You must select your coutry to proceed.');
            return redirect()->back();
        }

        $checkout = new \Martin\Ecom\Checkout();

        if ( $outOfStockItem = $checkout->cartHasItemOutOfStock())
        {
            Flash::error($outOfStockItem->name . ' isout of stock. Please remove it from your cart.');
            return redirect()->back();
        }

        $checkout->newPayment($this->cartRepository);

        return $checkout->redirect();
    }





    public function status(Request $request, Checkout $checkout)
    {

        $payment = $this->dispatch(new ProcessPaymentStatusCommand($request->get('paymentId')));

        $paymentLog = new PaymentLog($checkout->getApi());

        $DBPayment = $paymentLog->fetchPaymentFromPayPal($request->get('paymentId'));
        $PPPayment = $paymentLog->payPalPayment;

        // $DBPayment = $paymentLog->fetchFromDbByPayPalPayment();

        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        $result = $PPPayment->execute($execution, $paymentLog->api);

        Log::info("Payment Executed: " . print_r($result, true));

        $response = Event::fire(new ProductWasPurchased($DBPayment));

        session(['payment' => $payment]);

        return redirect('checkout/thankyou/'. $DBPayment->id);
    }



    public function thankyou($invoiceId, Checkout $checkout)
    {
        $payment = \Martin\Ecom\Payment::findOrFail($invoiceId);

        $paymentLog = new PaymentLog($checkout->getApi());

        $payment = $paymentLog->fetchPaymentFromPayPal($payment->payment_id);

        if ( ! $payment )
            return redirect('/');

        return view('checkout.thankyou')->withPayment($payment);
    }

    public function error()
    {
        return view('errors.paypal');
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
