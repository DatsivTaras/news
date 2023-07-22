<?php
namespace Database\Seeders;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use Carbon\Carbon;

class GenerateSettings extends Seeder
{
    private $settingRepository;
    public function __construct(
        SettingRepository $settingRepository
    )
    {
        $this->settingRepository = $settingRepository;
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $settingsData = [
            [
                'name' => 'Зміна Лого',
                'value' => '',
                'key' => 'header_image',
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_IMAGE,
                'description' => 'Дауцауц а  ац ацу ',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Зміна назви сайту',
                'value' => '',
                'key' => 'site_name',
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_INPUT,
                'description' => 'rkge,l',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Зміна Фото Футера',
                'value' => '',
                'key' => 'footer_image',
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_IMAGE,
                'description' => 'rkge,l',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Добавлення пунктів меню',
                'value' => '',
                'key' => 'header_menu',
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_TEXTAREA,
                'description' => 'rkge,l',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($settingsData as $settingData) {
            $setting = $this->settingRepository->getOne($settingData['key'], 'key');
            if (!$setting) {
                $this->settingRepository->create($settingData);
            } else {

                $setting = $this->settingRepository->getOneOrFail($setting->id);
                unset($settingData['value']);
                $this->settingRepository->update($setting, $settingData);            }
            }
    }
}
