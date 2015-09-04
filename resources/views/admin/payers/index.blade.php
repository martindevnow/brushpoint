@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Customers</h1>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
             {!!  $payers->render() !!}
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Payers
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Payer ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Num of Payments</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach($payers as $payer)
                            <tr>
                              <td><a href="{{ url('/') }}/admins/payers/{{ $payer->id }}">{{ $payer->payer_id }}</a></td>
                              <td>{{ $payer->first_name . " " . $payer->last_name }}</td>
                              <td>{{ $payer->email }}</td>
                              <td>{{ $payer->payments->count() }}</td>
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