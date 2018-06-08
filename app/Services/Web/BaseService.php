<?php

namespace App\Services\Web;

use App\Services\Web\Contracts\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    /**
     * @var Eloquent model
     */
    protected $model;

    public function getAll()
    {
        return $this->model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
