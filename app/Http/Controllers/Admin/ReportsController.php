<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Quality\Feedback;

class ReportsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Show all available reports
        return view('admin.reports.index');
	}


    public function generateSoldItems2()
    {
        $transactions = Transaction::with('payments', 'soldItems')
            ->where('created_at', '>', (new Carbon('first day of July 2015')))
            ->where('created_at', '<', (new Carbon('first day of August 2015')));

        $list = array();
        $list[] = array(
            // transaction fields
            'id',

            // payment fields
            'payment_id', 'state', 'intent', 'date',

            // item fields
            'sku',

            // sold item fields
            'lot_code', 'name', 'price', 'quantity',
        );

        $file = storage_path() . '/payments_solditems_2015-07.csv';

        foreach($transactions->get() as $transaction)
        {
            foreach($transaction->soldItems as $soldItem)
            {
                $payment = $transaction->payments->first();
                // dd($payment);
                $list[] = array (
                    // transaction fields
                    $transaction->id,

                    // payment fields
                    $payment->payment_id, $payment->intent, $payment->shipped, $payment->created_at,

                    // item fields
                    $soldItem->item->sku,

                    // Sold item fields
                    $soldItem->lot_code, $soldItem->name, $soldItem->price, $soldItem->quantity,
                );
            }
        }


        $fp = fopen($file, 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }

    public function generateSoldItems()
    {

        $file = storage_path() . '/payments_solditems_2015-07.csv';

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

        $data = $soldItem->generateReport(
            $fields,
            'first day of July 2015',
            'first day of August 2015');

        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
}



    public function generateFeedback()
    {
        $file = storage_path() . "/feedback_2015-08.csv";

        $feedback = new Feedback();

        $fields = array(
            'id',                   'created_at',       'name',                 'addresses.firstRecord',
            'bp_code',              'retailer_name',    'QUANTITY',             'lot_code',  'issue_type',
            'adverse_event',        'RESOLUTION',       'health_canada_report',
            'capa_required',        'capa_reaspn',      'closed',               'closed_at',
            'number_of_days_open',  'on_time_closing');

        $data = $feedback->generateReport(
            $fields,
            'first day of August 2015',
            'first day of September 2015');

        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }


    public function generatePayments()
    {
        $file = storage_path() . '/payments_2015-07.csv';

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

        $data = $payment->generateReport(
            $fields,
            'first day of July 2015',
            'first day of August 2015');


        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }

}
