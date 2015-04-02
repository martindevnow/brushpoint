@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Payments</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $payments->render() !!}
        </div>
    </div>
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
            @foreach($payments as $payment)
            <tr>
              <td>{{ $payment->created_at->diffForHumans() }}</td>
              <td>{{ $payment->payer->first_name . " " . $payment->payer->last_name }}</td>
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
</div>
@stop