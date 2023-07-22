<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['surname', 'name', 'patronymic', 'biography'];

    public function image()
    {
        return $this->belongsToMany(File::class, 'author_image', 'author_id', 'image_id')
            ->withTimestamps();
    }


}
