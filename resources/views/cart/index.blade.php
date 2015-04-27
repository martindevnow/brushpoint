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

    {!! Form::open(['method' => 'post', 'url' => 'cart/update']) !!}

    <table class="table cart-contents">
        <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Extended Cost</th>
            </tr>
          </thead>
          <tbody>

            @foreach($cartData as $item)
            <tr>
              <td>
                <a href="cart/remove/{{ $item['id'] }}"><button type="button" class="btn btn-danger btn-xs">X</button></a>
                <img src="/images/brushpoint/purchase/{{ $item['sku'] }}-115.png" class="img-responsive" style="max-height: 35px; display: inline;"/>
                <a href="/purchase/id-{{ $item['product_id'] }}">{{ $item['name'] }}</a></td>
              <td>{{ asMoney($item['price']) }}</td>
              <td>
                <!--  Form Input -->
                <div class="form-group" style="margin-bottom: 0px">
                    {!! Form::text($item['id'] . '-quantity', $item['quantity'], ['class' => 'form-control cart-item-quantity']) !!}
                </div>
            </td>
              <td>{{ asMoney($item['price'] * $item['quantity']) }}</td>
            </tr>
            @endforeach

          </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <td>Fee</td>
                <td>Amount</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Shipping and Handling</td>
                <td>{{ $cartRepo->getShippingAndHandling() }}</td>
            </tr>
        </tbody>
    </table>

    <!-- {!! Form::open(['method' => 'POST', 'action' => 'CartController@getPayerInfo']) !!}
         <div class="form-group">
             {!! Form::submit('Checkout', ['class' => 'btn btn-primary']) !!}
         </div>
    {!! Form::close() !!} -->
    <a href="/purchase" class="btn btn-primary">Continue Browsing</a>
    {!! Form::submit('Update Quantities', ['class' => "btn btn-sale" ]) !!}
    {{-- <a href="/cart/update" class="btn btn-sale">Update Quantities</a> --}}
    <a href="/checkout/express" class="btn btn-sale">Checkout</a>

    {!! Form::close() !!}


</div>
@stop