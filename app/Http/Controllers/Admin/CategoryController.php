<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\CategoryRequest;
use App\Models\Category;
use App\Services\Web\Contracts\CategoryServiceInterface;

class CategoryController extends BaseController
{
    public function __construct(CategoryServiceInterface $service)
    {
        parent::__construct();

        $this->service = $service;

        $this->viewData['title'] = "Tieu de Category";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->viewData['categories'] = Category::orderBy('id','DESC')->paginate(5);

        return view('admin.category.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->viewData['title'] = "Add Category";

        return view('admin.category.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        $inputs = $request->only('name');

        $category = $this->service->create($inputs);

        return redirect()->route('category.index')
            ->with('success','Thêm Category thành công!');
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
        $category = Category::find($id);
        $this->viewData['category'] = $category;

        return view('admin.category.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $inputs = $request->only('name');

        $category = Category::find($id);
        $this->service->update($category, $inputs);

        return redirect()->route('category.index')
            ->with('success','Cập nhật Category thành công!');
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
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')
            ->with('success','Xóa Category thành công!');
    }
}
