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

    public function run(Request $request)
    {
        if ($request->report >= count($this->viableReports) || $request->report < 0)
        {
            Flash::error('That report could not be run');
            return redirect()->back();
        }

        $reportToRun = "generate" . $this->viableReports[$request->report];
        return $this->$reportToRun($request->month);
    }


//    public function generateSoldItems2()
//    {
//        $transactions = Transaction::with('payments', 'soldItems')
//            ->where('created_at', '>', (new Carbon('first day of July 2015')))
//            ->where('created_at', '<', (new Carbon('first day of August 2015')));
//
//        $list = array();
//        $list[] = array(
//            // transaction fields
//            'id',
//
//            // payment fields
//            'payment_id', 'state', 'intent', 'date',
//
//            // item fields
//            'sku',
//
//            // sold item fields
//            'lot_code', 'name', 'price', 'quantity',
//        );
//
//        $file = storage_path() . '/payments_solditems_2015-07.csv';
//
//        foreach($transactions->get() as $transaction)
//        {
//            foreach($transaction->soldItems as $soldItem)
//            {
//                $payment = $transaction->payments->first();
//                // dd($payment);
//                $list[] = array (
//                    // transaction fields
//                    $transaction->id,
//
//                    // payment fields
//                    $payment->payment_id, $payment->intent, $payment->shipped, $payment->created_at,
//
//                    // item fields
//                    $soldItem->item->sku,
//
//                    // Sold item fields
//                    $soldItem->lot_code, $soldItem->name, $soldItem->price, $soldItem->quantity,
//                );
//            }
//        }
//
//
//        $fp = fopen($file, 'w');
//        foreach ($list as $fields) {
//            fputcsv($fp, $fields);
//        }
//        fclose($fp);
//
//        return response()->download($file);
//    }

    public function generateSoldItems($monthNumber = 7, $year = 2015)
    {

        $file = storage_path() . '/payments_solditems_2015-' . $monthNumber . '.csv';

        $soldItem = new SoldItem();

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

        $data = $this->generateReport($soldItem, $fields, $monthNumber, $year);


        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
}



    public function generateFeedback($monthNumber = 7, $year = 2015)
    {
        $file = storage_path() . "/feedback_2015-' . $monthNumber . '.csv";

        $feedback = new Feedback();

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


    public function generatePayments($monthNumber = 7, $year = 2015)
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

    protected function generateReport ($model, $fields, $monthNumber, $year)
    {
        $thisMonth = $this->getMonthName($monthNumber);
        $thisYear = $year;
        $nextMonth = $this->getMonthName($monthNumber % 12 + 1);
        if ($monthNumber == 12)
            $nextYear = $year ++;
        else
            $nextYear = $year;

        $data = $model->generateReport(
            $fields,
            'first day of '. $thisMonth. ' '. $thisYear,
            'first day of '. $nextMonth. ' '. $nextYear);

        return $data;
    }

    protected function generateFileName($reportName, $month, $year)
    {
        return strtolower($reportName) . '_'. $year .'-'. $this->zerofill($month, 2) .'.csv';
    }

    protected function zerofill ($num, $zerofill = 5)
    {
        return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
    }

}
