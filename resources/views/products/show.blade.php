@extends('layouts.zeina')

@section('header_bottom')

    <?php
    $page['link'] = "/products";

    $page['title'] = "Products";
    $page['short_title'] = "Products";
    $page['short_description'] = "Our Lineup!";

    if (isset($product))
    {
        $shortTitle = [
            'Products' => '/products'
        ];
        $page['short_title'] = $shortTitle;
    }



    $sep = false;

    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 animated" data-animtype="fadeInLeft"
                                                       data-animrepeat="0"
                                                       data-speed="1s"
                                                       data-delay="0.4s">
                @if(isset($product))
                <div class="left-image-container center-text">
                    <img class="img-responsive inline-block" src="/images/brushpoint/products/{{ $product->sku }}-full.jpg" style="padding: 1% 0px 3% 1%; height: auto; width: 350px;" />
                </div>
                @endif
            </div>

            <div class="col-md-8 col-sm-8">
                <div class="left-title">
                    <div class="heading-title">
                        <h2 class="left-text"><b>@if (isset($product))
                         {!! $product->name !!} @else Please select a product @endif </b></h2>
                    </div>

                    @if(isset($product->claim))
                        <p>{!! $product->claim !!}</p>
                    @endif


                    @if ($product->benefits)
                    <div class="left-title">
                        <div class="heading-title">
                            <h2 class="h3-section-title left-text">Benefits</h2>
                        </div>
                        <ul class="icons-list check-2 colored-list ">
                            @foreach($product->benefits as $benefit)
                            <li>{!! $benefit->body !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    <?php $sep = true;
                        ?>
                    @endif


                    @if ($product->features)
                    @if($sep) <div class="space-sep20"></div> @endif
                    <div class="left-title">
                        <div class="heading-title">
                            <h2 class="h3-section-title left-text">Features</h2>
                        </div>
                        <ul class="icons-list check-2 colored-list ">
                            @foreach($product->features as $feature)
                            <li>{!! $feature->body !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    @if(isset($product->other) && $product->others)
                    @if($sep) <div class="space-sep20"></div> @endif

                        <div class="left-title">
                            <div class="heading-title">
                                <h2 class="h3-section-title left-text">{{ $product->other }}</h2>
                            </div>
                            <ul class="icons-list check-2 colored-list ">
                                @foreach($product->others as $point)
                                <li>{!! $point->body !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (isset($product->other) && !$product->others)
                        <p>{!! $product->others !!}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop