<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterableTrait
{
    /**
     * Apply filters to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilters(Builder $query, array $filters)
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        return $query;
    }

}
