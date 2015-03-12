@extends('layouts.zeina')

@section('header_bottom')
    <?php
    $page['link'] = "/cart";

    $page['title'] = "Cart";
    $page['short_title'] = "Cart";
    $page['short_description'] = "Confirm Quantity";

    $showCart = true;
    $hideBreadcrumb = true;

    ?>

    @include('zeina.top-title-wrapper', ['page' => $page])
@stop
@section('content')
<div class="container">
    <div class="row">
        <!-- Address Forms -->
        <div class="col-md-9">
            {!! Form::open(['method' => 'POST', 'action' => 'FeedbackController@store', 'id' => 'contact-form', 'class'=>'form-wrapper']) !!}
                <h1>Contact Information</h1>

                <div class="row">
                    <!-- Name Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('name', 'Name *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Email Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('email', 'Email *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Phone Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('phone', 'Phone *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('phone', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <hr />
                    <h1>Shipping Address Information</h1>

                    <!-- Address Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('street_1', 'Street', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('street_1', null, ['class' => 'form-control']) !!}
                                {!! Form::text('street_2', null, ['class' => 'form-control']) !!}

                            </div>
                        </div>
                    </div>

                    <!-- Retailer Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('city', 'City *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('city', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Retailer Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('province', 'State *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('province', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Retailer Form Input -->
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('postal_code', 'Zip/Postal *', ['class' => 'control-label']) !!}
                            <div class="col-xs-8">
                                {!! Form::text('postal_code', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- // Address Forms -->


        <!-- Cart Contents -->
        <div class="col-md-3">

        </div>
        <!-- // Cart Contents -->
    </div>
</div>

@stop