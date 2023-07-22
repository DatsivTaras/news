<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\NewsAuthors;
use App\Models\NewsImages;
use App\Repositories\BaseRepository;

class NewsAuthorsRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return NewsAuthors::class;
    }

}
