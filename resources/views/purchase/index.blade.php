@extends('layouts.zeina')

@section('header_bottom')

    <?php
    $page['link'] = "/purchase";
    $page['title'] = "Purchase";
    $page['short_title'] = "Purchase";
    $page['short_description'] = "Shop around!";

     $showCart = true;
     $hideBreadcrumb = true;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
<div class="container">
    @foreach($products->chunk(3) as $productSet)
    <div class="row">
        @foreach($productSet as $product)
        <div class="col-sm-4 col-md-4">
            <div class="thumbnail">
                <a href="/purchase/id-{{ $product->id }}"><img src="/images/brushpoint/purchase/{{ $product->sku }}-240.png" alt="{{ $product->name }}"></a>
                <div class="caption">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p><a href="/purchase/id-{{ $product->id }}" class="btn btn-primary" role="button">View Details</a>
                     <a href="/cart/confirmAdd/{{ $product->id }}" class="btn btn-sale" role="button">Add to Cart</a></p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endforeach
</div>
@stop