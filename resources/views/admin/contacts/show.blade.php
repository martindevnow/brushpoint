@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Contact from ...</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th>Email</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $contact->created_at->diffForHumans() }}</td>
              <td>{{ $contact->name }} </td>
              <td>{{ $contact->email }} </td>
              <td>{{ $contact->message }} </td>
            </tr>
          </tbody>
    </table>
</div>

<div class="flash">
    Updated...
</div>

@stop