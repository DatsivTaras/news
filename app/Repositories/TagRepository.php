<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\News;
use App\Models\NewsTag;
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
        $tags = DB::table('news_tags')
            ->join('tags', 'tags.id', '=', 'news_tags.tags_id')
            ->select('tags.name', DB::raw('count(*) as total'))
            ->groupBy('tags.name')
            ->orderByRaw(DB::raw('count(*) DESC'))
            ->paginate(20);

        return $tags;
    }
}
