<?php

namespace App\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RepositoryFoundation
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function getQuery(): Builder
    {
        return $this->model::query();
    }
}