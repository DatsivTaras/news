<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\BaseRepository;

class ImageRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return File::class;
    }

}
