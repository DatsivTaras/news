<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'params'];

    static $rules = [
        'title' => '',
        'description' => '',
    ];

    const TYPE_INPUT = 1;
    const TYPE_CHECKBOX= 2;
    const TYPE_TEXTAREA= 3;
    const TYPE_SELECT = 4;
    const TYPE_IMAGE = 5;
    const TYPE_MULTIPLE = 6;

    const CATEGORY_GENERAL = 1;
    const CATEGORY_HEADER = 2;
    const CATEGORY_FOOTER = 3;

    const HEADER_IMAGE = 'header_image';
    const SITE_NAME = 'site_name';
    const FOOTER_IMAGE = 'footer_image';
    const HEADER_ITEMS_MENU = 'header_items_menu';
    const HEADER_CATEGORY_MENU = 'header_category_menu';
    const BLOCKS_CATEGORY_HOME_PAGE = 'blocks_cateory_home_page';
    const HEADER_ITEMS_LEFT_MENU = 'header_items_left_menu';

    const FACEBOOK_LINK = 'facebook_link';
    const TWITTER_LINK = 'twitter_link';
    const TELEGRAM_LINK = 'telegram_link';
    const YOUTUBE_LINK = 'youtube_link';
    const INSTAGRAM_LINK = 'instagram_link';
    const TIKTOK_LINK = 'tiktok_link';
    const EMAIL_ADDRESS = 'email_address';

    const PAGE_COMPANY = 'page_company';
    const PAGE_CONTACTS = 'page_contacts';

    const ADDRESS = 'address';
    const PHONE = 'phone';

    public function image()
    {
        return $this->hasOne(File::class, 'id','value');
    }

    public static function settingsCategory() {
        return [
            self::CATEGORY_GENERAL => __('main.general'),
            self::CATEGORY_HEADER => __('main.header'),
            self::CATEGORY_FOOTER => __('main.footer')
        ];
    }

    public static function getSettingsCategory($key)
    {
        $category = self::settingsCategory();

        return array_key_exists($key, $category) ?  $category[$key] : "";
    }
    public static function getStatus($key)
    {
       $setting = Setting::where('key', $key)->first();

        return $setting->type;
    }

    public static function getParams($key)
    {
        if ($key == self::HEADER_ITEMS_LEFT_MENU) {
            return Category::doesnthave('parent',)->pluck('name', 'id')->toArray();;
        }
        if ($key == self::BLOCKS_CATEGORY_HOME_PAGE) {
            return Category::doesnthave('parent',)->pluck('name', 'id')->toArray();;
        }
        if ($key == self::HEADER_CATEGORY_MENU) {
            return Category::doesnthave('parent',)->pluck('name', 'id')->toArray();;
        }
        if ($key == self::PAGE_COMPANY) {
            return Page::pluck('title', 'id')->toArray();;
        }
        if ($key == self::PAGE_CONTACTS) {
            return Page::pluck('title', 'id')->toArray();;
        }
    }
}
