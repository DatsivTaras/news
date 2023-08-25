<?php

namespace App\Repositories;

use App\Classes\Enum\NewsType;
use App\Models\News;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class  NewsRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return News::class;
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title'], '_');

        $modelClass = $this->getModelClass();
        $model = new $modelClass();
        $model->fill($data);

        if ($model->save()) {
            return $model;
        }

        throw new \Exception('Cannot create model ' . $this->getModelClass());
    }

    public function getPopularTable(array $options = [], int $perPage = 10): LengthAwarePaginator
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();

        $this->applyFilters($query, $options);
        $this->applyWith($query, $options);
        $query->orderByUniqueViews('desc');

        return $query->paginate($perPage);
    }

    public function getNewsBasket($request)
    {
        return News::filter($request)->onlyTrashed()->paginate('30');
    }

    public function getNewsDrafts($request)
    {
        return News::filter($request)->where('type_publication', NewsType::DRAFT)->orderBy('created_at', 'desc')->paginate('30');
    }

    public function getNews($request)
    {
        return News::filter($request)->where('type_publication', NewsType::PUBLISH)->orderBy('created_at', 'desc')->paginate('30');
    }

    public function restoreNews($id)
    {
      return News::onlyTrashed()
            ->where('id', $id)
            ->restore();
    }

    public function finalDelete($id)
    {
        $new = News::withTrashed()
            ->where('id', $id)
            ->first();

        return $new->forceDelete();
    }

    public function getLastNewsForCategoory($id)
    {
        $news = News::with('news_category')
            ->whereHas('news_category', function ($q) use($id){
                $q->where('category_id', $id);
            })
            ->first();

        return $news;
    }

    protected function getSearchFields(): array
    {
        return ['title','subtitle','mini_description','description'];
    }
}
