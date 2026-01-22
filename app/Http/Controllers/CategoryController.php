<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(CategoryRequest $request): AnonymousResourceCollection
    {
        $categories = CategoryService::getCategories();

        return CategoryResource::collection($categories);
    }
}
