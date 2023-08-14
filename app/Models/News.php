<?php

namespace App\Models;

use App\Classes\Enum\NewsPublicationType;
use App\Classes\Enum\NewsStatus;
use App\Classes\Enum\NewsType;
use App\Filters\QueryFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Support\Facades\Storage;

/**
 * Class News
 *
 * @property $id
 * @property $title
 * @property $slug
 * @property $subtitle
 * @property $mini_description
 * @property $description
 * @property $type_publication
 * @property $type
 * @property $author_id
 * @property $date_of_publication
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class News extends Model implements Viewable
{
    use InteractsWithViews;

    static $rules = [
        'tags' => 'required',
        'title' => 'required',
		'slug' => '',
		'image' => '',
		'author_id' => '',
		'subtitle' => 'required',
		'mini_description' => 'required',
		'description' => 'required',
		'category_id' => 'required',
		'type_publication' => 'required',
		'type' => 'required',
		'date_of_publication' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'subtitle', 'mini_description', 'description', 'type_publication',
        'type', 'date_of_publication'
    ];

    protected $perPage = 20;

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getNewsType()
    {
        if($this->type == NewsPublicationType::IMPORTANT) {
            return true;
        }
        return false;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPublicationDate()
    {
        return Carbon::parse($this->date_of_publication)->format('d.m.Y H:i');
    }

    public function getUrl()
    {
        return route('news.show', ['slug' => $this->slug]);
    }

    public function getImageUrl()
    {
        return $this->image && isset($this->image[0]) ? asset(Storage::url( $this->image[0]->name)) : 'defualtimgae.png';
    }

    public function news_category()
    {
        return $this->hasOne(NewsCategory::class, 'news_id','id');
    }

    public function home_slider()
    {
        return $this->hasOne(HomeSlider::class, 'news_id','id');
    }

    public function getTypePublication()
    {
        $statuses = self::typePublicationList();

        return array_key_exists($this->type_publication, $statuses) ?  $statuses[$this->type_publication] : "";
    }

    public function getType()
    {
        $statuses = self::typeList();

        return array_key_exists($this->type, $statuses) ?  $statuses[$this->type] : "";
    }

    public function typeList()
    {
        return [
            NewsPublicationType::SIMPLE => 'Проста',
            NewsPublicationType::IMPORTANT => 'Важлива',
        ];
    }

    public function typePublicationList()
    {
        return [
            NewsType::PUBLISH => 'Опублікована',
            NewsType::DRAFT => ' В чернетках',
        ];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags', 'news_id', 'tags_id')
            ->withTimestamps();
    }

    public function image()
    {
        return $this->belongsToMany(File::class, 'news_images', 'news_id', 'image_id')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'news_categories', 'news_id', 'category_id')
            ->withTimestamps();
    }

    public function author()
    {
        return $this->belongsToMany(Author::class, 'news_authors', 'news_id', 'author_id')
            ->withTimestamps();
    }
}
