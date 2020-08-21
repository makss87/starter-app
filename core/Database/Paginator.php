<?php

namespace Core\Database;


use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{

    /**
     * Create a range of pagination URLs.
     *
     * @param  int  $start
     * @param  int  $end
     * @return array
     */
    public function getUrlRange($start, $end)
    {
        return collect(range($start, $end))->mapWithKeys(function ($page) {
            return [$page => url($this->url($page))];
        })->all();
    }
}