<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Page;
use App\Models\Setting;
use App\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Setting::class;
    }

}
