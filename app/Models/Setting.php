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

    const CATEGORY_GENERAL = 1;
    const CATEGORY_HEADER = 2;
    const CATEGORY_FOOTER = 3;

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
}
