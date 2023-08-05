<?php

namespace App\Repositories;

use App\Models\HomeSlider;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class  HomeSliderRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return HomeSlider::class;
    }

    public function getOldNewsFromSlider()
    {
        return ($this->getModelClass())::orderBy('created_at','DESC')->first();
    }

    public function deleteLastNewsFromSlider()
    {
        return $this->getQuery()->orderBy('created_at','asc')->first()->delete();
//        $news = $this->getQuery()
//            ->select('home_slider.*')
//            ->join('news', 'home_slider.news_id', '=', 'news.id')
//            ->orderBy('news.created_at','ASC')
//            ->first();

//        return $this->delete($news);
    }
}
