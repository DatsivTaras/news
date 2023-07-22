<?php

namespace App\Services;

use App\Models\File;
use App\Models\Image;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NewsAuthorsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\SettingRepository;
use App\Repositories\TagRepository;
use Carbon\Carbon;

/**
 * Class FlightServices
 */
class SettingServices
{

    private $imageRepository;
    private $settingRepository;

    public function __construct(
        ImageRepository $imageRepository,
        SettingRepository $settingRepository
    )

    {
        $this->imageRepository = $imageRepository;
        $this->settingRepository = $settingRepository;
    }

    public function saveSettings($request)
    {
        unset($request['_token']);
        foreach ($request->all() as $key => $value) {
            if($value !== null) {
                if(is_object($value)) {
                    $data['name'] = $value->store('public/image/header');
                    $image = $this->imageRepository->create($data);

                    $data['value'] = $image->id;
                } else {
                    $data['value'] = $value;
                }

                $settings = $this->settingRepository->getOneOrFail($key,'key');
                $this->settingRepository->update($settings, $data);
            }
        }
    }
}
?>
