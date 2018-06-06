@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Thêm Product
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề Product..." required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="desc" rows="9" class="form-control" placeholder="Mô tả sản phẩm.." id="desc-ckeditor" required></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Giá hiện tại</label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="Giá hiện tại" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Giá cũ</label>
                                <input type="number" step="0.01" name="old_price" class="form-control" placeholder="Giá cũ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Category</label>
                            <div class="col-md-9">
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category_id[]" value="{{ $category->id }}"> {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    Không có Category
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="images[]" multiple accept="image/*"/>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('scripts')
    <script src="{{ url('lib/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('desc-ckeditor');
    </script>

@endsection