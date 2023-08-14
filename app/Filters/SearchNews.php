<?php

namespace App\Filters;

class SearchNews extends QueryFilter
{
    public function query($search_string = '')
    {
        return $this->builder->where('title', 'LIKE', '%'.$search_string.'%')
            ->orWhere('subtitle', 'LIKE', '%'.$search_string.'%')
            ->orWhere('description', 'LIKE', '%'.$search_string.'%')
            ->orWhere('mini_description', 'LIKE', '%'.$search_string.'%');
    }
}
