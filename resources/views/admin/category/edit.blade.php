@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Sửa Category
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên Category..." value="{{ $category->name }}">
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection