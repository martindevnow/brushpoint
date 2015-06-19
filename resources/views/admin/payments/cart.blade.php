@extends('layouts.admin')

@section('content')
<div class="container">

    {!! Form::open(['method' => 'post', 'url' => '/admins/payments/processOrder']) !!}
           @include('admin.payments.forms._cart', ['items' => $items])
    {!! Form::submit('Process Order') !!}
    {!! Form::close() !!}

</div>
@stop