<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Web\Contracts\ProductServiceInterface;

class ProductController extends BaseController
{
    public function __construct(ProductServiceInterface $service)
    {
        parent::__construct();

        $this->service = $service;

        $this->viewData['title'] = "Tieu de Product";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['products'] = Product::orderBy('id','DESC')->paginate(10);

        return view('admin.product.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->viewData['title'] = "Add Product";
        $this->viewData['categories'] = Category::orderBy('name','ASC')->get();

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

        $product->categories()->attach($request->get('category_id'));

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
        //
        $product = Product::find($id);
        $this->viewData['product'] = $product;
        $this->viewData['categories'] = Category::orderBy('name', 'ASC')->get();
        $this->viewData['productCategories'] = $product->categories->pluck('id')->toArray();

        var_dump($this->viewData['productCategories']);

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
        //
        $inputs = $request->all();

        $product = Product::find($id);
        $this->service->update($product, $inputs);

        $product->categories()->sync($inputs['category_id']);

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
        //delete related Category_product field
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('product.index')
            ->with('success','Xóa Product thành công!');
    }
}
