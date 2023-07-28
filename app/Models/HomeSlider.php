<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HomeSlider
 *
 * @property $id
 * @property $sort_order
 * @property $news_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HomeSlider extends Model
{

    protected $table = 'home_slider';

    public function aldNews()
    {
        return $this->hasOne(News::class, 'id','news_id')->orderBy('created_at', 'DESC');
    }
    public function news()
    {
        return $this->hasOne(News::class, 'id','news_id');
    }

    static $rules = [
		'sort_order' => '',
		'news_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sort_order','news_id'];



}
