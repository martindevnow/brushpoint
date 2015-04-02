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
                @foreach($issues as $issue)
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
                @endforeach
              </tbody>
        </table>

    </div>
<div class="flash">
    Updated...
</div>

@stop