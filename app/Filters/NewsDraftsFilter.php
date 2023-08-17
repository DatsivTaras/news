<?php

namespace App\Filters;

use Illuminate\Validation\Rules\Enum;
use Psy\Command\ListCommand\ClassEnumerator;

class NewsDraftsFilter extends QueryFilter
{
    public function search($search_string = '')
    {
        return $this->builder->where('type_publication', 2)
            ->where('title', 'LIKE', '%'.$search_string.'%')
            ->orWhere('subtitle', 'LIKE', '%'.$search_string.'%')
            ->orWhere('description', 'LIKE', '%'.$search_string.'%')
            ->orWhere('mini_description', 'LIKE', '%'.$search_string.'%');
    }
}
