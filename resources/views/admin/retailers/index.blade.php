@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Retailers</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Retailers
                    <span style="float: right">
                        @include('admin.feedback.modals._retailer', [
                            'feedback' => null,
                            'class' => 'btn-panel-heading btn-focus'
                        ])
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
                                  <th>Name</th>
                                  <th>#</th>
                                  <th>Active</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($retailers as $retailer)
                                <tr>
                                  <td><a href="/admins/retailers/{{ $retailer->id }}">
                                      <button class="btn btn-primary">
                                      <i class="fa fa-search "></i></button>
                                      </a>
                                  </td>
                                  <td>{{ $retailer->name }}</td>
                                  <td>{{ $retailer->feedbacks->count() }}</td>
                                  <td>
                                      <div class="form-group">
                                        {!! Form::open(['data-remote', 'method' => 'patch', 'url' => 'admins/retailers/ajax/'. $retailer->id. '?field=active']) !!}
                                        {!! Form::checkbox('active', $retailer->active, $retailer->active, ['data-click-submits-form']) !!}
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
        <div class="col-md-3">
        </div>
    </div>
</div>
<div class="flash">
    Updated...
</div>

@stop