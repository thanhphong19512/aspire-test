<?php

namespace App\Repositories;

use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoriesInterface
{
    /**
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes): ?Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findOrFail(int $id): ?Model;
}
