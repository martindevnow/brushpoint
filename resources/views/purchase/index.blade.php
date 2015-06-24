@extends('layouts.zeina')
<?php
$headTitleSubheading = "Purchase";
$headMetaDescription = "Not all of our products are available direct through our website.
However, we always ensure that we have the replacement heads in-stock for our customers.
If you wish to purchase our toothbrushes, you can find links to them on the retailers page.";
?>
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
                <div class="purchase-price"></div>
                <a href="/purchase/id-{{ $product->id }}"><img src="/images/brushpoint/purchase/{{ $product->sku }}-240.png" alt="{{ $product->name }}"></a>
                <div class="caption">
                    <h3 class="purchase-name">{{ $product->name }}</h3>
                    <span class="purchase-pack">{{ $product->pack_description }}</span>
                    <h4 class="purchase-price">
                        USD ${{ number_format($product->price, 2) }}
                        {{ $product->getProductInventory() == 0 ? "[SOLD OUT]":"" }}
                    </h4>
                    <p>{{ $product->description }}</p>
                    <p>
                      <a href="/purchase/id-{{ $product->id }}" class="btn btn-primary" role="button">View Details</a>
                      @if($product->getProductInventory() > 0)
                      <a href="/cart/add/{{ $product->id }}" class="btn btn-sale" role="button">Add to Cart</a>
                      @endif
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endforeach
</div>
@stop