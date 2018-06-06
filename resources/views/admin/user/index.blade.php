@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')

    {{--<div class="row">--}}
        {{--<div class="col-sm-2">--}}
            {{--<a href="{{ route('user.create') }}" class="btn btn-success btn-sm">Thêm user</a>--}}
            {{--<br><br>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách User
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th class="w-25"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">Sửa</a>

                                    <form class="d-inline" action="{{ route('user.destroy', $user->id) }}" method="post">
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
                        {{ $users->links() }}
                    </ul>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>

    <script>
        function ConfirmDelete()
        {
            var x = confirm("Bạn có chắc chắn muốn xóa User không?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection