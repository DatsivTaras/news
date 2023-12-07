<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\HomeSliderRepository;
use App\Repositories\FileRepository;
use App\Repositories\NewsAuthorsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\PaidNewsRepository;
use App\Repositories\SettingRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Str;

/**
 * Class FlightServices
 */
class MetaServices
{
    private $settingsRepository;
    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    public function getMetaData()
    {
        $options = [
            'filters' => [
                'key' => [
                    Setting::META_TITLE,
                    Setting::META_DESCRIPTION,
                    Setting::META_IMAGE,
                ],
                'category' => Setting::CATEGORY_META
            ]
        ];

        $metaRecords = $this->settingRepository->get($options);

        $metaData = [
            'title' => '',
            'description' => '',
            'image' => '',
        ];

        if ($metaRecords) {
            foreach ($metaRecords as $metaRecord) {
                if ($metaRecord->key == Setting::META_TITLE) {
                    $metaData['title'] = $metaRecord->value;
                }

                if ($metaRecord->key == Setting::META_IMAGE) {
                    $metaData['image'] = $metaRecord->image ? $metaRecord->image->getPath() : '';
                }

                if ($metaRecord->key == Setting::META_DESCRIPTION) {
                    $metaData['description'] = $metaRecord->value;
                }
            }
        }

        return $metaData;
    }
}
?>
