@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Payment Information</h1>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Payments Details
                    <span style="float: right;">
                        @include('admin.layouts.modals._note', ['model' => $payment, 'class' => 'btn-panel-heading'])
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th>Field</th>
                                  <th>Value</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Date</td>
                                  <td>{{ $payment->created_at->diffForHumans() }}</td>
                                </tr>

                                <tr>
                                  <td>Name</td>
                                  <td>{{ $payment->payer->getName() }}</td>
                                </tr>

                                <tr>
                                  <td>City</td>
                                  <td>{{ $payment->address->city }}</td>
                                </tr>

                                <tr>
                                  <td>Country</td>
                                  <td>{{ $payment->address->country }}</td>
                                </tr>

                                <tr>
                                  <td>Shipped</td>
                                  <td>
                                    @if($payment->shipped_at == "0000-00-00 00:00:00")
                                    <div class="form-group">
                                      {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/payments/ajax/'. $payment->id . '?field=shipped', 'id' => 'shipped-form']) !!}
                                      {!! Form::hidden('shipped', 1) !!}
                                      {!! Form::submit('Shipped',['data-click-submits-form button-disappears', 'class' => 'btn btn-primary']) !!}
                                      {!! Form::close() !!}
                                    </div>
                                    @else
                                      [[ {{ $payment->shipped_at }} ]]
                                    @endif
                                  </td>
                                </tr>


                                <tr>
                                  <td>Subtotal</td>
                                  <td>{{ $payment->transactions->first()->amount_subtotal }}</td>
                                </tr>

                                <tr>
                                  <td>Shipping</td>
                                  <td>{{ $payment->transactions->first()->amount_shipping }}</td>
                                </tr>

                                <tr>
                                  <td>Total</td>
                                  <td>{{ $payment->transactions->first()->amount_total }}</td>
                                </tr>


                                <tr>
                                  <td>Invoice</td>
                                  <td>
                                    @if(file_exists($payment->getFullInvoicePath()))
                                        <a href="/admins/payments/invoice/{{ $payment->id }}">
                                            <button class="btn btn-primary">
                                            <i class="fa fa-download "></i> Invoice</button>
                                        </a>
                                    @else
                                        <a href="/admins/payments/invoice/{{ $payment->id }}">
                                            <button class="btn btn-primary">
                                            <i class="fa fa-gear "></i> Invoice</button>
                                         </a>
                                    @endif
                                  </td>
                                </tr>
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Items bought by this Customer
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @foreach ($payment->transactions as $transaction)
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <th>Item</th>
                                    <th>Lot Code</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Extended Cost</th>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->soldItems as $soldItem)
                                    <tr>
                                    <td>{{ $soldItem->sku }}</td>
                                    <td>{{ $soldItem->lot_code }}</td>
                                    <td>{{ $soldItem->quantity }}</td>
                                    <td>{{ asMoney($soldItem->price) }}</td>
                                    <td>{{ asMoney($soldItem->price * $soldItem->quantity) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="row" id="note_list">
        @foreach($payment->notes as $note)
            @include('admin.ajax.singles._note', ['note' => $note])
        @endforeach
    </div>

</div>
@stop