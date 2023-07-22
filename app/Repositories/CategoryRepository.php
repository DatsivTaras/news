<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Category::class;
    }

    public function getCategories()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return $categories;
    }
}
