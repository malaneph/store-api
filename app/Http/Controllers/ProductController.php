<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(ProductRequest $request): AnonymousResourceCollection
    {
        $products = Product::query()
            ->when($request->filled('name'), fn($query) => $query->where('name', 'like', '%'.request('name').'%'))
            ->when($request->filled('category_id'), fn($query) => $query->where('category_id', request('category_id')))
            ->when($request->filled('in_stock'), fn($query) => $query->where('in_stock', request('in_stock')))
            ->when($request->filled('price_from'), fn($query) => $query->where('price', '>=', request('price_from')))
            ->when($request->filled('price_to'), fn($query) => $query->where('price', '<=', request('price_to')))
            ->when($request->filled('rating_from'),
                fn($query) => $query->whereBetween('rating', [request('rating_from'), 5]))
            ->when($request->filled('sort'), function ($query) {
                return match (request('sort')) {
                    'price_asc' => $query->orderBy('price'),
                    'price_desc' => $query->orderByDesc('price'),
                    'rating_desc' => $query->orderBy('rating'),
                    'newest' => $query->latest(),
                };
            })
            ->paginate(request('per_page') ?? 10)
            ->withQueryString();

        return ProductResource::collection($products);
    }
}
