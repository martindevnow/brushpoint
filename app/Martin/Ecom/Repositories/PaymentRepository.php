<?php


namespace Martin\Ecom\Repositories;


use Martin\Ecom\Payment;

class PaymentRepository {

    public function findOrCreateFromPayPal(\PayPal\Api\Payment $payment)
    {
        $DBpayment = \Martin\Ecom\Payment::where('payment_id', '=', $payment->getId())
            ->first();

        if ($DBpayment)
            return $DBpayment;

        $DBpayment = new \Martin\Ecom\Payment();

        $DBpayment->payment_id = $payment->getId();
        $DBpayment->setUniqueId();
        return $DBpayment;

    }

    public function getRecentPayments()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(25);
        return $payments;
    }

    public function generateInvoiceData($id)
    {
        $payment = Payment::find($id);

        $payer = $payment->payer;

        $address = $payment->address;

        $transactions = $payment->transactions->first();


        return [
            'payment' => $payment,
            'payer' => $payer,
            'address' => $address,
            'transactions' => $transactions,
        ];
    }

    public function getInvoicePath($paymentId)
    {
        return storage_path(). '/tmp/BP-inv-'. $paymentId .'.pdf';
    }

    public function getSentCount()
    {
        return Payment::where('shipped', '=', '1')->count();
    }

    public function getOpenCount()
    {
        return Payment::where('shipped', '=', '0')->count();
    }
} 