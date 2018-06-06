<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Services\Web\Contracts\CategoryServiceInterface;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(
        CategoryServiceInterface $categoryService
    )
    {
        //
        $this->categoryService = $categoryService;
    }

    public function before($user, $ability)
    {
        //Ignore Admin restrict for all action
        if ($user->isAccessAdmin()) {
            return true;
        }
    }

    public function create($user)
    {
        return $user->hasPermission('create-product');
    }

    public function update($user)
    {
        return $user->hasPermission('update-product');
    }

    public function delete($user)
    {
        return $user->hasPermission('delete-product');
    }

    public function touchProduct($user, Product $product)
    {
        //If intersect beetween category lists of this product and Ability Categories this user can do, so return true
        return array_intersect($this->categoryService->getIdArrOfAbilityCategoriesOfUser(auth()->user()), $product->idArrOfCategories());
    }
}
