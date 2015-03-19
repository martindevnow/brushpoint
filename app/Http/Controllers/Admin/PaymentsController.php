<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use HTML2PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Ecom\Repositories\PaymentRepository;
use Martin\Notifications\Flash;
use Martin\Products\Product;
use Martin\Products\ProductRepository;

class PaymentsController extends Controller {

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    function __construct(PaymentRepository $paymentRepository)
    {
        $this->middleware('auth');
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

    public function invoice($id)
    {
        $data = $this->paymentRepository->generateInvoiceData($id);
        $view =  view('admin.invoices.payment')->with(['data'=> $data]);

        // return $view;
        $html2pdf = new HTML2PDF('P', 'Letter', 'en');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($view);
        dd($html2pdf->Output('exemple00.pdf'));
    }

} 