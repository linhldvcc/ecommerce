<?php

namespace App\Http\Controllers\Admin;

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
        $this->viewData['products'] = $this->service->getAvailableProductForAuth()->orderByIdDesc()->paginate(5);

        return view('admin.product.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-product');
        //
        $this->viewData['title'] = "Thêm Sản phẩm";
        $this->viewData['categories'] = $this->categoryService->getAbilityCategoriesOfUser(auth()->user())->get();

        return view('admin.product.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $inputs = $request->only('title','desc','price','old_price');

        $product = $this->service->create($inputs);
        $this->service->syncCategory($product, $request->get('category_id'));

        if($request->images) {
            foreach ($request->images as $image) {
                $this->productImageService->storeImageForProduct($product->id, $image);
            }
        }

        return redirect()->route('product.index')
            ->with('success','Thêm Product thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        
        $this->authorize('touch-product', $product);
        $this->authorize('update-product');

        $this->viewData['product'] = $product;
        $this->viewData['categories'] = $this->categoryService->getAbilityCategoriesOfUser(auth()->user())->get();
        $this->viewData['productCategories'] = $product->categories->pluck('id')->toArray();

        $this->viewData['title'] = "Edit Product";

        return view('admin.product.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $inputs = $request->all();

        $product = Product::find($id);
        $this->authorize('touch-product', $product);
        $this->authorize('update-product');

        $this->service->update($product, $inputs);
        //Sync it's category when change
        $this->service->syncCategory($product, $inputs['category_id']);

        return redirect()->route('product.index')
            ->with('success','Cập nhật Product thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $this->authorize('touch-product', $product);
        $this->authorize('delete-product');

        //delete related Category_product field
        $product->categories()->detach();
        foreach($product->images as $image) {
            try {
                DB::beginTransaction();

                $image_path = $image->save_name;
                $image->delete();

                File::delete($image_path);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success','Xóa Product thành công!');
    }
}
