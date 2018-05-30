<?php

namespace App\Services\Web\Contracts;

interface CategoryServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $inputs Associative array [name, email, password]
     *
     * @return \App\Models\Category|array
     */
    public function create(array $inputs);


    /**
     * @param \App\Models\Category $category
     * @param array $inputs Associative array [name]
     *
     * @return boolean
     */
    public function update($category, $inputs);
}
