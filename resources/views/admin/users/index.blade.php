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
              <th>Date Created</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $user->created_at->diffForHumans() }}</td>
              <td><a href="/admins/users/{{ $user->id }}">{{ $user->name }}</a></td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
@stop