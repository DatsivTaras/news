<?php

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use App\Repositories\SettingRepository;


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

    public static function getHeaderLogo()
    {
        return app(SettingRepository::class)->getOne('header_image', 'key')->image->name;
    }

    public static function getFooterLogo()
    {
        return app(SettingRepository::class)->getOne('footer_image', 'key')->image->name;
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
