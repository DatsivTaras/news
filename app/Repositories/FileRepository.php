<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\BaseRepository;

class FileRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return File::class;
    }
}
