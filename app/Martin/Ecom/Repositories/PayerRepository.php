<?php


namespace Martin\Ecom\Repositories;


class PayerRepository {


    public function findOrCreateFromPayPal(\PayPal\Api\Payer $payer)
    {
        $DBPayer = \Martin\Ecom\Payer::where('payer_id', '=', $payer->getPayerInfo()->getPayerId())->first();

        if ($DBPayer)
            return $DBPayer;

        $DBPayer = new \Martin\Ecom\Payer();




    }
} 