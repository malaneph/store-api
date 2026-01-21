<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'min_price' => 'numeric',
            'max_price' => 'numeric',
            'category_id' => 'integer|exists:categories,id',
            'min_rating' => 'numeric|between:0,5',
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
