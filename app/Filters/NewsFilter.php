<?php

namespace App\Filters;

class NewsFilter extends QueryFilter
{
    public function search($search_string = '')
    {
        return $this->builder->where('title', 'LIKE', '%'.$search_string.'%')
            ->orWhere('subtitle', 'LIKE', '%'.$search_string.'%')
            ->orWhere('description', 'LIKE', '%'.$search_string.'%')
            ->orWhere('mini_description', 'LIKE', '%'.$search_string.'%');
    }
}
