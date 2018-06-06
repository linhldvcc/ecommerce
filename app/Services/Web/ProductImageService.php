<?php

namespace App\Services\Web;

use App\Services\Web\Contracts\ProductImageServiceInterface;
use App\Models\ProductImage;
use Intervention\Image\Facades\Image;

class ProductImageService extends BaseService implements ProductImageServiceInterface
{
    public function __construct(ProductImage $model)
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

    public function storeImageForProduct($productId, $photo)
    {
        $this->photos_path = $this->model::$save_folder;

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        $save_name = $productId."_".str_random(5)."_".$photo->getClientOriginalName();

        $thumb_name =  $this->model::$thumb_prefix.$save_name;

        Image::make($photo)
            ->resize(245, 245,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
            ->resizeCanvas(245, 245)
            ->save(public_path($this->photos_path.'/'.$thumb_name));

        $photo->move($this->photos_path, $save_name);

        $productImage['product_id'] = $productId;
        $productImage['original_name'] = $photo->getClientOriginalName();
        $productImage['save_name'] = $save_name;

        $stored_image = $this->create($productImage);

        return $stored_image;
    }
}
