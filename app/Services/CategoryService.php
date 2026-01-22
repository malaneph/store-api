<?php

namespace App\Services;

use App\Models\Category;
use App\QueryFilters\NameFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Pipeline;

class CategoryService
{
    public function getCategories(): LengthAwarePaginator
    {
        $query = Category::query();

        return Pipeline::send($query)
            ->through([
                NameFilter::class,
            ])
            ->thenReturn()
            ->when(request('sort'), function ($query) {
                return match (request('sort')) {
                    'newest' => $query->latest(),
                };
            })
            ->paginate(request('per_page') ?? 10)
            ->withQueryString();

    }
}
