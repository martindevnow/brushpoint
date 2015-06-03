<?php
$payment->created_at->timezone = 'America/Toronto';
?>



<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            body,td,div,p,a,input {font-family: arial, sans-serif;}
        </style>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Your BrushPoint.com order - {{ time() }}</title>
        <style type="text/css">
            body, td {font-size:13px} a:link, a:active {color:#1155CC; text-decoration:none} a:hover {text-decoration:underline; cursor: pointer} a:visited{color:##6611CC} img{border:0px} pre { white-space: pre; white-space: -moz-pre-wrap; white-space: -o-pre-wrap; white-space: pre-wrap; word-wrap: break-word; max-width: 800px; overflow: auto;}
        </style>
    </head>
    <body>
        <div class="body-container" style="width: 600px; margin-right: auto; margin-left: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                    <table style="width:100%;border-collapse:collapse">
                        <tbody>
                        <!-- Top Bar and General Information -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:100%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td rowspan="2" style="width:115px;padding:20px 20px 0 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <a href="http://www.brushpoint.com" title="Visit www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            <img src="http://www.brushpoint.martindevnow.com/images/logo/brushpoint.jpg" height="75" width="165" />
                                            <!-- <img alt="BrushPoint.com" src="https://ci6.googleusercontent.com/proxy/WhmqLoMir5UYEN_mqZBtoDGctziWnxcd16JUuejFgylJH9MjVIUKe8NP3fxPs7ww8j41WBvy-JQKspLrhrPKLmmCwBuHQcWhwm7oPls8g7VZtkb0JoBGh-TAQx2I=s0-d-e1-ft#http://g-ec2.images-amazon.com/images/G/15/x-locale/cs/te/a_ca_logo.png" style="border:0;width:115px"> -->
                                        </a>
                                    </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif"> </td>
                                    <td style="width:100%;padding:7px 5px 0;text-align:right;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <!-- <a href="http://www.brushpoint.com" style="border-right:0px solid rgb(204,204,204);margin-right:0px;padding-right:0px;text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            Your Orders
                                        </a> -->
                                    </td>
                                    <td style="text-align:right;padding:5px 0;border-bottom:1px solid rgb(204,204,204);white-space:nowrap;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <!-- <span style="text-decoration:none;color:rgb(204,204,204);font-size:15px;font-family:Arial,sans-serif">
                                            &nbsp;|&nbsp;
                                        </span>
                                        <a href="http://www.brushpoint.com" style="border-right:0px solid rgb(204,204,204);margin-right:0px;padding-right:0px;text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            Your Account
                                        </a>
                                        <span style="text-decoration:none;color:rgb(204,204,204);font-size:15px;font-family:Arial,sans-serif">
                                            &nbsp;|&nbsp;
                                        </span> -->
                                        <a href="http://www.brushpoint.com" style="border:0;margin:0;padding:0;border-right:0px solid rgb(204,204,204);margin-right:0px;padding-right:0px;text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            BrushPoint.com
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:right;padding:7px 0 5px 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <h2 style="font-size:20px;line-height:24px;margin:0;padding:0;font-weight:normal;color:rgb(0,0,0)!important">
                                            Order Confirmation
                                        </h2>
                                        Order #
                                        <a href="http://www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            {{ $payment->payment_id }}
                                        </a>
                                        <br>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>

                        <!-- Customer Greeting -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:100%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <h3 style="font-size:18px;color:rgb(29, 85, 204);margin:15px 0 0 0;font-weight:normal;border-bottom: 1px solid rgb(204,204,204);">
                                            Hello {{ $payer->first_name }} {{ $payer->last_name }},
                                        </h3>
                                        <p style="margin:1px 0 8px 0;font:12px/16px Arial,sans-serif">
                                            Thank you for shopping with us. We’ll send a confirmation once your item(s) have shipped. Your order details are indicated below. If you would like to view the status of your order or make any changes to it, please visit
                                            <a href="http://www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            Your Orders
                                            </a>
                                            on BrushPoint.com.
                                        </p>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <p style="margin:1px 0 8px 0;font:12px/16px Arial,sans-serif">
                                            Your purchase has been divided into 2 orders.
                                        </p>
                                    </td>
                                </tr> -->
                                </tbody>
                                </table>
                            </td>
                        </tr>


                        <!-- Order Details Header -->
                        <tr>
                            <td style="border-bottom:1px solid rgb(204,204,204);vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(29, 85, 204);margin:15px 0 0 0;font-weight:normal">Order Details</h3> </td>
                        </tr>


                        <!-- Order Specific Info -->
                        <tr>
                            <td style="padding-left:32px;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                            <table style="width:100%;border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                    Order #
                                    <a href="http://www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                        {{ $payment->payment_id }}
                                    </a>
                                    <br>
                                    <span style="font-size:12px;color:rgb(102,102,102)">
                                        Placed on {{ $payment->created_at->toDayDateTimeString()}} EST
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                            </table>
                        </td>
                        </tr>


                        <!-- Order Details -->
                        <tr>
                            <td style="padding-left:32px;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="border-top:3px solid rgb(45,55,65);width:95%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgb(239, 239, 255);width:50%;vertical-align:top;line-height:18px;font-family:Arial,sans-serif">
                                        <p style="margin:2px 0 9px 0;font:14px Arial,sans-serif">
                                            <span style="font-size:14px;color:rgb(102,102,102)">
                                                Your estimated delivery date is:
                                            </span>
                                            <br>
                                            <b>
                                                {{ $payment->created_at->addWeekdays(5)->format('l\\, F jS Y') }} -
                                                <br> {{ $payment->created_at->addWeekdays(10)->format('l\\, F jS Y') }}
                                            </b>
                                        </p>
                                        <p style="margin:2px 0 9px 0;font:14px Arial,sans-serif">
                                            <span style="font-size:14px;color:rgb(102,102,102)">
                                                Shipping:
                                            </span>
                                            <br>
                                            <b>
                                                Standard Shipping
                                            </b>
                                        </p>
                                    </td>
                                    <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgb(239,239,255);width:50%;vertical-align:top;line-height:18px;font-family:Arial,sans-serif">
                                        <p style="margin:2px 0 9px 0;font:14px Arial,sans-serif">
                                            <span style="font-size:14px;color:rgb(102,102,102)">
                                                Your order will be sent to:
                                            </span>
                                            <br>
                                            <b>
                                                {{ $address->name }}
                                                <br> {{ $address->street_1 }}
                                                @if($address->street_2)
                                                <br> {{ $address->street_2 }}
                                                @endif
                                                <br> {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}
                                                <br> {{ $address->country }}
                                            </b>
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>



                        <!-- ITEMS -->
                        @foreach($transactions as $transaction)

                        @foreach($transaction->soldItems as $soldItem)
                        <tr>
                            <td style="padding-left:32px;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:95%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td style="width:150px;text-align:center;padding:16px 0 10px 0;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <a href="http://www.brushpoint.com" title="B005FWS0ZU" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                        <!-- PRODUCT IMAGE -->
                                            <img src="http://www.brushpoint.martindevnow.com/images/brushpoint/purchase/{{ $soldItem->item->sku }}-115.png" class="img-responsive" style="max-height: 35px; display: inline;"/>
                                            <!-- <img src="https://ci3.googleusercontent.com/proxy/s5qnvPL4BTDy60jHjxlmKEKp4MCauXDJcLY7c3s0DCt_C7Nm-9lbrmYA8Jy9evXE0cVYJb6qKvKg1DRmfJeJ3IwDuJnNkIUcHf5YeEtWsVxsuCIUzinUis2cZOXCKPBS7EBn4Z0=s0-d-e1-ft#http://ecx.images-amazon.com/images/I/41brDiU5u1L._SCLZZZZZZZ__SY115_SX115_.jpg" style="border:0"> -->
                                        </a>
                                    </td>
                                    <td style="color:rgb(102,102,102);padding:10px 0 10px 10px;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <a href="http://www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                                            {{ $soldItem->item->name }}
                                        </a>
                                        <br>
                                        {{ $soldItem->item->product->pack_description }}

                                        <br>
                                    </td>
                                    <td style="width:110px;text-align:right;font-size:14px;padding:10px 10px 0 0;vertical-align:top;line-height:18px;font-family:Arial,sans-serif">
                                        <strong>
                                            {{ asMoney($soldItem->item->price) }}
                                        </strong>
                                        <br>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Cost / Totals -->
                        <tr>
                            <td style="padding-left:32px;vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:95%;border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="border-top:1px solid rgb(234,234,234);padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    Item Subtotal:
                                    </td>
                                    <td style="width:120px;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    {{ asMoney($transaction->amount_subtotal) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    Shipping &amp; Handling:
                                    </td>
                                    <td style="width:120px;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    {{ asMoney($transaction->amount_shipping) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    Estimated Tax (GST/HST):
                                    </td>
                                    <td style="width:120px;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    $ 0.00 USD
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    <p style="margin:1px 0 8px 0;font:12px/16px Arial,sans-serif">

                                    </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:13px;font-family:Arial,sans-serif">
                                    <p style="margin:1px 0 8px 0;font:12px/16px Arial,sans-serif">

                                    </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:14px;font-weight:bold;font:12px/16px Arial,sans-serif;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-family:Arial,sans-serif">
                                    <strong>
                                    Order Total:
                                    </strong>
                                    </td>
                                    <td style="font-size:14px;font-weight:bold;font:12px/16px Arial,sans-serif;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-family:Arial,sans-serif">
                                    <strong>
                                    {{ asMoney($transaction->amount_total) }}
                                    </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:13px;font-family:Arial,sans-serif"> </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top:1px solid rgb(234,234,234);padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:13px;font-family:Arial,sans-serif"> </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach


                        <!-- Footer -->

                        <tr>
                        <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                        <table style="width:100%;border-collapse:collapse">
                        <tbody>
                        <tr>
                        <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                        <p style="margin:1px 0 8px 0;font:12px/16px Arial,sans-serif">
                        <!--
                        To learn more about ordering, go to
                        <a href="http://www.brushpoint.com" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                        Ordering from BrushPoint.com
                        </a>.
                        <br> -->
                        If you want more information or need more assistance, please don't hesitate to <a href="http://www.brushpoint.com/contact" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank">
                        contact us
                        </a>.
                        </p>
                        </td>
                        </tr>
                        </tbody>
                        </table> </td>
                        </tr>


                        <!-- Closing / Signature -->
                        <tr>
                            <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                <table style="width:100%;padding:0 0 0 0;border-collapse:none">
                                <tbody>
                                <tr>
                                    <td style="vertical-align:top;font-size:13px;line-height:18px;font-family:Arial,sans-serif">
                                        <p style="padding:0 0 20px 0;border-bottom:1px solid rgb(234,234,234);margin:0;font:12px/16px Arial,sans-serif"> Thank you for choosing us for your Oral Care needs!<br>
                                        <span style="font-size:16px;font-weight:bold">
                                        <strong>BrushPoint.com</strong> </span> </p>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>