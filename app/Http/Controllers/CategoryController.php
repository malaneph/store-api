<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(CategoryRequest $request): AnonymousResourceCollection
    {
        $categories = Category::query()
            ->when($request->filled('name'), fn($query) => $query->where('name', 'like', '%'.request('name').'%'))
            ->when($request->filled('sort'), function ($query) {
                return match (request('sort')) {
                    'newest' => $query->latest(),
                };
            })
            ->paginate(request('per_page') ?? 10)
            ->withQueryString();

        return CategoryResource::collection($categories);
    }
}
