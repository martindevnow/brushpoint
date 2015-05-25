<?php


namespace Martin\Ecom\Repositories;


class TransactionRepository {

    public function createFromPaypal(\PayPal\Api\Payment $PPpayment, \Martin\Ecom\Payment $ecomPayment)
    {
        $PPtransactions = $PPpayment->getTransactions();

        foreach ($PPtransactions as $PPtransaction)
        {
            $PPamount = $PPtransaction->getAmount();
            $ecomTransaction = new \Martin\Ecom\Transaction([
                'amount_subtotal' => $PPamount->getDetails()->getSubtotal(),
                'amount_shipping' => $PPamount->getDetails()->getShipping(),
                'amount_total' => $PPamount->getTotal(),
                'amount_currency' => $PPamount->getCurrency(),
                'description' => $PPtransaction->getDescription(),
            ]);
            $ecomTransaction->save();

            $PPitems = $PPtransaction->getItemList()->getItems();
            // dd($PPitems);
            foreach ($PPitems as $PPitem)
            {
                ///dd($PPitem);
                $ecomItem = \Martin\Products\Item::where('sku', '=', $PPitem->sku)->first();
                // dd($ecomItem);

                $ecomSoldItem = new \Martin\Ecom\SoldItem([
                    'name' => $PPitem->getName(),
                    'price' => $PPitem->getPrice(),
                    'currency' => $PPitem->getCurrency(),
                    'quantity' => $PPitem->getQuantity(),
                    'sku' => $PPitem->getSku(),
                    'item_id' => $ecomItem->id,
                ]);
                $ecomTransaction->soldItems()->save($ecomSoldItem);
            }

            $ecomTransaction->save();
            $ecomPayment->transactions()->attach($ecomTransaction);
        }
        return $ecomPayment->transactions;
        // $ecomPayment = \Martin\Ecom\Payment::where('payment_id', '=', $PPpayment->getId())->last();

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
