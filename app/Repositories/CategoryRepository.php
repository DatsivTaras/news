<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Category::class;
    }

    public function getParentsCategories($id)
    {
        return Category::doesnthave('parent')
            ->where('id', '!=', $id)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getParentsCategoriesForNews()
    {
        return Category::doesnthave('parent')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getFooterCategories()
    {
        return Category::doesntHave('parent')->get();
    }

    public function getCategories()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return $categories;
    }

    public function getCategoryHeaderMenu()
    {
        $option = [
            'limit' => '10',
        ];

        return $this->get($option);
    }

    public function getCategoryWhereIn($ids)
    {
        $option = [
            'filters' => ['id' => $ids],
        ];

        return $this->get($option);
    }

    public function getCategoryPaginate()
    {
        $categories = $this->getQuery()->paginate('15');

        return $categories;
    }
    /**
     * @param Model $model
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function update(Model $model, array $data)
    {
        $model->fill($data);

        if ($model->save()) {
            return $model;
        }
        throw new \Exception('Cannot update model ' . $this->getModelClass());
    }
}
