<div class="top-title-wrapper bp-header" style="overflow: visible;" >
    <div class="container" style="overflow: visible;">
        <div class="row" style="overflow: visible">
            <div class="col-md-12 col-sm-12 page-info" style="overflow: visible;">
                <h1 class="h1-page-title">
                    @if (isset($page['link']))
                    <a href="{{ $page['link'] }}">
                    {{ $page['title'] }}
                    </a>
                    @else
                    {{ $page['title'] }}
                    @endif
                </h1>

                <h2 class="h2-page-desc">
                    {{ $page['short_description'] }}
                </h2>




                @if ( ! isset($hideBreadcrumb))
                <!-- BreadCrumb -->
                <div class="bp-breadcrumb breadcrumb-container">
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">
                                <i class="icon-home"></i>
                                Home
                            </a>
                        </li>
                        @if (is_array($page['short_title']))
                            @foreach($page['short_title'] as $bcTitle => $bcLink)
                            <li><a href="{{ $bcLink }}">{{ $bcTitle }}</a></li>
                            @endforeach
                        @else
                            <li>{{ $page['short_title'] }}</li>
                        @endif
                    </ol>
                </div>
                <!-- BreadCrumb -->
                @endif




                @if(isset($showCart) && $showCart==true)
                <!-- Shopping cart -->
                <div class="dropdown pull-right" style="float: right; margin-top: -9px ">
                  <button class="btn btn-primary dropdown-toggle bp-cart" type="button" id="dropdownMenu1"
                  data-toggle="dropdown" aria-expanded="true">
                    <i class="icon-shopping-cart"></i> Cart (${{ number_format($cartRepo->getCartTotal(),2) }})
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    @if ($cartData)
                    @foreach($cartData as $cart)
                        <li role="presentation"><a role="menuitem" href="#">{{ $cart['name'] }} x {{ $cart['quantity'] }}</a></li>
                    @endforeach
                        <li role="presentation"><a role="menuitem" href="/cart">View Cart</a></li>
                    @else
                        <li role="presentation"><a role="menuitem" href="#">Empty</a></li>
                    @endif
                  </ul>
                </div>
                <!-- /End Shopping Cart -->
                @endif
            </div>
        </div>
    </div>
</div>