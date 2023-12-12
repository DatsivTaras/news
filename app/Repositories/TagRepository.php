<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Tag::class;
    }

    public function getTopTags()
    {
        $tags = Tag::query()
            ->select('name', DB::raw('count(*) as total'))
            ->groupBy('name')
            ->paginate(20);

        return $tags;

    }
}
