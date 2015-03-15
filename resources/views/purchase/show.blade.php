@extends('layouts.zeina')

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
                    <h2 class="purchase-price">USD ${{ number_format($product->price, 2) }}</h2>
                </div>
                <p>
                    Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudine odio.
                </p>
                <ul class="icons-list check-2 colored-list ">
                    <li>Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus</li>
                    <li>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero</li>
                    <li>Aenean imperdiet. Etiam ultricies nisi vel augue.</li>
                    <li>Sed fringilla mauris sit amet nibh</li>
                    <li>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus</li>
                </ul>
            </div>
            <div class="space-sep20"></div>

            {!! Form::open(['method'=>'post', 'action' => 'CartController@addToCartConfirmed']) !!}
                    <div class="col-sm-6 col-md-8">
                        <div class="row">
                            @include('purchase.partials.addToCart', ['product' => $product])
                        </div>
                    </div>
                    {!! Form::close() !!}

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

            @include('zeina.flickr-images', ['images'=> ['/images/brushpoint/purchase/'. $product->sku .'-115.png', 'two', 'three', 'four']])
        </div>

    </div>
</div>
@stop