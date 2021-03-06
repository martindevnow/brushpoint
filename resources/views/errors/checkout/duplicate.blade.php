@extends('layouts.zeina')
<?php
$headTitleSubheading = "Duplicate";
$headMetaDescription = "This payment has already been processed. Please do not refresh the page.
You can check your email for a confirmation notification. Thank you.";
?>
@section('header_inside')
    @include('zeina.js.fadeslider')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/cart";
    $page['title'] = "Purchase Complete";
    $page['short_title'] = "Thank You";
    $page['short_description'] = "Your purchase has been completed."
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')
<div class="section-content no-padding section-alter" style="padding-top: 0px; border: 0;">
    <div class="container">
        <div class="row">
            <div class="jumbotron">
            <h1>Duplicate Entry - Please do not refresh the page</h1>
            </div>

            <p>Dear {{ $customer_name }}, an email has been sent to {{ $customer_email }} with the details of your order.</p>
            <p>Orders generally ship out within 1-2 business days depending on the volume of orders. Orders are not processed on weekends or holidays.</p>
        </div>
    </div>
</div>
@stop


@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop