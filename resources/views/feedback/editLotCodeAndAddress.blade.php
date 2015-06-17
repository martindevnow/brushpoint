
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/feedback";
    $page['title'] = "Feedback ID: ". $feedback->id;
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


        {!! Form::open(['method' => 'post', 'url' => 'feedback/edit/'.$feedback->id .'/'. $feedback->hash]) !!}
            <div class="form-group">
                {!! Form::label('lot_code', 'Lot Code') !!}
                {!! Form::text('lot_code', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('retailer_text', 'Retailer') !!}
                {!! Form::text('retailer_text', $feedback->retailer_text, ['class' => 'form-control']) !!}
            </div>

            @include('layouts.partials._address')
            <div class="form-group">
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
             </div>

            {!! Form::hidden('hash', $feedback->hash) !!}

        {!! Form::close() !!}

        </div>
        <div class="col-md-3 col-sm-3">

            @include('pages.partials.contactSideBar')


        </div>
    </div>
</div>
@stop