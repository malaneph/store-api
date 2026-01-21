<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class CategoryIdFilter extends BaseFilter
{
    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('category_id', request($this->filterName()));
    }
}
