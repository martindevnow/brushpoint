@extends('layouts.admin')

@section('content')
<div class="container">

    {!! Form::open(['method' => 'post', 'url' => '/admins/payments/createCart']) !!}
           @include('admin.payments.forms._create')

        {!! Form::submit('Go To Cart', ['class' => 'btn btn-sale']) !!}
    {!! Form::close() !!}


</div>
@stop