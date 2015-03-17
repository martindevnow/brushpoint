<?php

namespace Martin\Core\Repositories;

class AddressRepository {
    public function findOrCreateFromPayPal(\PayPal\Api\Payer $payer)
    {
        $DBPayer = \Martin\Ecom\Payer::where('payer_id', '=', $payer->getPayerInfo()->getPayerId())->first();

        if ($DBPayer)
        {
            dd ($DBPayer->addresses());
        }



        $shippingAddress = $payer->getPayerInfo()->getShippingAddress();
        $DBPayer = new \Martin\Core\Address();
        $DBPayer->name = $shippingAddress->getRecipientName();
        $DBPayer->street_1 = $shippingAddress->getLine1();
        $DBPayer->street_2 = $shippingAddress->getLine2();
        $DBPayer->city = $shippingAddress->getCity();
        $DBPayer->province = $shippingAddress->getState();
        $DBPayer->postal_code = $shippingAddress->getPostalCode();
        $DBPayer->country = $shippingAddress->getCountryCode();
        $DBPayer->phone = $shippingAddress->getPhone();

        return $DBPayer;
    }

}

/*
    "payer" => Payer {#323 ▼
      -_propMap: array:3 [▼
        "payment_method" => "paypal"
        "status" => "VERIFIED"
        "payer_info" => PayerInfo {#318 ▼
          -_propMap: array:5 [▼
            "email" => "benjaminm+test@brushpoint.com"
            "first_name" => "Ben"
            "last_name" => "Martin"
            "payer_id" => "P69HMJQPKX258"
            "shipping_address" => ShippingAddress {#320 ▼
              -_propMap: array:6 [▼
                "line1" => "1 Main St"
                "city" => "San Jose"
                "state" => "CA"
                "postal_code" => "95131"
                "country_code" => "US"
                "recipient_name" => "Ben Martin"
              ]
            }
          ]
        }
      ]
    }
 */