<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class BaseFilter
{
    public function handle(Builder $builder, \Closure $next)
    {
        $filterName = $this->filterName();
        if (!request()->has($filterName)) {
            return $next($builder);
        }
        return $next($this->applyFilter($builder));
    }

    abstract protected function applyFilter(Builder $builder): Builder;

    protected function filterName(): string
    {
        $className = class_basename($this);
        $cleanClassName = Str::replace('Filter', '', $className);

        return Str::snake($cleanClassName);
    }
}
