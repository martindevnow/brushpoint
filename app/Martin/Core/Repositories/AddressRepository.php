<?php

namespace Martin\Core\Repositories;

class AddressRepository {
    public function createFromPayPal(\Martin\Ecom\Payer $ecomPayer, \PayPal\Api\Payment $payment)
    {
        $shippingAddress = $payment->getPayer()->getPayerInfo()->getShippingAddress();

        $addressData = [
            'name' => $shippingAddress->getRecipientName(),
            'street_1'  => $shippingAddress->getLine1(),
            'street_2' => $shippingAddress->getLine2(),
            'city'  => $shippingAddress->getCity(),
            'province' => $shippingAddress->getState(),
            'postal_code'  => $shippingAddress->getPostalCode(),
            'country' => $shippingAddress->getCountryCode(),
            'phone'  => $shippingAddress->getPhone(),
        ];
        // $ecomAddress = $ecomPayer->addresses()->firstOrNew($addressData);
        $ecomAddress = new \Martin\Core\Address($addressData);

        // $ecomPayer->addresses()->save($ecomAddress);

        return $ecomAddress;
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