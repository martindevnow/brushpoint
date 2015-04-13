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
                  <th>Received</th>
                  <th>Closed</th>
                </tr>
              </thead>
              <tbody>
                @foreach($feedbacks as $feedback)
                <tr>
                  <td><a href="/admins/feedback/{{ $feedback->id }}">{{ $feedback->id }}</a></td>
                  <td>{{ $feedback->name }}</td>
                  <!--  <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->phone }}</td> -->
                  @if(isset($feedback->retailer_id))
                    <td><a href="/admins/retailers/{{ $feedback->retailer->id }}">{{ $feedback->retailer->name }}</a></td>
                  @else
                    <td>{{ $feedback->retailer_text }}</td>
                  @endif
                  <td>{{ $feedback->lot_code }}</td>
                  <td>{{ $feedback->issue_text }}</td>
                  <td>{{ $feedback->created_at->diffForHumans() }}</td>
                  <td>
                      <div class="form-group">
                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/feedback/ajax/'. $feedback->id . '?field=closed']) !!}
                        {!! Form::checkbox('closed', $feedback->closed, $feedback->closed, ['data-click-submits-form']) !!}
                        {!! Form::close() !!}
                      </div>
                      @if($feedback->closed_at != "0000-00-00 00:00:00")
                        [[ {{ $feedback->closed_at }} ]]
                      @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>

        {!!  $feedbacks->render() !!}
    </div>
<div class="flash">
    Updated...
</div>

@stop