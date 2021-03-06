@extends('layouts.zeina')
<?php
$headTitleSubheading = "Address";
$headMetaDescription = "Please confirm your address for us so that we can send you a replacement toothbrush.";
?>
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
                Address Confirmation
            </h3>

            @include('errors.list')


            <p class="body_paragraph">
                Thank you for submitting your feedback.
                In order for us to send you a replacement for your purchase, please provide the address to which we can send it.
                Thank you!
            </p>


        {!! Form::open(['method' => 'post', 'url' => 'feedback/address/'.$feedback->id .'/'. $feedback->hash]) !!}
            @include('layouts.partials._address')
             <div class="form-group">
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
             </div>
        {!! Form::close() !!}

        </div>
        <div class="col-md-3 col-sm-3">

            @include('pages.partials.contactSideBar')


        </div>
    </div>
</div>
@stop