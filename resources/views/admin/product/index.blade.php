@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-2">
            <a href="{{ route('product.create') }}" class="btn btn-success btn-sm">Add product</a>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách Product
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Giá</th>
                            <th>Giá cũ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->old_price }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success btn-sm">Sửa</a>

                                    <form class="d-inline" action="{{ route('product.destroy', $product->id) }}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return ConfirmDelete();">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination">
                        {{ $products->links() }}
                    </ul>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("Bạn có chắc chắn muốn xóa Product không?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection