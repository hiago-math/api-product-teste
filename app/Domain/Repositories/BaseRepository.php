<?php

namespace App\Domain\Repositories;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    public function all($attributes = ['*']): Collection
    {
        return $this->model::orderBy('name')->get($attributes);
    }

    public function create(array $attributes = []): Model
    {
        $instance = $this->createModel();

        $instance->fill($attributes);

        $instance->save();

        return $instance;
    }

    public function firstOrCreate(array $attributes = []): Model
    {
        $instance = $this->createModel();

        return $instance->firstOrCreate($attributes);
    }

    public function firstOrNew(array $attributes = []): Model
    {
        $instance = $this->createModel();

        $instance->firstOrNew($attributes);

        return $instance;
    }

    public function createModel(): Model
    {
        return new $this->model;
    }

    public function find($id)
    {
        return $this->createModel()->find($id);
    }

    public function findOneBy($key, $value)
    {
        return $this->createModel()->where($key, '=', $value)->first();
    }

    public function where($key, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->createModel()->where(...func_get_args());
    }

    public function whereIn($key, $values)
    {
        return $this->createModel()->whereIn($key, $values)->get();
    }

    public function whereLike($key, $value)
    {
        return $this->createModel()->where($key, 'like', "{$value}%");
    }

    public function orWhere($key, $value)
    {
        return $this->createModel()->orWhere($key, $value);
    }

    public function update(Model $instance, array $attributes = []): ?Model
    {
        $instance->fill($attributes);

        $instance->save();
        $instance->touch();

        return $instance;
    }

    public function delete(Model $instance)
    {
        return $instance->delete();
    }

    public function getFillable(): array
    {
        return $this->createModel()->getFillable();
    }

    public function updateOrCreate(array $value)
    {
        $instance = $this->createModel();

        return $instance->updateOrCreate(
            $value
        );
    }
}
