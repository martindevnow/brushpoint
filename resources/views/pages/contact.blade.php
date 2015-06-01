
@extends('layouts.zeina')

@section('header_inside')
@stop

@section('header_bottom')

    <?php
    $page['link'] = "/contact";
    $page['title'] = "Contact Us";
    $page['short_title'] = "Contact";
    $page['short_description'] = "General Inquiries"
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <h3 class="h3-body-title">
                Leave A Message
            </h3>


            <p class="body_paragraph">
                Our head office is located in King City, Ontario Canada. For more information or questions please fill
                out the form below with your name, email and message. Please provide all relevant information so that
                we may respond to your inquiry as soon as possible.
            </p>

            @include('errors.list')

            <form class="form-wrapper" id="bp-contact-form" method="post" role="form" novalidate>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group clearfix">
                    <label class="control-label" for="name">Name *</label>
                    <div class="col-xs-8">
                        <input type="text" id="name" name="name" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="control-label" for="user-email"> E-mail *</label>
                    <div class="col-xs-8">
                        <!-- type email used by jquery validate -->
                        <input type="text" name="email" id="user-email" class="form-control" required/>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="control-label" for="user_message">  Message *</label>
                    <div class="col-xs-10">
                        <!-- type email used by jquery validate -->
                        <textarea name="user_message" id="user_message" class="form-control" required></textarea>
                    </div>
                </div>


                <div class="form-group clearfix">
                    <label class="control-label"></label>
                    <div class="col-xs-8">
                        <input type="submit" value="Send" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 col-sm-3">

        @include('pages.partials.contactSideBar')

        </div>
    </div>
</div>
@stop