@extends('layouts.zeina')
<?php
$headTitleSubheading = "Home Page";
$headMetaDescription = "BrushPoint Innovations is an industry leader specializing in private label oral
care products. Take a look at our wide selection of battery, manual and rechargeable toothbrushes.
These are available in a variety of colours or characters for our children's toothbrushes.";
?>


@section('header_inside')
    <link rel="stylesheet" href="/css/footer-tech2.css">
@stop

@section('header_bottom')

    <?php
    $page['link'] = "";
    $page['title'] = "";
    $page['short_title'] = "";
    $page['short_description'] = "";

    $showCart = false;
    $hideBreadcrumb = false;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])
    @include('zeina.js.flexslider')
@stop



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="center-title">
                    <br /><br /><img src="/images/ranir.png" width="250" height="111" class="img-responsive">
                </div>
                {{--<div class="center-title">--}}
                    {{--<br /><br /><img src="/images/logo/brushpoint.jpg" width="250" height="111" class="img-responsive">--}}
                {{--</div>--}}
            </div>
            <div class="col-md-9 col-sm-8">
                <p style="font-size: 1.5em"><br /><br />
                    Brushpoint Innovations Inc. is now
                    part of the Ranir family of oral care
                    products! <br /><br />
                    As a leading global
                    manufacturer of oral and personal
                    healthcare products, we’re
                    committed to delivering exceptional
                    quality and value each and every day.
                    Through teamwork, product
                    development and consultative
                    solutions, we help our customers win
                    with their consumers.
                </p>
                <p style="font-size: 1.5em; padding-top: 25px">Please visit Ranir’s full line of
                    products, services, and solutions at
                    <a href="http://www.ranir.com">www.ranir.com</a>.</p>

            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop