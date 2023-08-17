<?php

namespace App\Filters;

use Illuminate\Validation\Rules\Enum;
use Psy\Command\ListCommand\ClassEnumerator;

class NewsBasketFilter extends QueryFilter
{
    public function search($search_string = '')
    {
        return $this->builder->onlyTrashed()
            ->where('title', 'LIKE', '%'.$search_string.'%')
            ->orWhere('subtitle', 'LIKE', '%'.$search_string.'%')
            ->orWhere('description', 'LIKE', '%'.$search_string.'%')
            ->orWhere('mini_description', 'LIKE', '%'.$search_string.'%');
    }
}
