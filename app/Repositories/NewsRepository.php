<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return News::class;
    }

}
