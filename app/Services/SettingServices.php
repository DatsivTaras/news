<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Setting;
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
        $setting = app(SettingRepository::class)->getOne(Setting::HEADER_IMAGE, 'key');
        return $setting->image ? $setting->image->name : '';
    }

    public static function getFooterLogo()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::FOOTER_IMAGE, 'key');
        return $setting->image ? $setting->image->name : '';
    }

    public function saveSettings($request)
    {
        unset($request['_token']);

        foreach ($request->all() as $key => $value) {
            $settings = $this->settingRepository->getOneOrFail($key,'key');
            $type = $settings->type;
            $data = [];
            if ($type == 5) {
                $data['name'] = $value->store('public/image/header');
                $image = $this->imageRepository->create($data);
                $data['value'] = $image->id;
            }
            if ($type == 1) {
                $data['value'] = $value;
            }
            if ($type == 6) {
               $data['value'] = implode(",", $value);
            }
            $this->settingRepository->update($settings, $data);
        }
    }
}
?>
