<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request, $id, $slug='')
    {
        $product = $this->productService->getProduct($id);
        $productMore = $this->productService->more($product->menu->id, $id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productMore
        ]);
    }

    public function quickView(Request $request)
    {
        $result = $this->productService->quickView($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'products' => $result
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
