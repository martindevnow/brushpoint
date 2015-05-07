
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
            @include('pages.partials.contactSideBar')
        </div>
    </div>
</div>
@stop