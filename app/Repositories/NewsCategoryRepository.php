<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\NewsCategory;

class NewsCategoryRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return NewsCategory::class;
    }

}
