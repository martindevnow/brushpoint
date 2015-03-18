<?php


namespace Martin\Ecom\Repositories;


class TransactionRepository {

    public function createFromPaypal(\PayPal\Api\Payment $PPpayment)
    {
        $transactions = $PPpayment->getTransactions();

        foreach ($transactions as $transaction)
        {
            $amount = $transaction->getAmount();
            $ecomTransaction = new \Martin\Ecom\Transaction([
                'amount_subtotal' => $amount->getDetails()->getSubtotal(),
                'amount_shipping' => $amount->getDetails()->getShipping(),
                'amount_total' => $amount->getTotal(),
                'amount_currency' => $amount->getCurrency(),
                'description' => $transaction->getDescription(),
            ]);
            $ecomTransaction->save();

            $items = $transaction->getItemList()->getItems();
            foreach ($items as $item)
            {
                $ecomItem = new \Martin\Ecom\SoldItem([
                    'name' => $item->getName(),
                    'price' => $item->getPrice(),
                    'currency' => $item->getCurrency(),
                    'quantity' => $item->getQuantity(),
                    'sku' => $item->getSku(),
                ]);
                $ecomTransaction->soldItems()->save($ecomItem);
            }

            $ecomTransaction->save();
        }

    }

}
/*"transactions" => array:1 [▼
      0 => Transaction {#322 ▼
        -_propMap: array:4 [▼
          "amount" => Amount {#326 ▶}
          "description" => "Your BrushPoint.com Purchase"
          "item_list" => ItemList {#330 ▼
            -_propMap: array:1 [▼
              "items" => array:1 [▼
                0 => Item {#332 ▼
                  -_propMap: array:4 [▼
                    "name" => "Dual Motion Replacement Heads - (4 Pack) [Soft]"
                    "price" => "5.50"
                    "currency" => "USD"
                    "quantity" => "1"
                  ]
                }
              ]
            ]
          }
          "related_resources" => []
        ]
      }
    ]*/
