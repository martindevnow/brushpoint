@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Notifications</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $attentions->render() !!}
        </div>
    </div>
    <table class="table form-table">
        <thead>
            <tr>
              <th>Date</th>
              <th>Action</th>

              <th>Seen By</th>
              <th>Seen At</th>
            </tr>
          </thead>
          <tbody>
            @foreach($attentions as $attention)
            <tr>
              <td>{{ $attention->created_at }}</td>
              <td><a href="{{ $attention->getUrl() }}">{{ $attention->action }}</a></td>
              <td>{{ $attention->viewer->name }}</td>
              <td>{{ $attention->seen_at }}</td>
            </tr>
            @endforeach
          </tbody>
    </table>
    {!!  $attentions->render() !!}
</div>
<div class="flash">
    Updated...
</div>

@stop