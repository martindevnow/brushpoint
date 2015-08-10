<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;
use Martin\Ecom\Transaction;

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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
