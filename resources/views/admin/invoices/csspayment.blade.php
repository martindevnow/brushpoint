@extends('pdf.invoice')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <a href="/">
                <img src="http://bpl5.dev/images/logo/bpi_longlogo.jpg" alt="Brushpoint Innovations" class="img-responsive"/>
            </a>
        </div>
        <div class="col-xs-4">
            <div class="invoice-address">
                <p class="address-name">
                    {{ $data['payer']->first_name }} {{ $data['payer']->last_name }}
                </p>
                <p class="address-details"> {{ $data['address']->street_1 }}
                    {{  ($data['address']->street_2)? "<br />" . $data['address']->street_2 :"No" }}
                    <br />{{ $data['address']->city }}, {{ $data['address']->province }}
                    <br />{{ $data['address']->postal_code }}
                    <br />{{ $data['address']->country }}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <h3>Dear {{ $data['payer']->first_name }} {{ $data['payer']->last_name }}</h3>
            <p>Thank you for choosing BrushPoint Innovations for your oral care needs.</p>
        </div>
        <div class="col-xs-1"></div>

    </div>
    <?php $transaction = $data['transactions']; ?>
    <div class="row" style="border: 1px solid darkblue; min-height: 500px;">
        <div class="col-xs-12">
             <table class="table">
                <thead>
                    <tr>
                      <th>Product</th>
                      <th>Unit Cost</th>
                      <th>Quantity</th>
                      <th>Extended Cost</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transaction->soldItems as $item)
                        <tr>
                          <td>{{ $item->name }}</td>
                          <td>${{ number_format($item->price, 2) }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-7">    {{-- Spacer --}}    </div>
        <div class="col-xs-4">
            {{-- Show the Subtotal,
                            Shipping
                        and Total  --}}
             <table class="table">
                <thead>
                    <tr>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="sub-table-strong"><b>Subtotal:</b> </td><td class="sub-table-value">${{ number_format($transaction->amount_subtotal, 2) }}</td>
                    </tr>
                    <tr>
                      <td class="sub-table-strong"><b>Shipping:</b> </td><td class="sub-table-value">${{ number_format($transaction->amount_shipping, 2) }}</td>
                    </tr>
                    <tr>
                      <td class="sub-table-strong"><b>Total:</b> </td><td class="sub-table-value">${{ number_format($transaction->amount_total, 2) }}</td>
                    </tr>
                  </tbody>
            </table>
        </div>
        <div class="col-xs-1">{{-- Spacer --}}</div>
    </div>
    <?php // end the if/else stuff ?>
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10" style="border-top: 1px solid darkblue; height: 25px"></div>
        <div class="col-xs-1"></div>
    </div>

    <div class="row">
        <div class="col-xs-2">{{-- Spacer --}}</div>
        <div class="col-xs-8 invoice-footer-top">
            <p>Once again, we appreciate you choosing BrushPoint Innovations ® for your oral care needs.	</p>
        </div>
        <div class="col-xs-2">{{-- Spacer --}}</div>
    </div>
    <div class="row">
        <div class="col-xs-2">{{-- Spacer --}}</div>
        <div class="col-xs-8 invoice-footer-bottom">
            <p>If you have any questions or feedback, please visit www.BrushPoint.com</p>
        </div>
        <div class="col-xs-2">{{-- Spacer --}}</div>
    </div>
</div>
@stop