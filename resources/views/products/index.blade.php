@extends('layouts.zeina')
<?php
$headTitleSubheading = "Products";
$headMetaDescription = "Here you can see just some of the products we offer. Most of our products
are available as private label. Please contact us if you have any further inquiries.";
?>
@section('header_bottom')

    <?php
    $page['link'] = "/products";
    $page['title'] = "Products";
    $page['short_title'] = "Products";
    $page['short_description'] = "Our Lineup!";

    if (isset($product))
    {
        $shortTitle = [
            'Portfolio' => '/products',
            $product->name => '#'
        ];
        $page['short_title'] = $shortTitle;
    }

    $sep = false;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])
@stop


@section('content')
<div class="container">
    @foreach($products->chunk(4) as $productSet)
    <div class="row">
        @foreach($productSet as $product)
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
            <div class="small-container">
                <div class="thumbnail">
                    <div class="product-details">
                        <p><a href="{{ $product->urlToProductPage() }}" class="btn btn-primary product-detail-btn" role="button" style="float: right;">Details</a>
                    </div>
                    <div class="product-thumbnail">
                        <a href="{{ $product->urlToProductPage() }}">
                        <img src="/images/brushpoint/products/{{ $product->sku }}-full.jpg"
                            alt="BrushPoint presents {{ $product->name }}"
                            class="img-responsive"
                            style="max-height: 150px;">
                        </a>
                    </div>
                    <div class="product-caption">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                     </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@stop

