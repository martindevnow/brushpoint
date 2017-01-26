@extends('layouts.zeina')
<?php
$headTitleSubheading = "Purchase";
$headMetaDescription = "Not all of our products are available direct through our website.
However, we always ensure that we have the replacement heads in-stock for our customers.
If you wish to purchase our toothbrushes, you can find links to them on the retailers page.";
?>
@section('header_bottom')

    <?php
    $page['link'] = "/purchase";
    $page['title'] = "Purchase";
    $page['short_title'] = "Purchase";
    $page['short_description'] = "Shop around!";

     $showCart = false;
     $hideBreadcrumb = true;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')

        <div class="container" style="padding: 50px 0 50px 0">
            <div class="row">
                <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 animated fadeInLeft animatedVisi" data-animtype="fadeInLeft" data-animrepeat="0" data-speed="1s" data-delay="0.4s">
                    <div class="callout-box clearfix">

                        <div class="callout-content">
                            <h2>Thank you for visiting.</h2>
                            <p>These replacement parts and accessories are no longer available for purchase.</p>
                        </div>

                        {{--<a href="http://www.google.com" class="btn  btn-primary btn-small btn-full-width visible-xs ">Purchase Theme</a>--}}

                    </div>
                </div>
            </div>
        </div>

@stop