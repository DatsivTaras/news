<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @property $id
 * @property $title
 * @property $slug
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Page extends Model
{

    static $rules = [
		'title' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['slug','title','description'];

    public function getUrl()
    {
        return route('page.show', $this->slug);
    }

    public function getName()
    {
        return $this->title;
    }

}
