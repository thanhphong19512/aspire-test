<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoriesInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * AbstractRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes): ?Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }
}
