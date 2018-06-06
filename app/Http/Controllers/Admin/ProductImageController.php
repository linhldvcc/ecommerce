<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Web\Contracts\ProductServiceInterface;
use App\Services\Web\Contracts\ProductImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductImageController extends BaseController
{
    public function __construct(
        ProductImageServiceInterface $productImageService
    )
    {
        parent::__construct();
        $this->productImageService = $productImageService;
    }

    public function uploadImage($productId, Request $request)
    {
        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];

            $stored_image =  $this->productImageService->storeImageForProduct($productId, $photo);
        }

        return response()->json([
            'message' => 'Image saved Successfully',
            'serverId' => $stored_image->id,
        ], 200);
    }

    public function deleteImage($id, Request $request) {
        if($request->ajax()) {
            $image = ProductImage::find($request->id); //Get image by id or desired parameters

            if (File::exists($image->savePath)) {
                File::delete($image->savePath);
            }

            if (File::exists($image->thumbImagePath)) {
                File::delete($image->thumbImagePath);
            }

            $image->delete();  //Delete file record from DB
        }

        return response('Photo deleted', 200); //return success
    }

    public function getAllImageOfProduct($productId)
    {
        $product = Product::find($productId);

        foreach ($product->images as $image) {
            $fileSize = 0;
            if(File::exists(public_path($image->savePath))) {
                $fileSize = File::size(public_path($image->savePath));
            }

            $imageAnswer[] = [
                'name' => $image->original_name,
                'path' => $image->thumbImagePath,
                'size' => $fileSize,
                'id'   => $image->id,
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }
}
