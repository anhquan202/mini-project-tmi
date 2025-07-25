<?php
namespace App\Helpers;

use ErrorException;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper
{
    public static function make(LengthAwarePaginator $data)
    {
        return [
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage()
        ];
    }
}