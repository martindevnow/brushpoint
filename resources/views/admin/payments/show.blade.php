@extends('layouts.admin')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th>City</th>
              <th>Total Amount</th>
              <th>Shipped</th>
              <th>Documents</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $payment->created_at->diffForHumans() }}</td>
              <td>{{ $payment->payer->first_name . " " . $payment->payer->last_name }}</td>
              <td>{{ $payment->address->city }}</td>
              <td>{{ $payment->transactions->first()->amount_total }}</td>
              <td>
                {!! Form::open() !!}
                    <div class="form-group">
                    {!! Form::checkbox('shipped', $payment->portfolio, $payment->portfolio) !!}
                    </div>
                {!! Form::close() !!}
              </td>
              <td><a href="/admins/payments/invoice/{{ $payment->id }}">Invoice</a></td>
            </tr>
          </tbody>
    </table>



    @foreach ($payment->transactions as $transaction)
        <table class="table">
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

    @include('admin.layouts.modals._note', ['model' => $payment])
</div>
@stop