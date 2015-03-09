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
           <p>{{ $product->description }}</p>
           <a href="/purchase/id-{{ $product->id }}"><img src="/images/brushpoint/purchase/{{ $product->sku }}-240.png" alt="{{ $product->name }}"></a>

        </div>
        {!! Form::open() !!}
        <div class="col-sm-6 col-md-8">
            <div class="row">
                @if($product->items()->count() > 1)
                {!! Form::label('item_id', 'Select the Item:') !!}
                {!! Form::select('item_id', $selections) !!}
                @else
                {!! Form::hidden('item_id', $product->items()->get()->id) !!}
                @endif
            </div>
            <div class="space-sep20"></div>
            <div class="row">
                {!! Form::label('quantity', 'How Many:') !!}
                {!! Form::text('quantity', '1') !!}
            </div>
            <div class="space-sep20"></div>
            <div class="row">
                {!! Form::submit('Add to Cart', ['class'=> 'btn btn-sale', 'style' => 'float: left;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop