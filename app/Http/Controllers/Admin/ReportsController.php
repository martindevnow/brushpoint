<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class ReportsController extends Controller {


    protected $viableReports = ['SoldItems', 'Payments', 'Feedback'];

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Show all available reports
        return view('admin.reports.index')->with(['viableReports' => $this->viableReports]);
	}


    /**
     * This method is run first
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(Request $request)
    {
        if ($request->report >= count($this->viableReports) || $request->report < 0)
        {
            Flash::error('That report could not be run');
            return redirect()->back();
        }

        $reportToRun = "generate" . $this->viableReports[$request->report];

        return $this->$reportToRun($request);
    }






    public function generateSoldItems(Request $request)
    {
        $soldItem = new SoldItem();

        $dates = $soldItem->getDatesFromRequest($request);

        $file = storage_path() . '/'. $soldItem->generateFileName($dates['from'], $dates['to']);

        // dd($file);

        $fields = array(
            'id',
            // transaction fields
            'transaction.id',

            // payment fields
            'transaction.payments.firstRecord.payment_id',
            'transaction.payments.firstRecord.state',
            'transaction.payments.firstRecord.intent',
            'transaction.payments.firstRecord.created_at',
            'transaction.payments.firstRecord.shipped',
            'transaction.payments.firstRecord.shipped_at',

            // item fields
            'item.sku',

            // sold item fields
            'lot_code', 'name', 'price', 'quantity',
        );

        $data = $soldItem->generateReport($fields, $dates['from'], $dates['to']);


        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
}



    public function generateFeedback($request)
    {
        $file = storage_path() . '/'. $this->generateFileName($request);


        $feedback = new Feedback();
        $dates = $feedback->getDatesFromRequest($request);

        $file = $feedback->generateReportFilename($from, $to);

        $fields = array(
            'id',                   'created_at',       'name',                 'addresses.firstRecord',
            'bp_code',              'retailer_name',    'QUANTITY',             'lot_code',  'issue_type',
            'adverse_event',        'RESOLUTION',       'health_canada_report',
            'capa_required',        'capa_reaspn',      'closed',               'closed_at',
            'number_of_days_open',  'on_time_closing');

        $data = $this->generateReport($feedback, $fields, $monthNumber, $year);


        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }


    public function generatePayments($request)
    {
        $file = storage_path() . '/payments_2015-' . $monthNumber . '.csv';

        $payment = new Payment();

        $list = array();
        $fields = array(
            // payment fields
            'id',            'payment_id',            'intent',            'shipped',            'created_at',
            // payer fields
            'payer.payer_id',       'payer_name',       'payer.email',
            // address fields
            'address.name',         'address.country',  'address.province',
            // transaction fields
            'transactions.firstRecord.amount_total', 'transactions.firstRecord.amount_subtotal', 'transactions.firstRecord.amount_shipping'
        );

        $data = $this->generateReport($payment, $fields, $monthNumber, $year);

        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }


    protected function getMonthName($monthNumber)
    {
        $dateObj   = DateTime::createFromFormat('!m', $monthNumber);
        $monthName = $dateObj->format('F'); // March
        return $monthName;
    }

}
