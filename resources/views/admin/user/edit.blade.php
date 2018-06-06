@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Phân quyền cho User
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Category</label>
                            <div class="col-md-9">
                                @foreach($categories as $category)
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('category_id[]', $category->id, in_array($category->id, $abilityCategories)) }} {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Thêm - Sửa - Xóa</label>
                            <div class="col-md-9">
                                @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions)) }} {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>



    </div>
@endsection
@section('scripts')
@endsection