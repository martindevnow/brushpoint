@extends('layouts.admin')


@section('content')

<div class="container">
<div class="row">
    <div class="col-lg-8">
        <table class="table form-table">
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
                  <td>{{ $feedback->retailer }}</td>
                </tr>
                <tr>
                  <td>Lot Code</td>
                  <td>{{ $feedback->lot_code }}</td>
                </tr>
                <tr>
                  <td>Issue <br />
                        @if (isset($feedback->issue_id))
                            {{ $feedback->issue->type }}
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
    </div>
    <div class="col-lg-4">
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
                      {!! Form::checkbox('closed', $feedback->closed, $feedback->closed) !!}
                      </div>
                  {!! Form::close() !!}
                  </td>
                </tr>
              </tbody>
        </table>


            @include('admin.feedback.partials._issue')

    </div>
</div>


    @include('admin.layouts.partials.notes', ['notes' => $feedback->notes])

    @include('admin.layouts.partials._note', ['model' => $feedback])
</div>

<div class="flash">
    Updated...
</div>
@stop