<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Role::class;
    }

    public function getRole()
    {
        return $this->getQuery()->whereIn('name', ['Admin','Manager'])->pluck('name', 'name')->toArray();
    }
}
