<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Ecom\Payment;
use Martin\Quality\Contact;
use Martin\Quality\Feedback;

class EmailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Show the links to all the different types of email templates
        $internalEmailLinks [] = [
            'title' => 'Order Received / Invoice',
            'scope' => 'internal',
            'type' => 'purchased'
        ];
        $internalEmailLinks [] = [
            'title' => 'Feedback Received',
            'scope' => 'internal',
            'type' => 'feedback'
        ];


        $externalEmailLinks [] = [
            'title' => 'Order Received / Invoice',
            'scope' => 'customer',
            'type' => 'invoice'
        ];
        $externalEmailLinks [] = [
            'title' => 'Order Shipped',
            'scope' => 'customer',
            'type' => 'asn'
        ];

        $externalEmailLinks [] = [
            'title' => 'Feedback Received',
            'scope' => 'customer',
            'type' => 'feedback'
        ];

        $externalEmailLinks [] = [
            'title' => 'Replacement Shipped',
            'scope' => 'customer',
            'type' => 'replacementShipped'
        ];


        $externalEmailLinks [] = [
            'title' => 'Feedback - Info/Address Request [Battery]',
            'scope' => 'customer',
            'type' => 'lotCodeRequestBattery'
        ];

        $externalEmailLinks [] = [
            'title' => 'Feedback - Info/Address Request [Recharge]',
            'scope' => 'customer',
            'type' => 'lotCodeRequestRechargeable'
        ];


        $this->layout->context = view('admin.emails.index')
            ->with(compact('externalEmailLinks', 'internalEmailLinks'));

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
	public function show($emailScope, $emailType, $id = 1)
	{
        $model = "";

        if ($emailType == 'contact')
        {
            $model = Contact::find($id);
            $class = 'contact';
        }
        elseif($emailType == 'feedback'
            || $emailType == 'lotCodeRequestRechargeable'
            || $emailType == 'lotCodeRequestBattery')
        {
            $model = Feedback::find($id);
            $class = 'feedback';
        }

        if ($model)
		    return view('emails.'. $emailScope .'.'. $emailType .'')
                ->with([$class => $model]);


        $feedback = Feedback::find($id);

        if ($emailType == 'replacementShipped')
            return view('emails.customer.replacementShipped')
                ->with(compact('feedback'));


        $payment = Payment::find($id);
        $payer = $payment->payer;
        $address = $payment->address; // can have different recipient
        $transactions = $payment->transactions->all(); // array of transactions

        $data = compact('payment', 'payer', 'address', 'transactions');

        if ($emailType == 'asn')
            return view('emails.'. $emailScope . '.asn')
                ->with($data);

        if ($emailType == 'invoice')
            return view('emails.' . $emailScope . '.invoice')
                ->with($data);

        if ($emailType == 'purchased')
            return view('emails.' . $emailScope . '.purchased')
                ->with($data);
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
