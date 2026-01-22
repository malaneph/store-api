<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class MinPriceFilter extends BaseFilter
{
    public function __construct(protected string $column = 'min_price')
    {
    }

    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('price', '>=', request($this->column));
    }
}
