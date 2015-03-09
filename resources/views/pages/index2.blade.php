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

            <div class="col-md-4 col-sm-4">
                <div class="center-title">
                    <div class="heading-title">
                        <!-- <h2 class="h2-section-title">Brushpoint</h2> -->
                        <img src="/images/logo/brushpoint.jpg" width="500" height="222" class="img-responsive">
                    </div>
                 </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <p><br /><br />
                    BrushPoint Innovations Inc. is a privately held company that focuses on patented consumer Oral Care technology and products for global retailers in the area of
                    Private Label and Branded products.
                    <br/>
                    We pride ourselves on quality products that deliver innovation and uniqueness for our retail Customers' private brand offering to their valued consumer base.
                </p>
            </div>

<!--
            <div class="col-md-12 col-sm-12">
                <div class="center-title">
                    <div class="heading-title">
                        <img src="/images/logo/brushpoint.jpg" width="500" height="222" class="img-responsive">
                    </div>
                    <br /><br />
                    <p>
                        BrushPoint Innovations Inc. is a privately held company that focuses on patented consumer Oral Care technology and products for global retailers in the area of
                        Private Label and Branded products.
                        <br/>
                        We pride ourselves on quality products that deliver innovation and uniqueness for our retail Customers' private brand offering to their valued consumer base.
                    </p>
                </div>
            </div> -->
        </div>
    </div>
@stop
@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop