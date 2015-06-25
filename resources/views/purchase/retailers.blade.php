@extends('layouts.zeina')
<?php
$headTitleSubheading = "Purchase";
$headMetaDescription = "Not all of our products are available direct through our website.
However, we always ensure that we have the replacement heads in-stock for our customers.
If you wish to purchase our toothbrushes, you can find links to them on the retailers page.";
?>
@section('header_inside')

@stop

@section('header_bottom')

    <?php
    $page['link'] = "/purchase";

    $page['title'] = "Purchase";
    $page['short_title'] = ["Purchase" => '/purchase', 'Retailers' => "#"];
    $page['short_description'] = "Find a Retailer";

     $showCart = true;
     $hideBreadcrumb = true;
    ?>
    @include('zeina.top-title-wrapper', ['page' => $page])

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="center-title">
                <div class="heading-title">
                    <h2 class="h2-section-title">Online Retailers</h2>
                </div>
                <p>
                    Brushpoint products are available at any of these fine retailers.
                    <br />
                    Click on the icon of the retailer to purchase them online
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <a target="_blank" href="http://www.walmart.com/search/search-ng.do?query=BrushPoint&cat_id=976760&facet=retailer:Walmart.com">
                <img class="img-responsive" src="/images/retailers/walmart.jpg" alt="Find BrushPoint products available at Wal-Mart.com"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a target="_blank" href="http://www.drugstore.com/search/search_results.asp?N=0&Ntx=mode%2Bmatchallpartial&Ntk=All&srchtree=5&Ntt=BrushPoint&Go.x=15&Go.y=19">
                <img class="img-responsive" src="/images/retailers/drugstore.jpeg" alt="BrushPoint products listed on Drugstore.com"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a target="_blank" href="http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Dhpc&field-keywords=brushpoint">
            <!-- http://www.amazon.com/s?ie=UTF8&field-keywords=Brushpoint%20Innovations&index=blended&link_code=qs&sourceid=Mozilla-search&tag=mozilla-20 -->
                <img class="img-responsive" src="/images/retailers/amazon.jpg" alt="BrushPoint products as found on Amazon.com"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a target="_blank" href="http://www.target.com/s?searchTerm=brushpoint&category=0%7CAll%7Cmatchallpartial%7Call+categories">
                <img class="img-responsive" src="/images/retailers/target.gif" alt="BrushPoint products found on Target.com"/>
            </a>
        </div>
    </div>
    <div class="space-sep40"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="center-title">
                <div class="heading-title">
                    <h2 class="h2-section-title">Replacement Heads</h2>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="center-title">
                <a href="/purchase" class="btn btn-primary" style="height: 80px;
                    display: inline-block;
                    vertical-align: middle;
                    float: none;
                    border-radius: 15px">
                    <br /> <h2 style="color: white;">Purchase Replacement Heads Online Here</h2>
                </a>
            </div>
        </div>
    </div>
</div>
@stop