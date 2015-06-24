@extends('layouts.zeina')
<?php
$headTitleSubheading = "Capabilities";
$headMetaDescription = "BrushPoint Innovations is an industry leader producing the highest quality manual, and electric toothbrushes.
Our portfolio was crafted by award-winning engineers and are made of the finest materials.
See for yourself what sets BrushPoint apart from the competition.";
?>
@section('header_inside')
@stop



@section('header_bottom')

    <?php
    $page['link'] = "/capabilities";
    $page['title'] = "Our Capabilities";
    $page['short_title'] = "Capabilities";
    $page['short_description'] = "Second to none!";
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
<div class="section-content section-alter" style="padding-top: 30px;">

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <img src="/images/brushpoint/capabilities.jpg" alt="Capabilities" class="img-responsive" style="padding-top: 20px; float: right;" />
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="left-title">
                        <div class="heading-title">
                            <h2 class="h2-section-title">Why we are so special</h2>
                        </div>
                        <!-- <p>
                            We have a team of award winning engineers that can work with our Customers to bring the patented innovation or unique design they are looking for!
                        </p>-->
                        <ul class="icon-content-list-container">

    <li class="icon-content-single">

        <div class="content-box  style5  light-blue animated "
         data-animtype="fadeIn"
         data-animrepeat="0"
         data-animspeed="1s"
         data-animdelay="0.2s"
         >
        <h4 class="h4-body-title">
            <strong>Innovative</strong> Design

            <i class="icon-wrench"></i>
        </h4>
            <div class="content-box-text">
              <p>
                  We have a team of award winning engineers that can work with our Customers
                  to bring the patented innovation or unique design they are looking for!
              </p>
            </div>
        </div>
    </li>

    <li class="icon-content-single">

        <div class="content-box  style5  light-blue animated "
         data-animtype="fadeIn"
         data-animrepeat="0"
         data-animspeed="1s"
         data-animdelay="0.2s"
         >
        <h4 class="h4-body-title">
            <strong>Quality </strong> Manufacturing

            <i class="icon-cogs"></i>
        </h4>
            <div class="content-box-text">
              <p>
                 With over 20 years of management experience in sourcing materials and
                 finished product manufacturing we understand the quality-value equation!
              </p>
            </div>
        </div>
    </li>

    <li class="icon-content-single">

        <div class="content-box  style5  light-blue animated "
         data-animtype="fadeIn"
         data-animrepeat="0"
         data-animspeed="1s"
         data-animdelay="0.2s"
         >
        <h4 class="h4-body-title">
            <strong>Reliable </strong> Service

            <i class="icon-truck"></i>
        </h4>
            <div class="content-box-text">
              <p>
                  We are EDI enabled and have a Customer Service team to ensure
                  your product orders arrive complete and on-time.
              </p>
            </div>
        </div>
    </li>

</ul>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop

@section('footer')
    @include('zeina.footer-tech', ['tech' => false])
@stop