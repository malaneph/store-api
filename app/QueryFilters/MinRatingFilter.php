<?php

namespace App\QueryFilters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class MinRatingFilter extends BaseFilter
{
    protected string $column;

    public function __construct(string $column = 'min_rating') {
        $this->column = $column;
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
