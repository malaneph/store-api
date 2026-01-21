<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class NameFilter extends BaseFilter
{
    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('name', 'like', '%'.request($this->filterName()).'%');
    }
}
