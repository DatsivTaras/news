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

    public function getSetting(string $key, int $category = null)
    {
        $params = [
            'key' => $key
        ];

        if ($category) {
            $params['category'] = $category;
        }

        $setting = $this->getOneByConditions($params);

        return $setting ? $setting->value : '';
    }
}
