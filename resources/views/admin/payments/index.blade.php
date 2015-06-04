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
              <td>{{ $payment->payer? $payment->payer->first_name . " " . $payment->payer->last_name: "Not Completed Yet" }}</td>
              <td>{{ $payment->address ? $payment->address->city: "Not Entered Yet" }}</td>
              <td>{{ $payment->transactions->first()? $payment->transactions->first()->amount_total: "Not completed Yet" }}</td>
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
              <td><a href="/admins/payments/invoice/{{ $payment->id }}">Invoice</a></td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>

<div class="flash">
    Updated...
</div>

@stop