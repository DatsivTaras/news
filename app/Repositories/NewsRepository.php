<?php

namespace App\Repositories;

use App\Classes\Enum\NewsPublicationType;
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
    public function getPaginationNews(array $options = [], int $perPage = 1, array $defaultSort = []): LengthAwarePaginator
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();

        if ($defaultSort) {
            $query->orderBy($defaultSort['field'], $defaultSort['direction'] ?? 'asc');
        }

        if (isset($options['search'])) {
            $query->search($options['search']);
            unset($options['search']);
        }

        if (isset($options['viewType'])) {

            if ($options['viewType'] == 'main') {
                $options['filters'] = ['type' => NewsPublicationType::IMPORTANT];
            }
            if ($options['viewType'] == 'popular') {


                $selectedOptionValuesIDSort = [117, 115];

                $sortedIds = implode(',', $selectedOptionValuesIDSort);
                $query->orderByRaw("FIELD(id, {$sortedIds})");



//                $query->whereDate('created_at','=', now()->format('Ymd'));
                $query->orderByUniqueViews('desc');

            }
        }

        $query->where('date_of_publication','<=', now());
        $this->applyFilters($query, $options);
        $this->applyWith($query, $options);

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
        return ['title', 'subtitle', 'mini_description', 'description'];
    }
}
