<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Tag::class;
    }

}
