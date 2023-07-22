<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\NewsImages;
use App\Repositories\BaseRepository;

class NewsImageRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return NewsImages::class;
    }

}
