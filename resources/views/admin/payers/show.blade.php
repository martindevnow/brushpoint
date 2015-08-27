@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Customer Information</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('admin.layouts.panels._payer', ['payer' => $payer])
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Payments by this Customer
                    <span style="float: right;">
                        @include('admin.layouts.modals._note', ['model' => $payer, 'class' => 'btn-panel-heading'])
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

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

                                  <a href="/admins/payments/{{ $payment->id }}">
                                    <button class="btn btn-primary">
                                    <i class="fa fa-search "></i></button>
                                  </a>


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
                                @endforeach
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-9 -->
    </div>

    <div class="row" id="note_list">
        @foreach($payer->notes as $note)
            @include('admin.ajax.single._note', ['note' => $note])
        @endforeach
    </div>

</div>
@stop