<?php
return array(
    'client_id' => env('PAYPAL_SECRET'),
    'secret' => env('PAYPAL_CLIENT_ID'),
    'settings' => array(
        'mode'                      => 'sandbox',
        'http.ConnectionTimeOut'    => 30,
        'log.LogEnabled'            => true,
        'log.FileName'              => storage_path() . '/logs/paypal.log',
        'log.LogLevel'              => 'FINE',

    ),
);
/*
 *
 *
 * Response Example
 *
 * {
  "id": "PAY-17S8410768582940NKEE66EQ",
  "create_time": "2013-01-31T04:12:02Z",
  "update_time": "2013-01-31T04:12:04Z",
  "state": "approved",
  "intent": "sale",
  "payer": {
    "payment_method": "credit_card",
    "funding_instruments": [
      {
        "credit_card": {
          "type": "visa",
          "number": "xxxxxxxxxxxx0331",
          "expire_month": "11",
          "expire_year": "2018",
          "first_name": "Betsy",
          "last_name": "Buyer",
          "billing_address": {
            "line1": "111 First Street",
            "city": "Saratoga",
            "state": "CA",
            "postal_code": "95070",
            "country_code": "US"
          }
        }
      }
    ]
  },
  "transactions": [
    {
      "amount": {
        "total": "7.47",
        "currency": "USD",
        "details": {
          "tax": "0.03",
          "shipping": "0.03"
        }
      },
      "description": "This is the payment transaction description.",
      "related_resources": [
        {
          "sale": {
            "id": "4RR959492F879224U",
            "create_time": "2013-01-31T04:12:02Z",
            "update_time": "2013-01-31T04:12:04Z",
            "state": "completed",
            "amount": {
              "total": "7.47",
              "currency": "USD"
            },
            "parent_payment": "PAY-17S8410768582940NKEE66EQ",
            "links": [
              {
                "href": "https://api.sandbox.paypal.com/v1/payments/sale/4RR959492F879224U",
                "rel": "self",
                "method": "GET"
              },
              {
                "href": "https://api.sandbox.paypal.com/v1/payments/sale/4RR959492F879224U/refund",
                "rel": "refund",
                "method": "POST"
              },
              {
                "href": "https://api.sandbox.paypal.com/v1/payments/payment/PAY-17S8410768582940NKEE66EQ",
                "rel": "parent_payment",
                "method": "GET"
              }
            ]
          }
        }
      ]
    }
  ],
  "links": [
    {
      "href": "https://api.sandbox.paypal.com/v1/payments/payment/PAY-17S8410768582940NKEE66EQ",
      "rel": "self",
      "method": "GET"
    }
  ]
}
 */