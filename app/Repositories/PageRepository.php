<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Page;
use App\Repositories\BaseRepository;

class PageRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Page::class;
    }

    public function getPageWhereIn($ids)
    {
        $option = [
            'filters' => ['id' => $ids],
        ];

        return $this->get($option);
    }
}
