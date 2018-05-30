<?php

namespace App\Services\Web;

use App\Services\Web\Contracts\CategoryServiceInterface;
use App\Models\Category;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $inputs Associative array [name, email, password]
     *
     * @return \App\Models\User|array
     */
    public function create(array $inputs)
    {
        return $this->model->create($inputs);
    }

    /**
     * @param \App\Models\Category $category
     * @param array            $inputs Associative array [name]
     *
     * @return boolean
     */
    public function update($category, $inputs)
    {
        return $category->update([
            'name' => $inputs['name'],
        ]);
    }
}
