<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(ProductRequest $request): AnonymousResourceCollection
    {
        $products = ProductService::getProducts();

        return ProductResource::collection($products);
    }
}
