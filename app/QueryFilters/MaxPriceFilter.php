<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class MaxPriceFilter extends BaseFilter
{
    public function __construct(protected string $column = 'max_price')
    {
    }

    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('price', '<=', request($this->column));
    }
}
