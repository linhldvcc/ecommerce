<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Web\Contracts\CategoryServiceInterface;
use App\Services\Web\Contracts\ProductServiceInterface;
use App\Services\Web\Contracts\ProductImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    public function __construct(
        ProductServiceInterface $service,
        ProductImageServiceInterface $productImageService,
        CategoryServiceInterface $categoryService
    )
    {
        parent::__construct();

        $this->service = $service;
        $this->productImageService = $productImageService;
        $this->categoryService = $categoryService;

        $this->viewData['title'] = "Danh sách Sản phẩm";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['products'] = $this->service->all()->orderByIdDesc()->paginate(5);

        return view('admin.product.index', $this->viewData);
    }

    public function detail($id)
    {
        $this->viewData['product'] = $this->service->find($id);

        return view('web.product.detail', $this->viewData);
        //
    }

    public function getAllProductsByCategory($categoryId)
    {
        $this->viewData['categories'] = $this->categoryService->getAvailableCategoryForUser()->get();
        $this->viewData['products'] = $this->categoryService->getAllProductsByCategory($categoryId)->paginate(1);

        return view('web.index', $this->viewData);
    }
}
