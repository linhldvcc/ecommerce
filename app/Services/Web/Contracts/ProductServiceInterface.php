<?php

namespace App\Services\Web\Contracts;

interface ProductServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $inputs Associative array [name, email, password]
     *
     * @return \App\Models\Product|array
     */
    public function create(array $inputs);


    /**
     * @param \App\Models\Product $category
     * @param array $inputs Associative array [name]
     *
     * @return boolean
     */
    public function update($category, $inputs);
}
