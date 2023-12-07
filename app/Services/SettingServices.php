<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Setting;
use App\Repositories\FileRepository;
use App\Repositories\SettingRepository;


/**
 * Class FlightServices
 */
class SettingServices
{

    private $imageRepository;

    private $settingRepository;

    public function __construct(
        FileRepository    $imageRepository,
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

    public static function getHeaderEmail()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::EMAIL_ADDRESS, 'key');
        return $setting->value ;
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
            switch ($type) {
                case Setting::TYPE_IMAGE:
                    $data['name'] = $value->store('public/image/header');
                    $image = $this->imageRepository->uploadAndCreate($value);
                    $data['value'] = $image->id;
                    break;
                case Setting::TYPE_TEXTAREA:
                case Setting::TYPE_INPUT:
                    $data['value'] = $value;
                    break;
                case Setting::TYPE_MULTIPLE:
                    $data['value'] = implode(",", $value);
                    break;
            }

            $this->settingRepository->update($settings, $data);
        }
    }
}
?>
