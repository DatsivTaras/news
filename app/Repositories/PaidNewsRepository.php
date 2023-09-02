<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\PaidNews;
use App\Models\Tag;
use App\Repositories\BaseRepository;

class PaidNewsRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return PaidNews::class;
    }

    public function deleteLastNewsFromPaidNews()
    {
        return $this->getQuery()->orderBy('created_at',)->first()->delete();
    }
}
