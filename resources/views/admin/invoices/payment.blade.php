@extends('pdf.invoice')

@section('content')


<table style="width: 850px; margin-left: 15px">
    <tbody style="padding-left: 15px;">
        <tr>
            <td style="width: 70%;">
                <a href="/">
                    <img src="{{ url('/') }}/images/logo/bpi_longlogo.jpg" alt="Brushpoint Innovations" class="img-responsive"/>
                </a>
            </td>
            <td style="width: 30%; padding-top:25px;;">
                <p class="address-name">
                    {{ $data['payer']->first_name }} {{ $data['payer']->last_name }}
                </p>
                <p class="address-details"> {{ $data['address']->street_1 }}
                    {{  ($data['address']->street_2)? "<br />" . $data['address']->street_2 :"No" }}
                    <br />{{ $data['address']->city }}, {{ $data['address']->province }}
                    <br />{{ $data['address']->postal_code }}
                    <br />{{ $data['address']->country }}
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 100%" colspan="2">
                <h3>&nbsp;&nbsp;Dear {{ $data['payer']->first_name }} {{ $data['payer']->last_name }}</h3>
                <p>Thank you for choosing BrushPoint Innovations for your oral care needs.</p>
            </td>
        </tr>

        @foreach($data['transactions'] as $transaction)
        <tr>
            <td colspan="2">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="70%">Product</th>
                      <th>Unit Cost</th>
                      <th>Qty</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transaction->soldItems as $item)
                    <tr>
                      <td>{{ $item->name }}</td>
                      <td>${{ number_format($item->price,2) }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>${{ number_format($item->price * $item->quantity,2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 100%" colspan="2">
            {{-- Show the Subtotal,
                            Shipping
                        and Total  --}}
                <table width="100%"><tbody><tr><td width="55%">&nbsp;</td><td>{{-- TABLE --}}
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
                </td><td width="15%"></td></tr></tbody></table>
            </td>
        </tr>
        @endforeach
        <tr>
            <td style="width: 100%; border-top: 1px solid darkblue;" colspan="2">
            <br />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Once again, we appreciate you choosing BrushPoint Innovations ® for your oral care needs.	</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
               <p>If you have any questions or feedback, please visit www.BrushPoint.com</p>
            </td>
        </tr>
    </tbody>
</table>
@stop