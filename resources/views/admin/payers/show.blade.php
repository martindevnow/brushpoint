@extends('layouts.admin')

@section('content')
<div class="container">

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
              <td>{{ $payment->addresses->first()->city }}</td>
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
            @endforeach
          </tbody>
    </table>

    @include('admin/layouts/partials/_note', ['model' => $payment])
</div>
@stop