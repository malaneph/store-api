<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class MinPriceFilter extends BaseFilter
{
    protected string $column;

    public function __construct(string $column = 'min_price') {
        $this->column = $column;
    }

    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->where('price', '>=', request($this->column));
    }
}
