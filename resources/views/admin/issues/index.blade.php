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


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Issues
                <span style="float: right">
                    @include('admin.feedback.modals._issue', ['feedback' => null,
                     'class' => 'btn-panel-heading btn-focus'])
                </span>
                {{--<a href="/admins/feedback/create" style="float: right;">--}}
                    {{--<button class="btn btn-primary btn-panel-heading btn-focus">Create</button>--}}
                {{--</a>--}}
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
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
            </div>
        </div>
    </div>
</div>
<div class="flash">
    Updated...
</div>

@stop