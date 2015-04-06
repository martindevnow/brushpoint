
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/feedback";
    $page['title'] = "Feedback";
    $page['short_title'] = "Feedback";
    $page['short_description'] = "Product Feedback"
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="jumbotron">
              <h1>Thank you!</h1>
              <i><p>We appreciate your feedback regarding our products. <br />We value all of our customer's feedback.</p></i>
              <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> -->
            </div>
              <h3>We will review your claim and one of our Quality Assurance Specialists will get back to you within 5-7 business days.</h3>

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