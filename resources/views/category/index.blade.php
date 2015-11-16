@extends('layouts.zeina')
<?php
$headTitleSubheading = "Category";
$headMetaDescription = "Broken down by category, you can select the range of products
 you are interested in.";
?>
@section('header_bottom')

    <?php
    $page['link'] = "/category";
    $page['title'] = "Products - by Category";
    $page['short_title'] = "Category";
    $page['short_description'] = "Our Lineup!";
    $sep = false;
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])
@stop


@section('content')
<div class="container">
    @foreach($categories->chunk(4) as $categorySet)
    <div class="row">
        @foreach($categorySet as $category)
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="padding-left: 5px; padding-right: 5px;">
            <div class="small-container">
                <div class="thumbnail">
                    <div class="product-details" style="height: 18px">
                    @if ( false )
                        <p><a href="{{ $category->urlToProductPage() }}" class="btn btn-primary product-detail-btn" role="button" style="float: right;">Details</a>
                    @endif
                    </div>
                    <div class="product-thumbnail">
                        <a href="/category/{{ $category->slug }}">
                        <img src="/images/brushpoint/categories/cat-{{ $category->slug }}.jpg"
                            alt="BrushPoint presents {{ $category->name }}"
                            class="img-responsive"
                            style="max-height: 150px;">
                        </a>
                    </div>
                    <div class="product-caption">
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                     </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@stop

