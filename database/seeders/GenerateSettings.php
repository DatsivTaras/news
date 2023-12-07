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
                'description' => ''
            ],
            [
                'name' => 'Назва сайту',
                'value' => '',
                'key' => Setting::SITE_NAME,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Лого футера',
                'value' => '',
                'key' => Setting::FOOTER_IMAGE,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_IMAGE,
                'description' => ''
            ],
            [
                'name' => 'Наш Facebook',
                'value' => '',
                'key' => Setting::FACEBOOK_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Twitter',
                'value' => '',
                'key' => Setting::TWITTER_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Telegram',
                'value' => '',
                'key' => Setting::TELEGRAM_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Youtube',
                'value' => '',
                'key' => Setting::YOUTUBE_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Instagram',
                'value' => '',
                'key' => Setting::INSTAGRAM_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Адрес',
                'value' => '',
                'key' => Setting::ADDRESS,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш Email',
                'value' => '',
                'key' => Setting::EMAIL_ADDRESS,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Консультація та замовлення',
                'value' => '',
                'key' => Setting::EMAIL_CONSULTATION,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Для ЗМІ',
                'value' => '',
                'key' => Setting::EMAIL_ZMI,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Для авторів',
                'value' => '',
                'key' => Setting::EMAIL_AUTHOR,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Маркетинг',
                'value' => '',
                'key' => Setting::EMAIL_MARKETING,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Для корпоративних клієнтів',
                'value' => '',
                'key' => Setting::EMAIL_CORPORATE,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Наш номер телефону',
                'value' => '',
                'key' => Setting::PHONE,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],

            // Мета
            [
                'name' => 'Мета Title',
                'value' => '',
                'key' => Setting::META_TITLE,
                'category' => Setting::CATEGORY_META,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Мета Description',
                'value' => '',
                'key' => Setting::META_DESCRIPTION,
                'category' => Setting::CATEGORY_META,
                'type' => Setting::TYPE_TEXTAREA,
                'description' => ''
            ],
            [
                'name' => 'Мета Image',
                'value' => '',
                'key' => Setting::META_IMAGE,
                'category' => Setting::CATEGORY_META,
                'type' => Setting::TYPE_IMAGE,
                'description' => ''
            ],
            // МЕТА

            [
                'name' => 'Наш TikTok',
                'value' => '',
                'key' => Setting::TIKTOK_LINK,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_INPUT,
                'description' => ''
            ],
            [
                'name' => 'Про компанію',
                'value' => '',
                'key' => Setting::PAGE_COMPANY,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => ''
            ],
            [
                'name' => 'Контакти',
                'value' => '',
                'key' => Setting::PAGE_CONTACTS,
                'category' => Setting::CATEGORY_FOOTER,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => ''
            ],
//            [
//                'name' => 'Добавлення пунктів меню',
//                'value' => '',
//                'key' => Setting::HEADER_ITEMS_MENU,
//                'category' => Setting::CATEGORY_HEADER,
//                'type' => Setting::TYPE_TEXTAREA,
//                'description' => ''
//            ],
            [
                'name' => 'Головне меню',
                'value' => '',
                'key' => Setting::HEADER_CATEGORY_MENU,
                'category' => Setting::CATEGORY_HEADER,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => ''
            ],
            [
                'name' => 'КатегоріЇ на головній сторінці',
                'value' => '',
                'key' => Setting::BLOCKS_CATEGORY_HOME_PAGE,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => ''
            ],
            [
                'name' => 'Добавлення категорій в бокове меню',
                'value' => '',
                'key' => Setting::HEADER_ITEMS_LEFT_MENU,
                'category' => Setting::CATEGORY_GENERAL,
                'type' => Setting::TYPE_MULTIPLE,
                'description' => ''
            ],
        ];

        foreach ($settingsData as $settingData) {
            $setting = $this->settingRepository->getOne($settingData['key'], 'key');
            if (!$setting) {
                $this->settingRepository->create($settingData);
            } else {
                $setting = $this->settingRepository->getOneOrFail($setting->id);
                unset($settingData['value']);
                $this->settingRepository->update($setting, $settingData);
            }
        }
    }
}
