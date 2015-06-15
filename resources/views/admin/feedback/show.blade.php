@extends('layouts.admin')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <table class="table form-table">
                <thead>
                    <tr>
                      <th style="width: 25%;">Field</th>
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
                      <td>Issue <br />
                            @if (isset($feedback->issue_id))
                                <a href="{{ url('admins/issues/'. $feedback->issue->id) }}"> {{ $feedback->issue->type }} </a> <a href="/admins/feedback/{{ $feedback->issue->id }}/issue/remove/">[Remove]</a>
                            @else
                              {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=issue_id' ]) !!}
                                  <div class="form-group">
                                  {!! Form::select('issue_id', $issues, null, ['data-click-submits-form']) !!}
                                  </div>
                              {!! Form::close() !!}
                            @endif
                       </td>
                      <td>{{ $feedback->issue_text }}</td>
                    </tr>
                  </tbody>
            </table>
              @include('admin.feedback.partials._contactCustomer')
        </div>


        <div class="col-lg-4">
            <table class="table form-table">
                <thead>
                    <tr>
                      <th style="width: 25%">Field</th>
                      <th>Content</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                      Adverse Event
                      </td>
                      <td>
                      {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=adverse_event' ]) !!}
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
                      {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=health_canada_report' ]) !!}
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
                      {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=capa_required' ]) !!}
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
                      {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=closed' ]) !!}
                          <div class="form-group">
                          {!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form']) !!}
                          </div>
                      {!! Form::close() !!}
                      </td>
                    </tr>
                  </tbody>
            </table>





            @if(!$feedback->issue)
                @include('admin.feedback.partials._issue')
            @endif


            @if(!$feedback->retailer)
                @include('admin.feedback.partials._retailer')
            @endif

            @include('admin.layouts.partials._note', ['model' => $feedback])

        </div>
    </div>


    <div class="row" id="investigations_list">
        @foreach($feedback->investigations as $investigation)
            @include('admin.feedback.partials.investigation', ['investigation' => $investigation])
        @endforeach
    </div>


    <div class="row" id="contact_list">
        @foreach($feedback->contacts as $contact)
            @include('admin.layouts.partials.contact', ['contact' => $contact])
        @endforeach
    </div>


    <div class="row" id="customer_request_list">
        @foreach($feedback->customerRequests as $customerRequest)
            @include('admin.layouts.partials.customerRequest', [
            'customerRequest' => $customerRequest,
            'feedback' => $feedback
           ])
        @endforeach
    </div>


    @include('admin.layouts.partials.notes', ['notes' => $feedback->notes])
</div>

<div class="flash">
    Updated...
</div>
@stop