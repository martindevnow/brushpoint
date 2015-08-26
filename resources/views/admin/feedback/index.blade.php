@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Feedback</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $feedbacks->render() !!}
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Feedback
                <a href="/admins/feedback/create" style="float: right;">
                    <button class="btn btn-primary btn-panel-heading btn-focus">Create</button>
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th></th>
                              <th>Name</th>
                              <th>Retailer</th>
                              <th>Retailer Code</th>
                              <th>Lot Code</th>
                              <th>Issue</th>
                              <th>Intent</th>
                              <th>Received</th>
                              <th>Closed</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($feedbacks as $feedback)
                            <tr>
                              <td>
                              <a href="/admins/feedback/{{ $feedback->id }}">
                                <button class="btn btn-primary">
                                <i class="fa fa-search "></i></button>
                              </a></td>
                              <td>{{ $feedback->name }}</td>
                              @if(isset($feedback->retailer_id))
                                <td><a href="/admins/retailers/{{ $feedback->retailer->id }}">{{ $feedback->retailer->name }}</a></td>
                              @else
                                <td>{{ $feedback->retailer_text }}</td>
                              @endif
                              <td>{{ $feedback->retailer_reference }}</td>
                              <td>{{ $feedback->lot_code }}</td>
                              <td>{{ $feedback->issue_text }}</td>
                              <td>{{ $feedback->intent }}</td>
                              <td>{{ $feedback->created_at->diffForHumans() }}</td>
                              <td>
                                  <div class="form-group">
                                    {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id . '?field=closed']) !!}
                                    {!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form']) !!}
                                    {!! Form::close() !!}
                                  </div>
                                  @if($feedback->closed_at != "0000-00-00 00:00:00" && $feedback->closed_at != "-0001-11-30 00:00:00")
                                    [[ {{ $feedback->closed_at }} ]]
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


    {!!  $feedbacks->render() !!}
</div>
<div class="flash">
    Updated...
</div>

@stop