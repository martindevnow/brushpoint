
<?php
$index = 1;
?>
@if($images->where('width', 115))
<div class="product_thumb_content" style="padding-top: 20px">
    <div class="products_thumb_badge_wrapper" style="padding-left: 2.5%">
        @foreach ($images->where('width', 115) as $image)
        <div class="products_thumb_badge_image" id="products_thumb_badge_image{{ $index++ }}">
            <a href="#">
            <img src="{{ $image->path }}" height="50" width="50" class="purchase-thumbnail" />
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif