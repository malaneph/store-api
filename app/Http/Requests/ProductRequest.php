<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'price_from' => 'numeric',
            'price_to' => 'numeric',
            'category_id' => 'integer|exists:categories,id',
            'rating_from' => 'numeric|between:0,5',
            'in_stock' => 'boolean',
            'per_page' => 'integer',
            'sort' => 'string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
