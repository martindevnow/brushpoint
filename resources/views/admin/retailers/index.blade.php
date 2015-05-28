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


        @include('admin.feedback.partials._retailer', ['feedback' => null])

        <table class="table form-table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                @foreach($retailers as $retailer)
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
                @endforeach
              </tbody>
        </table>




    </div>
<div class="flash">
    Updated...
</div>

@stop