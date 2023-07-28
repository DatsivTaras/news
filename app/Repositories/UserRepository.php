<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return User::class;
    }

}
