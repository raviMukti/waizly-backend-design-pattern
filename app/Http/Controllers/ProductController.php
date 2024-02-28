<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Sebelum pake repository pattern
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    // public function search(Request $request)
    // {
    //     $name = $request->query("name");
    //     $sku = $request->query("sku");

    //     if(!is_null($sku))
    //     {
    //         $products = Product::where('sku', $sku)->get();
    //         return response()->json($products);
    //     }

    //     $products = Product::where('name', 'like', "%{$name}%")->get();
    //     return response()->json($products);
    // }

    public function search(Request $request)
    {
        $name = $request->query("name");
        $sku = $request->query("sku");

        if(!is_null($sku))
        {
            $products = $this->productRepository->findBySku($sku);
            return response()->json($products);
        }

        $products = $this->productRepository->findByName($name);
        return response()->json($products);
    }
}