
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/feedback";
    $page['title'] = "Contact";
    $page['short_title'] = "Contact";
    $page['short_description'] = "";
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')
  <script>
      $(function() {
        $( document ).tooltip();
      });
  </script>
  <style>
      label {
        display: inline-block;
        width: 5em;
      }
  </style>


<div class="container">
   <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="row">
                <h3 class="h3-body-title">
                    Leave A Message
                </h3>

                @include('errors.list')

                <p class="body_paragraph">
                    If you have any feedback for us, we'd love to hear it! Tell us about any issues you've had with
                    our products and we'll happily take care of it for you! Just fill out the forms below and we'll
                    be sure to respond to you as soon as possible! The more information you provide, the better we
                    can assist you!
                </p>
            </div>
            <div class="row">

            {!! Form::open(['method' => 'POST', 'url' => 'feedback/send', 'id' => 'bp-contact-form', 'class'=>'form-wrapper']) !!}
                <!-- Name Form Input -->
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('name', 'Name *', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'title' => 'Please enter your full name.']) !!}
                        </div>
                    </div>
                </div>

                <!-- Email Form Input -->
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('email', 'Email *', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('email', null, ['class' => 'form-control', 'required', 'title' => 'Where can we contact you?']) !!}
                        </div>
                    </div>
                </div>

                <!-- Phone Form Input -->
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('phone', 'Phone *', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('phone', null, ['class' => 'form-control', 'required', 'title' => 'Where can we reach you?']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 5px;">
                <h3>Nature of Inquiry: </h3>
                    <!-- product Form Input -->
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        {!! Form::label('intent', 'Product Feedback:') !!}
                        {!! Form::radio('intent', 'product', false, ['style' => 'height:24px;width:24px;']) !!}
                    </div>

                    <!-- product Form Input -->
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        {!! Form::label('intent', 'Sales:') !!}
                        {!! Form::radio('intent', 'sales', false, ['style' => 'height:24px;width:24px;']) !!}
                    </div>

                    <!-- product Form Input -->
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        {!! Form::label('intent', 'Other:') !!}
                        {!! Form::radio('intent', 'other', false, ['style' => 'height:24px;width:24px;']) !!}
                    </div>

                </div>
            </div>
                <!-- Retailer Form Input -->
                <!--
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('retailer_text', 'Retailer', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('retailer_text', null, ['class' => 'form-control', 'title' => 'The store it was purchased from.']) !!}
                        </div>
                    </div>
                </div>
                -->

                <!-- Lot Code Form Input -->
                <!--
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('lot_code', 'Lot Code', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('lot_code', null, ['class' => 'form-control', 'title' => 'Found on the bottom of the toothbrush']) !!}
                        </div>
                    </div>
                </div> -->

            <div class="row">
                <!-- Issue Form Input -->
                <div class="col-md-12">
                    <div class="form-group clearfix">
                    <div class="col-xs-3">
                                            {!! Form::label('issue_text', 'Issue *', ['class' => 'control-label']) !!}

                    </div>
                        <div class="col-xs-9">
                            {!! Form::textarea('issue_text', null, ['class' => 'form-control', 'title' => 'Describe the problem you have with the toothbrush']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {!! Form::submit('Send Feedback', ['class' => 'btn btn-primary', 'style' => 'float: right;']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-3 col-sm-3">

            @include('pages.partials.contactSideBar')

        </div>
    </div>
</div>
@stop