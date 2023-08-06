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
        return $this->getQuery()->orderBy('created_at',)->first()->delete();
    }
}