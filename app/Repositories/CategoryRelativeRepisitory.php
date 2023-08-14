<?php

namespace App\Repositories;

use App\Models\CategoryRelative;
use App\Models\News;
use App\Repositories\BaseRepository;

class CategoryRelativeRepisitory extends BaseRepository
{
    protected function getModelClass(): string
    {
        return CategoryRelative ::class;
    }

}
