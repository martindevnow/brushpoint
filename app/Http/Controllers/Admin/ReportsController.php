<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;

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
            'id', 'payment_id', 'intent', 'shipped', 'created_at',
            'payer_id', 'payer_name', 'payer_email',
            'recipient_name', 'recipient_country', 'recipient_province',
            'amount_total', 'amount_subtotal', 'amount_shipping'
        );

        $file = storage_path() . '/payments_2015-07.csv';

        foreach($payments->get() as $payment)
        {
            foreach($payment->transactions as $transaction)
            {
                $list[] = array (
                    $payment->id, $payment->payment_id, $payment->intent, $payment->shipped, $payment->created_at,
                    $payment->payer->payer_id, $payment->payer->first_name . " " . $payment->payer->last_name, $payment->payer->email,
                    $payment->address->name, $payment->address->country, $payment->address->province,
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
