@extends('layouts.admin')


@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Feedback >> Create</h1>
        </div>
    </div>

    {!! Form::open(['method' => 'post', 'url' => 'admins/feedback']) !!}
        {{--Start Row--}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cog fa-fw"></i>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">


                        <div class="row">
                            <div class="col-md-6">
                                <table class="table form-table">
                                    <thead>
                                        <tr>
                                          <th>Field</th>
                                          <th>Content</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>Received Date</td>
                                          <td>
                                              <div class="form-group">
                                                  {{--{!! Form::label('received_at', 'Date Received:') !!}--}}
                                                  {!! Form::text('received_at', date('m/d/Y'), ['class' => 'form-control', 'id' => 'datepicker']) !!}
                                              </div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>Name</td>
                                          <td><div class="form-group">
                                              {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                          </div></td>
                                        </tr>
                                        <tr>
                                          <td>Email</td>
                                          <td>
                                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Phone</td>
                                          <td>
                                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                          <td>Retailer</td>
                                          <td>
                                            {!! Form::select('retailer_id', $retailers, null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Retailer Reference Number</td>
                                          <td>
                                            {!! Form::text('retailer_reference', null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lot Code</td>
                                          <td>
                                            {!! Form::text('lot_code', null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>Issue</td>
                                          <td>
                                            {!! Form::select('issue_id', $issues, null, ['class' => 'form-control']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Intent</td>
                                          <td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        {!! Form::label('intent', 'Product:') !!}
                                                        {!! Form::radio('intent', 'product', false, ['style' => 'height:24px;width:100%;']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::label('intent', 'Sales:') !!}
                                                        {!! Form::radio('intent', 'sales', false, ['style' => 'height:24px;width:100%;']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::label('intent', 'Other:') !!}
                                                        {!! Form::radio('intent', 'other', false, ['style' => 'height:24px;width:100%;']) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                          </td>
                                        </tr>


                                        <tr>
                                          <td>Issue Description</td>
                                          <td><div class="form-group">
                                              {!! Form::textarea('issue_text', null, ['class' => 'form-control']) !!}
                                          </div></td>
                                        </tr>

                                      </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table form-table">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <td>BP Code</td>
                                          <td><div class="form-group">
                                              {!! Form::text('bp_code', null, ['class' => 'form-control']) !!}
                                          </div></td>
                                        </tr>
                                        <tr>
                                          <td>Country</td>
                                          <td><div class="form-group">
                                              {!! Form::text('country', null, ['class' => 'form-control']) !!}
                                          </div></td>
                                        </tr>
                                        <tr>
                                          <td>Adverse Event</td>
                                          <td>
                                            <div class="form-group">
                                              {!! Form::checkbox('adverse_event', false) !!}
                                            </div>
                                          </td>
                                        </tr><tr>
                                          <td>Adverse Event Level</td>
                                          <td>
                                            <div class="form-group">
                                              {!! Form::text('adverse_event_level', null, ['class' => 'form-control']) !!}
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Health Canada Report</td>
                                          <td>
                                            <div class="form-group">
                                              {!! Form::checkbox('health_canada_report', false) !!}
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>CAPA Required</td>
                                          <td>
                                            <div class="form-group">
                                              {!! Form::checkbox('capa_required', false) !!}
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>CAPA Reason</td>
                                          <td><div class="form-group">
                                              {!! Form::text('capa_reason', null, ['class' => 'form-control']) !!}
                                          </div></td>
                                        </tr>
                                        <tr>
                                          <td>Closed</td>
                                          <td>
                                            <div class="form-group">
                                              {!! Form::checkbox('closed', false) !!}
                                            </div>
                                          </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
   {!! Form::close() !!}
</div>
@stop