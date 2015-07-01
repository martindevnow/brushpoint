@extends('layouts.zeina')
<?php
$headTitleSubheading = "404";
$headMetaDescription = "Unfortunately the page you are looking for doesn't seem to exist.
Please try your request again. If it fails, please contact the website administrator.";
?>
@section('header_bottom')
    <?php
    $page['link'] = "/";

    $page['title'] = "404";
    $page['short_title'] = "404";
    $page['short_description'] = "Not Found";
    ?>

    @include('zeina.top-title-wrapper', ['page' => $page])
@stop

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Not Found</h1><br /><br/>
        <p>
            Unfortunately, the page you have landed on does not exist!
            Please try your request again!
        </p>
    </div>
</div>
@stop