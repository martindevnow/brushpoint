<?php


namespace Martin\Products;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository {


    public function updateProduct($id, array $attributes)
    {
        $product = Product::findOrFail($id);
        $product->update($attributes);
    }


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
        $product = Product::findOrFail($id);
        if ($product->purchase && $product->active)
            return $product;
        throw new NotFoundHttpException;
    }

    public function getPortfolioById($id)
    {
        $product = Product::findOrFail($id);
        if ($product->portfolio && $product->active)
            return $product;
        throw new NotFoundHttpException;
    }
}