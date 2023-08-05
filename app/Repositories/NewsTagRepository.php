<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\NewsImages;
use App\Models\NewsTag;
use App\Repositories\BaseRepository;

class NewsTagRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return NewsTag::class;
    }

    public function getNewsTags(int $id)
    {
        $option = [
            'filters' => 'news_id',
        ];

        return $this->get($option);
    }
}
