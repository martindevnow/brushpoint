<?php


namespace Martin\Products;


class ProductRepository {

    public function getPaginated($howMany = 12)
    {
        return Product::orderBy('name', 'asc')->paginate($howMany);
    }

    public function getPurchasePaginated($howMany = 12)
    {
        return Product::where('purchase', '=', 1)->where('active', '=', '1')->orderBy('display_order', 'asc')->paginate($howMany);
    }

    public function getPortfolioPaginated($howMany = 25)
    {
        return Product::where('portfolio', '=', '1')->where('active', '=', '1')->orderBy('display_order', 'asc')->paginate($howMany);
    }


    public function getPurchaseById($id)
    {
        $product = Product::find($id);
        if ($product->purchase && $product->active)
        {
            return $product;
        }
        else
        {
            // TODO: Add an error because the product is not active or not purchase-able
            return false;
        }
    }

    public function getPortfolioById($id)
    {
        $product = Product::find($id);
        if ($product->portfolio && $product->active)
        {
            return $product;
        }
        else
        {
            // TODO: Add an error because the product is not active or not purchase-able
            return false;
        }
    }
}