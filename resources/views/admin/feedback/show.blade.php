@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Feedback: {{ $feedback->id }}  Received: {{ $feedback->created_at->diffForHumans() }}</h1>
        </div>
        {{--<div class="col-lg-3" style="margin-top: 10px;">--}}
        {{--</div>--}}
    </div>

    {{--Start Row--}}
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-cog fa-fw"></i> Actions
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                            @include('admin.feedback.modals._contactCustomer', ['class' => 'btn-block'])

                            {{--Adding New Buttons--}}
                            @if(!$feedback->issue)
                                @include('admin.feedback.modals._issue', ['class' => 'btn-block'])
                            @endif

                            @if(!$feedback->retailer)
                                @include('admin.feedback.modals._retailer', ['class' => 'btn-block'])
                            @endif

                            @include('admin.layouts.modals._note', ['model' => $feedback, 'class' => 'btn-block'])
                            @include('admin.layouts.modals._attachment', ['model' => $feedback, 'class' => 'btn-block'])
                            @include('admin.layouts.modals._address', ['model' => $feedback, 'class' => 'btn-block'])

                        <a href="#close">
                        <button class="btn btn-unchecked btn-close">
                            <i class="fa fa-times"></i> Close
                        </button>
                        </a>


                        <a href="#close">
                        <button class="btn btn-checked btn-closed">
                            <i class="fa fa-check"></i> Closed
                        </button>
                        </a>
                    </div>
                    <!-- /.list-group -->
                    {{--<a href="#" class="btn btn-default btn-block">View All Alerts</a>--}}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->



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
        <!-- /.col-md-3 -->


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Feedback
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
                                          <td>Date</td>
                                          <td>{{ $feedback->created_at }}</td>
                                        </tr>
                                        <tr>
                                          <td>Name</td>
                                          <td>{{ $feedback->name }} </td>
                                        </tr>
                                        <tr>
                                          <td>Email</td>
                                          <td>{{ $feedback->email }}</td>
                                        </tr>
                                        <tr>
                                          <td>Phone</td>
                                          <td>{{ $feedback->phone }}</td>
                                        </tr>
                                        <tr>
                                          <td>Retailer</td>
                                          <td>

                                            @if (isset($feedback->retailer_id))
                                                <a href="{{ url('admins/retailers/'. $feedback->retailer->id) }}"> {{ $feedback->retailer->name }}</a> <a href="/admins/feedback/{{ $feedback->id }}/retailer/remove">[Remove]</a>
                                            @else
                                                {{ $feedback->retailer_text }}
                                              {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=retailer_id' ]) !!}
                                                  <div class="form-group">
                                                  {!! Form::select('retailer_id', $retailers, null, ['data-click-submits-form']) !!}
                                                  </div>
                                              {!! Form::close() !!}
                                              @if(!$feedback->issue)
                                              @endif
                                            @endif
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Lot Code</td>
                                          <td>{{ $feedback->lot_code }}</td>
                                        </tr>
                                        <tr>
                                          <td>Issue</td>
                                          <td>
                                              @if (isset($feedback->issue_id))
                                                  <a href="{{ url('admins/issues/'. $feedback->issue->id) }}"> {{ $feedback->issue->type }} </a> <a href="/admins/feedback/{{ $feedback->id }}/issue/remove/">[Remove]</a>
                                              @else
                                                {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=issue_id' ]) !!}
                                                    <div class="form-group">
                                                    {!! Form::select('issue_id', $issues, null, ['data-click-submits-form']) !!}
                                                    </div>
                                                {!! Form::close() !!}
                                              @endif
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
    </div>

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