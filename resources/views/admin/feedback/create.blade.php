@extends('layouts.admin')


@section('content')
<div class="container">
  {!! Form::open(['method' => 'post', 'url' => 'admins/feedback']) !!}
    <table class="table form-table">
        <thead>
            <tr>
              <th>Field</th>
              <th>Content</th>
            </tr>
          </thead>
          <tbody>
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
                            {!! Form::label('intent', 'General:') !!}
                            {!! Form::radio('intent', 'general', false, ['style' => 'height:24px;width:100%;']) !!}
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
 {!! Form::close() !!}
</div>
@stop