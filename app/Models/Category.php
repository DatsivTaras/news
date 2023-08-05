<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property $id
 * @property $name
 * @property $slug
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model
{

    static $rules = [
		'name' => 'required',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_categories', 'category_id', 'news_id')
            ->withTimestamps();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    public function getUrl()
    {
        return route('category.show', $this->slug);
    }

    public function getName()
    {
        return $this->name;
    }

}
