@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Feedback: {{ $feedback->id }}  Received: {{ $feedback->created_at->diffForHumans() }}</h1>
        </div>
    </div>


{!! Form::open(['method' => 'patch', 'url' => '/admins/feedback/'. $feedback->id]) !!}
    {{--Start Row--}}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Feedback
                    {!! Form::submit('Save', [
                        'class' => 'btn btn-primary btn-panel-heading',
                        'style' => 'float: right;',
                    ]) !!}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                          <th>Field</th>
                                          <th>Content</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>ID</td>
                                          <td>{{ $feedback->id }}</td>
                                        </tr>
                                        <tr>
                                          <td>Received Date</td>
                                          <td>
                                            {!! Form::text('created_at', $feedback->created_at, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Name</td>
                                          <td>
                                            {!! Form::text('name', $feedback->name) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Email</td>
                                          <td>
                                            {!! Form::text('email', $feedback->email) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Phone</td>
                                          <td>
                                            {!! Form::text('phone', $feedback->phone) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>BP Code</td>
                                          <td>
                                            {!! Form::text('bp_code', $feedback->bp_code) !!}
                                          </td>
                                        </tr>
                                        <tr>
                                           <td>Intent</td>
                                           <td>
                                             <table>
                                                 <tr>
                                                     <td>
                                                         {!! Form::label('intent', 'Product:') !!}
                                                         {!! Form::radio('intent', 'product', ($feedback->intent=='product'?true:false), ['style' => 'height:24px;width:100%;']) !!}
                                                     </td>
                                                     <td>
                                                         {!! Form::label('intent', 'Sales:') !!}
                                                         {!! Form::radio('intent', 'sales', ($feedback->intent=='sales'?true:false), ['style' => 'height:24px;width:100%;']) !!}
                                                     </td>
                                                     <td>
                                                         {!! Form::label('intent', 'Other:') !!}
                                                         {!! Form::radio('intent', 'other', ($feedback->intent=='other'?true:false), ['style' => 'height:24px;width:100%;']) !!}
                                                     </td>
                                                 </tr>
                                             </table>
                                           </td>
                                         </tr>


                                        <tr>
                                          <td>Retailer</td>
                                          <td>
                                            {{ $feedback->retailer_text }}
                                              <div class="form-group">
                                              {!! Form::select('retailer_id', $retailers, $feedback->retailer_id) !!}
                                              </div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>Lot Code</td>
                                          <td>
                                          {!! Form::text('lot_code', $feedback->lot_code) !!}
                                          {{ $feedback->lot_code }}</td>
                                        </tr>

                                        <tr>
                                          <td>Issue</td>
                                          <td>
                                            <div class="form-group">
                                            {!! Form::select('issue_id', $issues, $feedback->issue_id) !!}
                                            </div>
                                            {{ $feedback->issue_text }}
                                          </td>
                                        </tr>


                                      </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Other
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table form-table">
                            <thead>
                                <tr>
                                  <th>Field</th>
                                  <th>Content</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                  Adverse Event
                                  </td>
                                  <td>
                                  {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajaxToggle/'. $feedback->id .'?field=adverse_event' ]) !!}
                                      <div class="form-group">
                                      {!! Form::checkbox('adverse_event', $feedback->adverse_event, $feedback->adverse_event, ['data-click-submits-form']) !!}
                                      </div>
                                  {!! Form::close() !!}
                                  </td>
                                </tr>
                                <tr>
                                  <td>Adverse Event Level</td>
                                  <td>
                                    {!! Form::text('adverse_event_level', null, ['class' => 'form-control']) !!}
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                  Health Canada Report
                                  </td>
                                  <td>
                                  {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajaxToggle/'. $feedback->id .'?field=health_canada_report' ]) !!}
                                      <div class="form-group">
                                      {!! Form::checkbox('health_canada_report', $feedback->health_canada_report, $feedback->health_canada_report, ['data-click-submits-form']) !!}
                                      </div>
                                  {!! Form::close() !!}
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                  CAPA Required
                                  </td>
                                  <td>
                                  {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajaxToggle/'. $feedback->id .'?field=capa_required' ]) !!}
                                      <div class="form-group">
                                      {!! Form::checkbox('capa_required', $feedback->capa_required, $feedback->capa_required, ['data-click-submits-form']) !!}
                                      </div>
                                  {!! Form::close() !!}
                                  </td>
                                </tr>
                                <tr>
                                  <td>CAPA Reason</td>
                                  <td>
                                    {!! Form::text('capa_reason', null, ['class' => 'form-control']) !!}
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                  Closed
                                  </td>
                                  <td>
                                  {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajaxToggle/'. $feedback->id .'?field=closed' ]) !!}
                                      <div class="form-group">
                                      {!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form']) !!}
                                      </div>
                                  {!! Form::close() !!}
                                  </td>
                                </tr>
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
{!! Form::close() !!}

    <hr />

    {{-- Adding the Lists of the Relationships --}}
    <div class="row" id="contact_list">
        @foreach($feedback->contacts as $contact)
            @include('admin.ajax.singles._contact', ['contact' => $contact])
        @endforeach
    </div>

    <div class="row" id="investigations_list">
        @foreach($feedback->investigations as $investigation)
            @include('admin.ajax.singles._investigation', ['investigation' => $investigation])
        @endforeach
    </div>

    <div class="row" id="customer_request_list">
        @foreach($feedback->customerRequests as $customerRequest)
            @include('admin.ajax.singles._customerRequest', [
            'customerRequest' => $customerRequest,
            'feedback' => $feedback
           ])
        @endforeach
    </div>

    <div class="row" id="note_list">
        @foreach($feedback->notes as $note)
            @include('admin.ajax.singles._note', ['note' => $note])
        @endforeach
    </div>

    <div class="row" id="address_list">
        @foreach($feedback->addresses as $address)
            @include('admin.ajax.singles._address', ['address' => $address])
        @endforeach
    </div>

    <div class="row" id="attachment_list">
        @foreach($feedback->attachments as $attachment)
            @include('admin.ajax.singles._attachment', ['attachment' => $attachment])
        @endforeach
    </div>
</div>

<div class="flash">
    Updated...
</div>
@stop