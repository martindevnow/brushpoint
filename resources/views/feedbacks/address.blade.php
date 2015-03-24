
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
                Thank you for submitting your feedback.
                In order for us to send you a replacement for your purchase, please provide the address to which we can send it.
                Thank you!
            </p>


        {!! Form::open(['method' => 'post', 'url' => 'feedback/address']) !!}
            @include('layouts.partials._address')
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