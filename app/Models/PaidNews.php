<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaidNews
 *
 * @property $id
 * @property $news_id
 * @property $sort_order
 * @property $created_at
 * @property $updated_at
 *
 * @property News $news
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaidNews extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['news_id','sort_order'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function news()
    {
        return $this->hasOne('App\Models\News', 'id', 'news_id');
    }
    

}
