@extends('layouts.zeina')

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
        <div>
            <h2 class="left-text">{{ $product->name }}</h2>
        </div>
    </div>
   <div class="row">
        <div class="col-sm-6 col-md-4">
           <a href="/purchase/id-{{ $product->id }}"><img src="/images/brushpoint/purchase/{{ $product->sku }}-240.png" alt="{{ $product->name }}"></a>
        </div>
        {!! Form::open(['method'=>'post', 'action' => 'CartController@addToCartConfirmed']) !!}
        <div class="col-sm-6 col-md-8">
            <div class="row">
                <p>{{ $product->description }}</p>
                @include('purchase.partials.addToCart', ['product' => $product])
            </div>
          </div>
        {!! Form::close() !!}
    </div>
</div>
@stop