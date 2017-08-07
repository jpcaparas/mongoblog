<?php

namespace App\Http\Controllers\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

/**
 * Trait PaginatesResults
 *
 * @package App\Http\Controllers\Support
 */
trait PaginatesResults
{
    public function getPagination(array $items = [])
    {
        $perPage = $items['per_page'] ?? 5;
        $total = $items['total'] ?? 1;
        $currentPage = $items['current_page'] ?? 1;

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [ 'path' => route(Route::currentRouteName()) ]
        );
    }
}