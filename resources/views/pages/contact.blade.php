
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/contact";
    $page['title'] = "Contact Us";
    $page['short_title'] = "Contact";
    $page['short_description'] = "General Inquiries"
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

            <p class="body_paragraph">
                Our head office is located in King City, Ontario Canada. For more information or questions please fill
                out the form below with your name, email and message. Please provide all relevant information so that
                we may respond to your inquiry as soon as possible.
            </p>

            <form class="form-wrapper" id="contact-form" method="post" role="form" novalidate>

                <div class="form-group clearfix">
                    <label class="control-label" for="name">Name *</label>
                    <div class="col-xs-6">
                        <input type="text" id="name" name="name" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="control-label" for="user-email"> E-mail *</label>
                    <div class="col-xs-6">
                        <!-- type email used by jquery validate -->
                        <input type="text" name="email" id="user-email" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="control-label" for="message">  Message *</label>
                    <div class="col-xs-6">
                        <!-- type email used by jquery validate -->
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                </div>


                <div class="form-group clearfix">
                    <label class="control-label"></label>
                    <div class="col-xs-6">
                        <input type="submit" value="Send" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
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