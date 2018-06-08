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

    public function getAvailableCategoryForUser()
    {
        return $this->model->orderByNameAsc();
    }

    public function getAbilityCategoriesOfUser($user)
    {
        if($user->isAccessAdmin()) {
            return $this->model->orderByNameAsc();
        }

        $abilitiesOfUser = $user->abilityCategories()->pluck('category_id')->toArray();

        return $this->model->whereIn('id', $abilitiesOfUser)->orderByNameAsc();
    }

    public function getIdArrOfAbilityCategoriesOfUser($user)
    {
        return $this->getAbilityCategoriesOfUser($user)->orderByNameAsc()->pluck('id')->toArray();
    }

    public function getAllProductsByCategory($categoryId)
    {
        $category = $this->model->find($categoryId);

        return $category->products();
    }
}
