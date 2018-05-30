@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-2">
            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm">Add category</a>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách Category
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm">Sửa</a>

                                    <form class="d-inline" action="{{ route('category.destroy', $category->id) }}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger" type="submit" onclick="return ConfirmDelete();">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination">
                        {{ $categories->links() }}
                    </ul>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("Bạn có chắc chắn muốn xóa Category không?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection