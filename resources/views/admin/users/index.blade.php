@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Accounts</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>
   <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users

                {{--<a href="/admins/feedback/create" style="float: right;">--}}
                    {{--<button class="btn btn-primary btn-panel-heading btn-focus">Create</button>--}}
                {{--</a>--}}
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Date Created</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th> </th>
                              <th> </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($users as $user)
                            <tr>
                              <td>{{ $user->created_at->diffForHumans() }}</td>
                              <td><a href="/admins/users/{{ $user->id }}">{{ $user->name }}</a></td>
                              <td><a href="/admins/users/{{ $user->id }}">{{ $user->email }}</a></td>
                              <td>
                                  <a href="/admins/users/{{ $user->id }}">
                                    <button class="btn btn-primary">
                                    <i class="fa fa-search "></i></button>
                                  </a>
                              </td>
                              <td>

                                  <a href="/admins/users/{{ $user->id }}">
                                    <button class="btn btn-primary">
                                    <i class="fa fa-edit "></i> Edit</button>
                                  </a>
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
@stop