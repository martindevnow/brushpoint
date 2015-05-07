@extends('layouts.zeina')

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
                <h1>Thank you!</h1>


                <p>Dear <b>{{ $payment->payer->first_name }} {{ $payment->payer->last_name }}</b>, an email has been sent to <b>{{ $payment->payer->email }}</b> with the details of your order.</p>
                <p>Orders generally ship out within 1-2 business days depending on the volume of orders. Orders are not processed on weekends or holidays.</p>
                <p>Shipping times depend on the destination. Please allow 5-10 business days for delivery.</p>
                <p>Thank you for choosing BrushPoint Innovations!</p>
            </div>
        </div>
    </div>
</div>
@stop


@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop