@extends('layouts.admin')

@section('content')
<div class="container">

<h2>Customer Information</h2>
<table class="table">
        <thead>
            <tr>
              <th>Payer ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Num of Payments</th>
             </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $payer->payer_id }}</td>
              <td>{{ $payer->first_name . " " . $payer->last_name }}</td>
              <td>{{ $payer->email }}</td>
              <td>{{ $payer->payments->count() }}</td>
            </tr>
          </tbody>
    </table>

<h2>Payments by this customer</h2>
    <table class="table">
        <thead>
            <tr>
              <th>Date</th>
              <th>City</th>
              <th>Total Amount</th>
              <th>Shipped</th>
              <th>Documents</th>
            </tr>
          </thead>
          <tbody>
          @foreach($payer->payments as $payment)
            <tr>
              <td>{{ $payment->created_at->diffForHumans() }}</td>
              <td>{{ $payment->address ? $payment->address->city : "N/A" }}</td>
              <td>{{ $payment->transactions->first()->amount_total }}</td>
              <td>
                {!! Form::open() !!}
                    <div class="form-group">
                    {!! Form::checkbox('shipped', $payment->shipped, $payment->shipped) !!}
                    </div>
                {!! Form::close() !!}
              </td>
              <td><a href="/admins/payments/invoice/{{ $payment->id }}">Invoice</a></td>
            </tr>
            @endforeach
          </tbody>
    </table>

    @include('admin.layouts.partials.notes', ['notes' => $payer->notes])
    @include('admin/layouts/partials/_note', ['model' => $payer])
</div>
@stop