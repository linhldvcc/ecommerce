<?php

namespace App\Services\Web;

use App\Services\Web\Contracts\ProductServiceInterface;
use App\Models\Product;
use App\Services\Web\CategoryService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public function __construct(
        Product $model,
        CategoryService $categoryService
    )
    {
        $this->model = $model;
        $this->categoryService = $categoryService;
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

    public function syncCategory($product, $category_id)
    {
        //Just accept to Sync Ability Categories for current User
        $userAbilityCategories = $this->categoryService->getIdArrOfAbilityCategoriesOfUser(auth()->user());
        $category_id = array_intersect($category_id, $userAbilityCategories);

        if($category_id) {
            $product->categories()->sync($category_id);
        }
    }

    public function getAvailableProductForAuth()
    {
        //Get all Product for Admin
        if(auth()->user()->isAccessAdmin()) {
            return new Product();
        }

        //Eager-loading Ability Categories for user with their Products
        $abilityCategory = $this->categoryService->getAbilityCategoriesOfUser(auth()->user())
            ->select('id')
            ->with(['products' =>function($query){
                $query->select(['products.id'])->get();
            }])
            ->get();
        //then collect the id of ability Product to load them to View
        $abilityProductsArr = [];

        foreach($abilityCategory as $category) {
            foreach($category->products as $product) {
                $abilityProductsArr[] = $product->id;
            }
        }

        return Product::whereIn('id', $abilityProductsArr);
    }
}
