<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class InStockFilter extends BaseFilter
{
    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('in_stock', request($this->filterName()));
    }
}
