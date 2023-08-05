<?php

namespace App\Filters;

class AuthorFilter extends QueryFilter
{
    public function search($search_string = '')
    {
        return $this->builder->where('surname', 'LIKE', '%'.$search_string.'%')
            ->orWhere('name', 'LIKE', '%'.$search_string.'%');
    }
}
