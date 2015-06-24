@extends('layouts.zeina')
<?php
$headTitleSubheading = "About Us";
$headMetaDescription = "Learn about BrushPoint Innovations and our wide selection of toothbrushes.
We offer state of the art power toothbrushes. Both battery and manual toothbrushes.
We also have rechargeable toothbrushes.";
?>
@section('header_inside')
    @include('zeina.js.fadeslider')
@stop

@section('header_bottom')
    <?php
    $page['link'] = "/about";
    $page['title'] = "About Us";
    $page['short_title'] = "About";
    $page['short_description'] = "Learn more about who we are!"
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')
<div class="section-content no-padding section-alter" style="padding-top: 0px; border: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 animated" data-animtype="fadeInLeft"
                 data-animrepeat="0"
                 data-speed="1s"
                 data-delay="0.4s">
                <div class="left-title">
                    <div class="heading-title">
                        <h2 class="h2-section-title left-text">About Brushpoint</h2>
                    </div>
                    <!-- <p>
                        Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudine odio.
                    </p> -->
                    <ul class="icons-list check-2 colored-list ">
    <li>Our focus is on developing consumer products with patented technology and proprietary design</li>
    <li>Our Management team has experience in the Global Oral Care industry with a number of firsts in both consumer and professional oral care devices during the past 10 years</li>
    <li>Our team was the first to develop the direct drive powered toothbrush system with licenses to multinational consumer product companies</li>
    <li>Our Sales & Marketing team have over 20 years experience in Health & Beauty products with Fortune 500 companies</li>
    <li>We hold several key oral care patented technologies that allow us to compete with the National Branded products</li>
    <li>Our Team has over 20 years experience in global sourcing of material and finished goods</li>
</ul>
                </div>
            </div>


            <div class="col-md-6 col-sm-6 animated" data-animtype="fadeInRight"
                 data-animrepeat="0"
                 data-speed="1s"
                 data-delay="0.4s">
                <div id='fadeshow1'></div>

            </div>
        </div>
    </div>
</div>

@stop


@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop