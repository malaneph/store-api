<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'per_page' => 'integer'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
