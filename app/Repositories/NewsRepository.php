<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class NewsRepository extends BaseRepository
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
}
