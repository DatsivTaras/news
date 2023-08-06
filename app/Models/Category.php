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
 * @property $description
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
		'description' => 'string',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    public function getName()
    {
        return $this->name;
    }

    /**
     * @var string
     */
    public function getUrl(): string
    {
        return route('category.show', $this->slug);
    }

    /**
     * @var string
     */
    public function getAdminUrl(): string
    {
        return route('admin.categories.show', $this->slug);
    }

    /**
     * @var string
     */
    public function getShortDescription():?string
    {
        return $this->description;
    }

    /**
     * @var string
     */
    public function getDecription():?string
    {
        return $this->description;
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_categories', 'category_id', 'news_id')
            ->withTimestamps();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
