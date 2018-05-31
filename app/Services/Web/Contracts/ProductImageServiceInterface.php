<?php

namespace App\Services\Web\Contracts;

interface ProductImageServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $inputs Associative array [name, email, password]
     *
     * @return \App\Models\Product|array
     */
    public function create(array $inputs);

}
