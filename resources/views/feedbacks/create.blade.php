
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

            <p class="body_paragraph">
                If you have any feedback for us, we'd love to hear it! Tell us about any issues you've had with
                our products and we'll happily take care of it for you! Just fill out the forms below and we'll
                be sure to respond to you as soon as possible! The more information you provide, the better we
                can assist you!
            </p>

            <form class="form-wrapper" id="contact-form" method="post" role="form" novalidate>
                <div class="col-md-12">
                    <div class="form-group clearfix">
                        <label class="control-label" for="name">Name *</label>
                        <div class="col-xs-6">
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        <label class="control-label" for="user-email"> E-mail *</label>
                        <div class="col-xs-6">
                            <!-- type email used by jquery validate -->
                            <input type="text" name="email" id="user-email" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        <label class="control-label" for="phone">Phone *</label>
                        <div class="col-xs-6">
                            <input type="text" id="phone" name="phone" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        <label class="control-label" for="retailer">Retailer *</label>
                        <div class="col-xs-6">
                            <input type="text" id="retailer" name="retailer" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group clearfix">
                        <label class="control-label" for="lotcode">Lot Code *</label>
                        <div class="col-xs-6">
                            <input type="text" id="lotcode" name="lotcode" class="form-control" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="control-label" for="issue">  Issue *</label>
                    <div class="col-xs-6">
                        <!-- type email used by jquery validate -->
                        <textarea name="issue" id="issue" class="form-control" required></textarea>
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