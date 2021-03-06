@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Retailer: {{ $retailer->name }}</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>




    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Retailer
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table form-table">
                        <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Active</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="/admins/retailers/{{ $retailer->id }}">{{ $retailer->id }}</a></td>
                              <td>{{ $retailer->name }}</td>
                              <td>
                                  <div class="form-group">
                                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/retailers/ajax/'. $retailer->id. '?field=active']) !!}
                                    {!! Form::checkbox('active', $retailer->active, $retailer->active, ['data-click-submits-form']) !!}
                                    {!! Form::close() !!}
                                  </div>
                              </td>
                            </tr>
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Feedback From this Retailer
            </div>
            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table form-table">
                        <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Lot Code</th>
                              <th>Issue</th>
                              <th>Date</th>
                              <th>Closed</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($retailer->feedbacks as $feedback)
                            <tr>
                              <td><a href="/admins/feedback/{{ $feedback->id }}">{{ $feedback->id }}</a></td>
                              <td>{{ $feedback->name }}</td>
                              <td>{{ $feedback->lot_code }}</td>
                              <td>
                                @if (isset($feedback->issue_id))
                                    [ <a href="{{ url('admins/issues/'. $feedback->issue->id) }}"> {{ $feedback->issue->type }} </a> ]
                                @endif

                                {{ $feedback->issue_text }}


                              </td>
                              <td>{{ $feedback->created_at->diffForHumans() }}</td>
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
            </div>
        </div>
    </div>
</div>

<div class="flash">
    Updated...
</div>

@stop