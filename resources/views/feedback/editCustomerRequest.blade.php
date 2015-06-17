
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
                Customer Request for Information
            </h3>

            @include('errors.list')


            <p class="body_paragraph">
                Thank you for submitting your feedback.
                </p>
                <p>
                In order for us to make further progress on your claim, we require additional information.
                </p>
                <p>
                Please fill out the form to the best of your ability.
                </p>
                <p>
                Thank you!
            </p>


        {!! Form::open(['method' => 'post', 'files' => true, 'url' => 'feedback/edit/'.$feedback->id .'/'. $customerRequest->id .'/'. $customerRequest->hash]) !!}
            @if($customerRequest->request_lot_code)
                <div class="form-group">
                    {!! Form::label('lot_code', 'Lot Code') !!}
                    {!! Form::text('lot_code', null, ['class' => 'form-control']) !!}
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('retailer_text', 'Retailer') !!}
                {!! Form::text('retailer_text', $feedback->retailer_text, ['class' => 'form-control']) !!}
            </div>

            @if($customerRequest->request_image)
                {!! Form::label('product_image', 'Product Image: ') !!}
                {!! Form::file('product_image') !!}
            @endif

            @if($customerRequest->request_address || $customerRequest->request_field_sample)
                @include('layouts.partials._address')
                <div class="form-group">
                     {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                 </div>

            @endif

            {!! Form::hidden('hash', $customerRequest->hash) !!}

        {!! Form::close() !!}

        </div>
        <div class="col-md-3 col-sm-3">

            @include('pages.partials.contactSideBar')


        </div>
    </div>
</div>
@stop