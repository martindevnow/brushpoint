@extends('layouts.zeina')


@section('header_inside')
@stop


@section('header_bottom')
    <?php
    $page['title'] = "Video";
    $page['short_title'] = "Video";
    $page['short_description'] = "";
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])
@stop

@section('content')
<div class="section-content no-padding section-alter" style="padding-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/cTwejR4LoSk?rel=0" allowfullscreen></iframe>
                </div>
                <p>
                    <h3 class="h3-body-title">
                        Video "How To"
                    </h3>
                    <!--
                    <p>
                        Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets. Sed ut perspiciatis unde omnis iste natus error sit
                        voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                        aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui.
                    </p> -->
                </p>
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/i3f4hFfPzak?rel=0" allowfullscreen></iframe>
                </div>
                <p>
                    <h3 class="h3-body-title">
                        Video: "The Toss"
                    </h3>
                    <!--
                    <p>
                        Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets. Sed ut perspiciatis unde omnis iste natus error sit
                        voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                        aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui.
                    </p> -->
                </p>
            </div>
        </div>
    </div>
</div>
@stop