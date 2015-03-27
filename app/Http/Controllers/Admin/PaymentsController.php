<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use HTML2PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Ecom\Payment;
use Martin\Ecom\Repositories\PaymentRepository;
use Martin\Notifications\Flash;
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
        $this->paymentRepository = $paymentRepository;
    }


    public function index()
    {
        // show all payments - recent at top

        $payments = $this->paymentRepository->getRecentPayments();

        $this->layout->content =  view('admin.payments.index')->with([
            'payments' => $payments
        ]);
    }

    public function show($id)
    {
        $payment = Payment::find($id);

        $this->layout->conte = view('admin.payments.show')
            ->with(['payment' => $payment]);

    }

    public function invoice($id)
    {
        // You can pass a filename, a HTML string or an URL to the constructor
        $pdf = new Pdf("bpl5.dev/admins/payments/invoice/html/". $id);
        $pdf->saveAs(public_path(). '/tmp/new'. $id .'.pdf');
        // dd($pdf);
        // return "Generating...";
        // dd();
        return response()->download(public_path()."/tmp/new". $id .".pdf");

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
        $view =  view('admin.invoices.csspayment')->with(['data'=> $data]);
        return $view;
    }

} 