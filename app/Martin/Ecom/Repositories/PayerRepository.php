<?php


namespace Martin\Ecom\Repositories;


class PayerRepository {


    public function findOrCreateFromPayPal(\PayPal\Api\Payer $payer)
    {
        $DBPayer = \Martin\Ecom\Payer::where('payer_id', '=', $payer->getPayerInfo()->getPayerId())
            ->where('status', '=', $payer->getStatus())
            ->where('payment_method', '=', $payer->getPaymentMethod())
            ->first();

        if ($DBPayer)
            return $DBPayer;

        $DBPayer = new \Martin\Ecom\Payer();
        $DBPayer->payer_id = $payer->getPayerInfo()->getPayerId();
        $DBPayer->first_name = $payer->getPayerInfo()->getFirstName();
        $DBPayer->last_name = $payer->getPayerInfo()->getLastName();
        $DBPayer->email = $payer->getPayerInfo()->getEmail();
        $DBPayer->status = $payer->getStatus();
        $DBPayer->payment_method = $payer->getPaymentMethod();

        $DBPayer->save();

        return $DBPayer;






    }
} 