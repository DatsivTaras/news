<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    public function get(array $options = [], array $columns = ['*']): Collection
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();
        $this->applyOptions($query, $options);

        $query->select($columns);

        return $query->get();
    }

    public function getQuery(): Builder
    {
        return ($this->getModelClass())::query();
    }

    public function count(array $options = []): int
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();
        $this->applyFilters($query, $options);

        return $query->count();
    }

    public function getOne($value, $attribute = 'id', bool $withTrashed = false)
    {
        $query = ($this->getModelClass())::where($attribute, '=', $value);

        if ($withTrashed) {
            $query->withTrashed();
        }

        return $query->first();
    }

    public function getOneOrFail($value, $attribute = 'id')
    {
        return ($this->getModelClass())::where($attribute, '=', $value)->firstOrFail();
    }

    public function getOneByConditions(array $conditions, $with = null, ?array $order = null)
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();

        foreach ($conditions as $key => $value) {
            if(is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        if (!empty($with)) {
            $query->with($with);
        }

        if ($order) {
            $orderDirection = $order['direction'] ?? 'asc';
            $orderColumn = is_array($order)? $order['column'] : $order;

            $query->orderBy($orderColumn, $orderDirection);
        }

        return $query->first();
    }

    public function getByConditions(array $conditions, $with = null)
    {
        $query = ($this->getModelClass())::query();

        foreach ($conditions as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        if (!empty($with)) {
            $query->with($with);
        }

        return $query->get();
    }

    public function save(Model $model)
    {
        if ($model->save()) {
            return $model;
        }

        throw new \Exception('Cannot save model ' . $this->getModelClass());
    }

    public function create(array $data)
    {
        $modelClass = $this->getModelClass();
        $model = new $modelClass();
        $model->fill($data);

        if ($model->save()) {
            return $model;
        }

        throw new \Exception('Cannot create model' . $this->getModelClass());
    }

    public function firstOrCreate(array $data)
    {
        $modelClass = $this->getModelClass();
        $model = new $modelClass();
        return $model->firstOrCreate($data);
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

    /**
     * @param array $conditions List of conditions
     * @param array $data
     * @return bool
     */
    public function updateByConditions(array $conditions, array $data)
    {
        /** @var Model $instance */
        $instance = ($this->getModelClass())::where($conditions)->first();

        if ($instance) {
            $instance->fill($data);
            return $instance->save();
        }

        return false;
    }

    /**
     * @param array $conditions
     * @param array $data
     * @return bool
     */
    public function updateByConditionsAll(array $conditions, array $data): bool
    {
        return ($this->getModelClass())::where($conditions)->update($data);
    }

    /**
     * @param array $conditions List of conditions
     * @param array $data
     * @return bool
     */
    public
    function deleteByConditions(array $conditions)
    {
        /** @var Model $instance */
        $instance = $this->getOneByConditions($conditions);

        if ($instance) {
            return $this->delete($instance);
        }

        return false;
    }

    /**
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        if ($model->delete()) {
            return $model;
        }
        throw new \Exception('Cannot delete model ' . $this->getModelClass());
    }

    public function new(array $initialAttributes = [])
    {
        $modelClass = $this->getModelClass();
        $model = new $modelClass;
        $model->forceFill($initialAttributes);

        return $model;
    }

    public function forceDelete(Model $model)
    {
        if ($model->forceDelete()) {
            return $model;
        }
        throw new \Exception('Cannot force delete model ' . $this->getModelClass());
    }

    public function table(array $options = [], int $perPage = 10, array $defaultSort = []): LengthAwarePaginator
    {
        /** @var Builder $query */
        $query = ($this->getModelClass())::query();

        if ($defaultSort) {
            $query->orderBy($defaultSort['field'], $defaultSort['direction'] ?? 'asc');
        }

        $this->applyFilters($query, $options);
        $this->applyWith($query, $options);

        return $query->paginate($perPage);
    }

    public function insertBatch(array $data, bool $ignoreDuplicates = false): void
    {
        $method = $ignoreDuplicates ? 'insertOrIgnore' : 'insert';
        ($this->getModelClass())::query()->$method($data);
    }

    protected abstract function getModelClass(): string;

    final protected function getModelInstance(): Model
    {
        $modelClass = $this->getModelClass();

        return new $modelClass();
    }

    protected function applyOptions(Builder $query, array $options): void
    {
        if (!empty($options['sort']['field'])) {
            $query->orderBy($options['sort']['field'], $options['sort']['direction'] ?? 'asc');
        }

        if (!empty($options['limit'])) {
            $query->limit($options['limit']);
        }

        if (!empty($options['paginate'])) {
            $query->paginate($options['paginate']);
        }

        if (!empty($options['offset'])) {
            $query->offset($options['offset']);
        }

        $this->applyWith($query, $options);
        $this->applyFilters($query, $options);
    }

    protected function applyFilters($query, array $options): void
    {
        $this->applySearch($query, $options);

        if (!empty($options['filters'])) {
            foreach ($options['filters'] as $key => $values) {
                if (!is_array($values) and !($values instanceof Collection)) {
                    $values = [$values];
                }

                $query->whereIn($key, $values);
            }
        }
        if (!empty($options['between'])) {
            $query->whereBetween($options['between']['field'], [$options['between']['from'], $options['between']['to']]);
        }
        if (!empty($options['filtersNot'])) {
            foreach ($options['filtersNot'] as $key => $values) {
                if (!is_array($values) and !($values instanceof Collection)) {
                    $values = [$values];
                }

                $query->whereNotIn($key, $values);
            }
        }

        if (!empty($options['filtersOr'])) {
            foreach ($options['filtersOr'] as $key => $values) {
                if (!is_array($values) and !($values instanceof Collection)) {
                    $values = [$values];
                }

                $query->orWhere($key, $values);
            }
        }

        if (!empty($options['with'])) {
            $query->with($options['with']);
        }

        if (!empty($options['except'])) {
            foreach ($options['except'] as $key => $values) {
                if (!is_array($values) and !($values instanceof Collection)) {
                    $values = [$values];
                }

                $query->whereNotIn($key, $values);
            }
        }

        if (!empty($options['whereHas'])) {
            foreach ($options['whereHas'] as $item) {
                $query->whereHas($item[0], $item[1]);
            }
        }

        if (!empty($options['whereNotNull'])) {
            foreach ($options['whereNotNull'] as $item) {
                $query->whereNotNull($item);
            }
        }
    }

    protected function applySearch($query, array $options): void
    {
        if ($this->getSearchFields()) {
            if (isset($options['search']) && trim($options['search']) !== '') {
                $query->where(function (Builder $query) use ($options) {
                    foreach ($this->getSearchFields() as $field) {
                        $query->orWhere($field, 'like', '%' . $options['search'] . '%');
                    }
                });
            }
        }
    }

    protected function applyWith(Builder $query, array $options): void
    {
        if (!empty($options['with'])) {
            $query->with($options['with']);
        }
    }

    protected function getSearchFields(): array
    {
        return [];
    }

    protected function getRawSelect($sql, $params = []): array
    {
        $sql = str_replace('pfx_', \DB::getTablePrefix(), $sql);
        return \DB::select(\DB::raw($sql), $params);
    }

    protected function getRawOne($sql, $params = []): object
    {
        $sql = str_replace('pfx_', \DB::getTablePrefix(), $sql);
        return \DB::selectOne(\DB::raw($sql), $params);
    }

    public function massDelete(array $ids)
    {
        return ($this->getModelClass())::query()->whereIn('id', $ids)->delete();
    }

    public function upsert($data, $uniqueBy, $update = null): void
    {
        ($this->getModelClass())::upsert($data, $uniqueBy, $update);
    }

    public function getOneOrCreate(array $filters, array $createAttributes = [], array $with = [])
    {
        $model = $this->getOneByConditions($filters, $with);

        if (!$model) {
            $model = $this->create(
                array_merge($filters, $createAttributes)
            );
            $model->with($with);
        }

        return $model;
    }

    public function massDeleteByConditions(array $conditions)
    {
        $query = ($this->getModelClass())::query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->whereIn($field, $value);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->delete();
    }

    public function attach(Model $model, string $relation, $values): void
    {
        $model->$relation()->attach($values);
    }

    public function detach(Model $model, string $relation, $values): void
    {
        $model->$relation()->detach($values);
    }

    public function associate(Model $model, string $relation, Model $value): void
    {
        $model->$relation()->associate($value);
    }

    public function dissociate(Model $model, string $relation, Model $value): void
    {
        $model->$relation()->dissociate($value);
    }
}
