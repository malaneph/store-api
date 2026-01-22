<?php

namespace App\QueryFilters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class MinRatingFilter extends BaseFilter
{
    public function __construct(protected string $column = 'min_rating')
    {
    }

    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->whereBetween(
            'rating',
            [
                request($this->column),
                Product::MAX_RATING,
            ]
        );
    }
}
