<?php


namespace Martin\Ecom\Repositories;


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
} 