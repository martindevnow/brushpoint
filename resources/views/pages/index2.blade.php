@extends('layouts.zeina')

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
                    <br /><br /><img src="/images/logo/brushpoint.jpg" width="250" height="111" class="img-responsive">
                 </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <p style="font-size: 1.5em"><br /><br />
                    <b>BrushPoint Innovations Inc.</b> is a privately held company that focuses on patented consumer Oral Care technology and products for global retailers in the area of
                    Private Label and Branded products.
                    <br/><br />
                    We pride ourselves on quality products that deliver innovation and uniqueness for our retail Customers' private brand offering to their valued consumer base.
                </p>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop