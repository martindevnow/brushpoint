@extends('layouts.zeina')
<?php
$headTitleSubheading = "Purchase | ". $product->name;
$headMetaDescription = "Not all of our products are available direct through our website.
However, we always ensure that we have the replacement heads in-stock for our customers.
If you wish to purchase our toothbrushes, you can find links to them on the retailers page.";
?>
@section('header_inside')
@stop

@section('header_bottom')
    <?php
    $page['link'] = "/purchase";
    $page['title'] = "Purchase";
    $page['short_title'] = ["Purchase" => '/purchase', $product->sku => "#"];
    $page['short_description'] = "Details";

    $showCart = true;
    $hideBreadcrumb = true;
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 animated" data-animtype="fadeInLeft"
             data-animrepeat="0"
             data-speed="1s"
             data-delay="0.4s">
            <div class="space-sep20"></div>
            <div class="left-title">
                <div class="heading-title">
                    <h2 class="h2-section-title left-text">{{ $product->name }}</h2>
                    <span class="purchase-pack">[{{ $product->pack_description }}]</span>
                    <h2 class="purchase-price">USD ${{ number_format($product->price, 2) }}</h2>
                </div>
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="space-sep20"></div>

            @if($product->getProductInventory())
            {!! Form::open(['method'=>'post', 'action' => 'CartController@addToCartConfirmed']) !!}
            <div class="col-sm-6 col-md-8">
                <div class="row">
                    @include('purchase.partials.addToCart', ['product' => $product])
                </div>
            </div>
            {!! Form::close() !!}
            @endif

            <!-- <p><a href="/cart/add/{{ $product->id }}" class="btn btn-sale" style="background-color: yellow; border: 1px solid black;" role="button">Add to Cart</a></p> -->
        </div>


        <div class="col-md-6 col-sm-6 animated" data-animtype="fadeInRight"
             data-animrepeat="0"
             data-speed="1s"
             data-delay="0.4s">
            <div class="right-image-container center-text">
                <img src='/images/brushpoint/purchase/{{  $product->sku }}-555.png' alt="product NAME" class="img-responsive inline-block" height="360" width="665"
                id="product-show-image"/>
            </div>

            @include('zeina.flickr-images', ['images'=> $product->images])
        </div>

    </div>
</div>
@stop