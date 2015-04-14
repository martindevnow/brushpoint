@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Users</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
              <th>Field</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Name: </td>
              <td><a href="/admins/users/{{ $user->id }}">{{ $user->name }}</a></td>
            </tr>
          </tbody>
    </table>
</div>
@stop