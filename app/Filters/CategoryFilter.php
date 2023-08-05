<?php

namespace App\Filters;

class CategoryFilter extends QueryFilter
{
    public function search($search_string = '')
    {
        return $this->builder->where('name', 'LIKE', '%'.$search_string.'%');
    }
}
