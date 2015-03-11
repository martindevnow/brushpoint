@extends('layouts.admin')


@section('content')

<div class="container">

        <table class="table">
            <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>ID / Date</td>
                  <td>{{ $feedback->id }} / {{ $feedback->created_at }}</td>
                </tr>
                <tr>
                  <td>Name / Email / Phone</td>
                  <td>{{ $feedback->name }} / {{ $feedback->email }} / {{ $feedback->phone }}</td>
                </tr>
                <tr>
                  <td>Retailer / Lot Code</td>
                  <td>{{ $feedback->retailer }} / {{ $feedback->lot_code }}</td>
                </tr>
                <tr>
                  <td>Issue</td>
                  <td>{{ $feedback->issue }}</td>
                </tr>
                <tr>
                  <td>
                  Conditions
                  </td>
                  <td>
                  {!! Form::open() !!}
                      <div class="form-group">
                      Resolved: {!! Form::checkbox('resolved', $feedback->resolved, $feedback->resolved) !!}
                      </div>
                  {!! Form::close() !!}
                  </td>
                </tr>
              </tbody>
        </table>
    </div>
@stop