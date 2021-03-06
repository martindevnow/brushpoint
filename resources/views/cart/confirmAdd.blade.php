@extends('layouts.zeina')
<?php
$headTitleSubheading = "Your Shopping Cart | Confirm Add to Cart";
$headMetaDescription = "Are you sure you want to add this to your cart? How many packs of replacement toothbrush heads
do you wish to purchase? Please select how many toothbrush heads you would like and click add to cart.";
?>
@section('header_bottom')

    <?php
    $page['link'] = "/cart";

    $page['title'] = "Cart";
    $page['short_title'] = "Cart";
    $page['short_description'] = "Confirm Quantity";

    $showCart = true;
    $hideBreadcrumb = true;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="container thumbnail" style="width: 100%;">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="left-text">{{ $product->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                       <a href="/purchase/id-{{ $product->id }}"><img src="/images/brushpoint/purchase/{{ $product->sku }}-240.png" alt="{{ $product->name }}"></a>
                    </div>
                    {!! Form::open(['method'=>'post', 'action' => 'CartController@addToCartConfirmed']) !!}
                    <div class="col-sm-6">
                        <div class="row">
                            <p>{{ $product->description }}</p>
                            <span class="purchase-pack">[{{ $product->pack_description }}]</span>
                            <h2 class="purchase-price">USD ${{ number_format($product->price, 2) }}</h2>


                            @include('purchase.partials.addToCart', ['product' => $product])
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@stop