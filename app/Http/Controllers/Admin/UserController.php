<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use App\Services\Web\Contracts\UserServiceInterface;
use App\Services\Web\Contracts\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class UserController extends BaseController
{
    public function __construct(
        UserServiceInterface $service,
        CategoryServiceInterface $categoryService
    )
    {
        parent::__construct();

        $this->service = $service;
        $this->categoryService = $categoryService;

        $this->viewData['title'] = "Danh sách User";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin-role');
        //
        $this->viewData['users'] = User::where('id','!=',Auth::id())->orderBy('id','DESC')->paginate(5);

        return view('admin.user.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $this->viewData['title'] = "Thêm User";
//
//        return view('admin.user.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
//        $inputs = $request->only('name');
//
//        $user = $this->service->syncAbilities($inputs);
//
//        return redirect()->route('user.index')
//            ->with('success','Thêm User thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin-role');

        $this->viewData['title'] = "Sửa User";
        //
        $user = User::find($id);
        $this->viewData['user'] = $user;

        $this->viewData['categories'] = Category::orderBy('name', 'ASC')->get();
        $this->viewData['abilityCategories'] = $this->categoryService->getIdArrOfAbilityCategoriesOfUser($user);

        $this->viewData['permissions'] = Permission::all();
        $this->viewData['userPermissions'] = $user->permissions->pluck('id')->toArray();

        return view('admin.user.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin-role');
        //
        $inputs = $request->all();
        $inputs['permission'] = $inputs['permission'] ?? [];

        $user = User::find($id);
        //Re-update category that user have ability to do action
        $this->service->syncAbilityCategories($user, $inputs);
        $user->permissions()->sync($inputs['permission']);

        return redirect()->route('user.index')
            ->with('success','Cập nhật quyền User thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('admin-role');

        if($id == \Auth::id()) {
            exit;
        }
        //
        $user = User::find($id);
        $user->abilityCategories()->detach();
        $user->permissions()->detach();

        $user->delete();

        return redirect()->route('user.index')
            ->with('success','Xóa User thành công!');
    }
}
