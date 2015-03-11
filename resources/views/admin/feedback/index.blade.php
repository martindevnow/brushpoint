@extends('layouts.admin')

@section('content')
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <!--  <th>Email</th>
                        <th>Phone</th> -->
                  <th>Retailer</th>
                  <th>Lot Code</th>
                  <th>Issue</th>
                  <th>Date</th>
                  <th>Resolved</th>
                </tr>
              </thead>
              <tbody>
                @foreach($feedbacks as $feedback)
                <tr>
                  <td><a href="/admins/feedback/{{ $feedback->id }}">{{ $feedback->id }}</a></td>
                  <td>{{ $feedback->name }}</td>
                  <!--  <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->phone }}</td> -->
                  <td>{{ $feedback->retailer }}</td>
                  <td>{{ $feedback->lot_code }}</td>
                  <td>{{ $feedback->issue }}</td>
                  <td>{{ $feedback->created_at->diffForHumans() }}</td>
                  <td>
                  {!! Form::open() !!}
                      <div class="form-group">
                      {!! Form::checkbox('resolved', $feedback->resolved, $feedback->resolved) !!}
                      </div>
                  {!! Form::close() !!}
                  </td>

                </tr>
                @endforeach
              </tbody>
        </table>
    </div>


@stop