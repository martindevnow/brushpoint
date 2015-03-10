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

    <table class="table">
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
              <td>{{ $item['name'] }}</td>
              <td>{{ asMoney($item['price']) }}</td>
              <td>{{ $item['quantity'] }}</td>
              <td>{{ asMoney($item['price'] * $item['quantity']) }}</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
@stop