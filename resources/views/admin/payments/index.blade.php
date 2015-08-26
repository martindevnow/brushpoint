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



        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Payments
                    {{--<a href="/admins/feedback/create" style="float: right;">--}}
                        {{--<button class="btn btn-primary btn-panel-heading btn-focus">Create</button>--}}
                    {{--</a>--}}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>Name</th>
                                  <th>City</th>
                                  <th>Total Amount</th>
                                  <th>Shipped</th>
                                  <th>Documents</th>
                                  <th>More</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                  <td>{{ $payment->created_at->diffForHumans() }}</td>
                                  <td>{!! $payment->payer? '<a href="'. url('/') . '/admins/payers/' . $payment->payer->id . '">'. $payment->payer->first_name . " " . $payment->payer->last_name .'</a>': "Not Completed Yet" !!}</td>
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
                                  <td><a href="/admins/payments/{{ $payment->id }}">
                                      <button class="btn btn-primary">
                                      <i class="fa fa-search "></i></button>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="flash">
    Updated...
</div>

@stop