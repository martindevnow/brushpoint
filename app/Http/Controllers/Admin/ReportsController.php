<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;
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




    public function generatePayments()
    {
        $payments = Payment::with('payer', 'address', 'transactions')
            ->where('created_at', '>', (new Carbon('first day of July 2015')))
            ->where('created_at', '<', (new Carbon('first day of August 2015')));

        $list = array();
        $list[] = array(
            // payment fields
            'id', 'payment_id', 'intent', 'shipped', 'created_at',

            // payer fields
            'payer_id', 'payer_name', 'payer_email',

            // address fields
            'recipient_name', 'recipient_country', 'recipient_province',

            // transaction fields
            'amount_total', 'amount_subtotal', 'amount_shipping'
        );

        $file = storage_path() . '/payments_2015-07.csv';

        foreach($payments->get() as $payment)
        {
            foreach($payment->transactions as $transaction)
            {
                $list[] = array (
                    // payment fields
                    $payment->id, $payment->payment_id, $payment->intent, $payment->shipped, $payment->created_at,

                    // payer fields
                    $payment->payer->payer_id, $payment->payer->first_name . " " . $payment->payer->last_name, $payment->payer->email,

                    // address fields
                    $payment->address->name, $payment->address->country, $payment->address->province,

                    // transaction fields
                    $transaction->amount_total, $transaction->amount_subtotal, $transaction->amount_shipping
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





    public function generateFeedback()
    {
        $feedbacks = Feedback::with('issue', 'retailer', 'address', 'investigations', 'emails', 'contacts')
            ->where('created_at', '>', (new Carbon('first day of July 2015')))
            ->where('created_at', '<', (new Carbon('first day of August 2015')));

        $list = array();
        $list[] = array(
            'feedback.id',
            'feedback.created_at',
            'feedback.name',
            'feedback.address.toString',
            'feedback.bp_code',
            'feedback.retailer.name',
            'QUANTITY',
            'feedback.lot_code',
            'feedback.issue.type',
            'feedback.adverse_event',
            'feedback.RESOLUTION',
            'feedback.health_canada_report',
            'feedback.capa_required',
            'feedback.capa_reaspn',
            'feedback.colosed',
            'feedback.closed_at',
            'number_of_days',
            'on_time_closing',
        );


        $file = storage_path() . '/feedback_2015-07.csv';

        foreach($feedbacks->get() as $feedback)
        {

            $address = $feedback->addresses->last();
            if ($address)
                $addressString = $address->street_1 . ", "
                    . ($address->street_2 ? $address->street_2 . ", " : "") .
                    $address->city . ", " . $address->province . ", " . $address->postal_code . ", " .
                    $address->country;
            else
                $addressString = "N/A";


            if ($feedback->closed)
                $number_of_days = $feedback->closed_at->diffInDays($feedback->created_at);
            else
                $number_of_days = "N/A";


            if ($feedback->retailer)
                $retailerName = $feedback->retailer->name;
            else
                $retailerName = $feedback->retailer_text;


            if ($feedback->issue)
                $issueType = $feedback->issue->type;
            else
                $issueType = $feedback->issue;



            $on_time_closing = "IDONTKNOW";

            $list[] = array (
                // payment fields
                $feedback->id, $feedback->created_at, $feedback->name, $addressString,

                $feedback->bp_code, $retailerName, "QUANTITY", $feedback->lot_code,
                $issueType,

                $feedback->adverse_event, "RESOLUTION", $feedback->health_canada_report,

                $feedback->capa_required, $feedback->capa_reason,
                $feedback->closed, $feedback->closed_at, $number_of_days, $on_time_closing
            );
        }

        $fp = fopen($file, 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }


}
