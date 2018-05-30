<?php

namespace App\Services\Web;

use App\Services\Web\Contracts\ProductServiceInterface;
use App\Models\Product;

class ProductService extends BaseService implements ProductServiceInterface
{
    public function __construct(Product $model)
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
     * @param \App\Models\Product $category
     * @param array            $inputs Associative array [name]
     *
     * @return boolean
     */
    public function update($category, $inputs)
    {
        return $category->update([
            'title' => $inputs['title'],
            'desc' => $inputs['desc'],
            'price' => $inputs['price'],
            'old_price' => $inputs['old_price'],
        ]);
    }
}
