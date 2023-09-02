<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Author
 *
 * @property $id
 * @property $surname
 * @property $name
 * @property $patronymic
 * @property $biography
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Author extends Model
{

    static $rules = [
		'surname' => 'required',
		'name' => 'required',
		'user_id' => 'required',
		'image' => '',
		'patronymic' => 'required',
		'biography' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['surname', 'slug', 'name', 'patronymic', 'biography', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function getUrl()
    {
        return route('author.show', ['slug' => $this->slug]);
    }

    public function getAurhorFullName()
    {
        return $this->surname . ' ' . $this->name;
    }

    public function image()
    {
        return $this->belongsToMany(File::class, 'author_image', 'author_id', 'image_id')
            ->withTimestamps();
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_authors', 'author_id', 'news_id')
            ->withTimestamps();
    }
    public function getImageUrl()
    {
        return $this->image && isset($this->image[0]) ? asset(Storage::url( $this->image[0]->name)) : 'defualtimgae.png';
    }


}
