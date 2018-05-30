@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Sửa Product
                </div>
                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề Product..." value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="desc" rows="9" class="form-control" placeholder="Mô tả sản phẩm...">{{ $product->desc }}</textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Giá hiện tại</label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="Giá hiện tại" value="{{ $product->price }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Giá cũ</label>
                                <input type="text" step="0.01" name="old_price" class="form-control" placeholder="Giá cũ" value="{{ $product->old_price }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Category</label>
                            <div class="col-md-9">
                                @foreach($categories as $category)
                                    <div class="checkbox">
                                        <label for="checkbox1">
                                            {{ Form::checkbox('category_id[]', $category->id, in_array($category->id, $productCategories)) }} {{ $category->name }}
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
        <!--/.col-->
    </div>
@endsection