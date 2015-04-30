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
    @if ($cartData)
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
        {!! Form::submit('Update Quantities', ['class' => "btn btn-sale" ]) !!}
        {!! Form::close() !!}


        @if ($cartRepo->isSetRecipientCountry())
            <a href="/checkout/express" class="btn btn-sale">Checkout</a>
        @endif
        <table class="table cart-contents" style="width: 40%; float: right;">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td>Amount</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Shipping to: {{ $cartRepo->getRecipientCountryFull() }}
                        @if($cartRepo->isSetRecipientCountry())
                         [<a href="cart/shipping/clear">Change Country</a>]
                        @endif
                    </td>
                    @if ($cartRepo->isSetRecipientCountry())
                        <td>{{ asMoney($cartRepo->getShippingAndHandling()) }}</td>
                    @else
                        <td>
                            Select Country to Checkout
                              {!! Form::open(['method' => 'post', 'url' => 'cart/shipping/country' ]) !!}
                                  <div class="form-group">
                                  {!! Form::select('country_code', $cartRepo->getCountryCodeArray(), null) !!}
                                  </div>
                                  <div class="form-group">
                                      {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                  </div>
                              {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
                <tr>
                    <td><b>Total:</b></td>
                    <td><b>{{ asMoney($cartRepo->getShippingAndHandling() + $cartRepo->getCartTotal()) }}</b></td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="jumbotron">
            <h1>Your cart is empty.</h1><br /><br/>
            <h2><a href="http://bpl5.dev/purchase">Click here to view our products.</a></h2>
        </div>
    @endif









    <a href="/purchase" class="btn btn-primary">Continue Browsing</a>



</div>
@stop