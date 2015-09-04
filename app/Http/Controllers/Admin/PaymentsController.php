<?php namespace App\Http\Controllers\Admin;

use App\Events\PackageWasShipped;
use \App\Handlers\Events\GenerateInvoicePdf;
use \App\Http\Requests;
use \App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\Repositories\PaymentRepository;
use Martin\Notifications\Flash;
use Martin\Products\Item;
use Martin\Products\Product;
use Martin\Products\ProductRepository;
use mikehaertl\wkhtmlto\Pdf;

class PaymentsController extends Controller {

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    function __construct(PaymentRepository $paymentRepository)
    {
        $this->middleware('auth', ['except' => 'invoiceHtml']);
        $this->middleware('local', ['only' => 'invoiceHtml']);

        $this->paymentRepository = $paymentRepository;
    }


    public function index()
    {
        // show all payments - recent at top

        $payments = $this->paymentRepository->getRecentPayments();

        $this->layout->content =  view('admin.payments.index')
            ->with(compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::find($id);

        // dd($payment->address);

        $this->layout->content = view('admin.payments.show')
            ->with(compact('payment'));

    }

    public function invoice($paymentId)
    {
        $file = $this->paymentRepository->getInvoicePath($paymentId);
        if (file_exists($file))
            return response()->download($file);

        //otherwise, generate the invoice

        // TODO: Make a command to do this action
        $this->paymentRepository->generateInvoice($paymentId);
        return "Generating ... ";

    }

    /**
     * Display the invoice in HTML
     *
     * @param $id
     * @return $this
     */
    public function invoiceHtml($id)
    {
        $data = $this->paymentRepository->generateInvoiceData($id);
        // dd($data['transactions']);

        $view =  view('admin.invoices.html_v1')->with($data);
        return $view;
    }



    public function ajaxPatch($paymentId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $payment = Payment::find($paymentId);

        if ($field == "shipped")
        {
            $payment->toggleShipped($value);
            event(new PackageWasShipped($payment));
        }
        else
            $payment->$field = $value;
        $payment->save();
        return "Passed";
    }





    public function filtered(Request $request)
    {
        $payments = new Payment();
        $attributes = $payments->getFillable();

        foreach ($request->all() as $field => $value)
        {
            if (in_array($field, $attributes))
                $payments = $payments->where($field, '=', $value);
        }
        $payments = $payments->orderBy('created_at', 'desc');
        $payments = $payments->paginate(25);
        $payments->appends($request->all());

        return $this->layout->content = view('admin.payments.index')->with(compact('payments'));
    }



    public function create()
    {
        // show the form to add a new payment
        return view('admin.payments.create');
    }

    public function createCart(Request $request)
    {
        $addressData = $request->only([
            'street_1',
            'street_2',
            'city',
            'province',
            'postal_code',
            'country',
        ]);
        $addressData['name'] = $request->first_name . " " . $request->last_name;
        $address = Address::create($addressData);

        $payer = Payer::create($request->only([
            'first_name',
            'last_name',
            'email',
        ]));


        $payment = new Payment();
        $payment->save();
        $payment->address()->associate($address);
        $payment->payer()->associate($payer);


        session('admin.payment_id', $payment->id);

        $items = Item::all();

        return view('admin.payments.cart')->with(compact('items'));
    }

    public function processOrder(Request $request)
    {
        $payment = Payment::findOrFail(session('admin.payment_id'));

        $transaction = $payment->buildTransaction($request->all());


    }
}