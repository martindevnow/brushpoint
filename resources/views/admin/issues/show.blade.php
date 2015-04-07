@extends('layouts.admin')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Issues</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>

        <table class="table form-table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <!--  <th>Email</th>
                        <th>Phone</th> -->
                  <th>Complaint</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="/admins/issues/{{ $issue->id }}">{{ $issue->id }}</a></td>
                  <td>{{ $issue->type }}</td>
                  <td>
                      <div class="form-group">
                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/issues/ajax/'. $issue->id. '?field=complaint']) !!}
                        {!! Form::checkbox('complaint', $issue->complaint, $issue->complaint, ['data-click-submits-form']) !!}
                        {!! Form::close() !!}
                      </div>
                  </td>
                </tr>
              </tbody>
        </table>

        <table class="table form-table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <!--  <th>Email</th>
                        <th>Phone</th> -->
                  <th>Retailer</th>
                  <th>Lot Code</th>
                  <th>Issue</th>
                  <th>Date</th>
                  <th>Resolved</th>
                  <th>Closed</th>
                </tr>
              </thead>
              <tbody>
                @foreach($issue->feedbacks as $feedback)
                <tr>
                  <td><a href="/admins/feedback/{{ $feedback->id }}">{{ $feedback->id }}</a></td>
                  <td>{{ $feedback->name }}</td>
                  <!--  <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->phone }}</td> -->
                  <td>

                      @if (isset($feedback->retailer_id))
                          <a href="{{ url('admins/retailers/'. $feedback->retailer->id) }}"> {{ $feedback->retailer->name }}</a>
                      @else
                          {{ $feedback->retailer_text }}
                      @endif

                  </td>
                  <td>{{ $feedback->lot_code }}</td>
                  <td>{{ $feedback->issue_text }}</td>
                  <td>{{ $feedback->created_at->diffForHumans() }}</td>
                  <td>
                      <div class="form-group">
                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=resolved']) !!}
                        {!! Form::checkbox('resolved', $feedback->resolved, $feedback->resolved, ['data-click-submits-form']) !!}
                        {!! Form::close() !!}
                      </div>
                  </td>

                  <td>
                      <div class="form-group">
                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id .'?field=closed']) !!}
                        {!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form']) !!}
                        {!! Form::close() !!}
                      </div>
                  </td>

                </tr>
                @endforeach
              </tbody>
        </table>

    </div>
<div class="flash">
    Updated...
</div>

@stop