
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/feedback";
    $page['title'] = "Product Feedback";
    $page['short_title'] = "Feedback";
    $page['short_description'] = "";
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')

<div class="container">
   <div class="row">
        <div class="col-md-9 col-sm-9">
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



            {!! Form::open(['method' => 'POST', 'url' => 'feedback/send', 'id' => 'bp-contact-form', 'class'=>'form-wrapper']) !!}
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

                <!-- Address Form Input
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div> -->


                <!-- Retailer Form Input -->
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('retailer', 'Retailer *', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('retailer', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>

                <!-- Lot Code Form Input -->
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        {!! Form::label('lot_code', 'Lot Code', ['class' => 'control-label']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('lot_code', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>


                <!-- Lot Code Form Input -->
                <div class="col-md-12">
                    <div class="form-group clearfix">
                        {!! Form::label('issue_text', 'Issue *', ['class' => 'control-label']) !!}
                        <div class="col-xs-10">
                            {!! Form::textarea('issue_text', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::submit('Send Feedback', ['class' => 'btn btn-primary']) !!}


            {!! Form::close() !!}



        </div>
        <div class="col-md-3 col-sm-3">

            <!-- Contact Info -->
            <div class="sidebar-block">
                <h3 class="h3-sidebar-title">
                    Contact Us
                </h3>
                <div class="sidebar-icon-item">
                    <i class="icon-phone"></i> (+1) 866 402-7874
                </div><div class="sidebar-icon-item">
                    <i class="icon-phone"></i> (+1) 866 40 BRUSH
                </div>
                <div class="sidebar-icon-item">
                    <i class="icon-envelope-alt"></i> info@brushpoint.com
                </div><div class="sidebar-icon-item">
                    <i class="icon-envelope-alt"></i> sales@brushpoint.com
                </div>
                <div class="sidebar-icon-item">
                    <i class="icon-home"></i> 2189 King Road, King City, Ontario, Canada, L7B 1G3
                </div>
            </div>
            <!-- //Contact Info// -->


            <!-- //Contact Map// -->
            <h3 class="h3-sidebar-title">
                OUR Map
            </h3>
            <!--
            <div class="contact-map2" id="contact_map"></div>
            -->
            <div>
            <iframe width="213" height="255" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=Brushpoint%20Innovations%2C%20King%20Road%2C%20King%20City%2C%20ON%2C%20Canada&key=AIzaSyClAhbZ3QFaaVRvOSxhQ0ZEbsTP_8OaWuI"></iframe>
            </div>
            <!-- //Contact Map// -->

        </div>
    </div>
</div>
@stop