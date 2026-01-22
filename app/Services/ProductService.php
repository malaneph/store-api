<?php

namespace App\Services;

use App\Models\Product;
use App\QueryFilters\CategoryIdFilter;
use App\QueryFilters\InStockFilter;
use App\QueryFilters\MaxPriceFilter;
use App\QueryFilters\MinPriceFilter;
use App\QueryFilters\NameFilter;
use App\QueryFilters\MinRatingFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Pipeline;

class ProductService
{
    public static function getProducts(): LengthAwarePaginator
    {
        $query = Product::query();

        return Pipeline::send($query)
            ->through([
                NameFilter::class,
                CategoryIdFilter::class,
                InStockFilter::class,
                MinPriceFilter::class,
                MaxPriceFilter::class,
                MinRatingFilter::class,
            ])
            ->thenReturn()
            ->when(request('sort'), function ($query) {
                return match (request('sort')) {
                    'price_asc' => $query->orderBy('price'),
                    'price_desc' => $query->orderByDesc('price'),
                    'rating_desc' => $query->orderByDesc('rating'),
                    'newest' => $query->latest(),
                };
            })
            ->paginate(request('per_page') ?? 10)
            ->withQueryString();
    }
}
