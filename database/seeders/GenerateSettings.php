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

    public function __construct(SettingRepository $settingRepository)
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
                'name' => 'Логотип сайту',
                'value' => '',
                'key' => Setting::HEADER_IMAGE,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_IMAGE,
                'description' => '',
                'created_at' => Carbon ::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Назва сайту',
                'value' => '',
                'key' => Setting::SITE_NAME,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_INPUT,
                'description' => '',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Лого футера',
                'value' => '',
                'key' => Setting::FOOTER_IMAGE,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_IMAGE,
                'description' => '',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
//            [
//                'name' => 'Добавлення пунктів меню',
//                'value' => '',
//                'key' => Setting::HEADER_ITEMS_MENU,
//                'category' => Setting::CATEGORY_HEADER,
//                'type' => Setting::TYPE_TEXTAREA,
//                'description' => '',
//                'created_at' => Carbon::now(),
//                'created_at' => Carbon::now(),
//            ],
            [
                'name' => 'Добавлення категорій в головне меню',
                'value' => '',
                'key' => Setting::HEADER_CATEGORY_MENU,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => '',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Добавлення блоків категорій на головній сторінці',
                'value' => '',
                'key' => Setting::BLOCKS_CATEGORY_HOME_PAGE,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => '',
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Добавлення категорій в бокове меню',
                'value' => '',
                'key' => Setting::HEADER_ITEMS_LEFT_MENU,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => '',
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
