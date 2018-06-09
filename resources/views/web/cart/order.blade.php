@extends('web.layout.index')
@section('content')
    <div class="col-sm-8">
        @if(count($products))
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="w-25"></th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)
                    <tr>
                        <th scope="row">
                            <img src="{{ $product->thumbnailURL }}" class="img-fluid">
                        </th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>@money($product->totalPrice)</td>
                    </tr>
                @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <th>thành tiền:</th>
                        <th>@money($totalPrice)</th>
                    </tr>
                </tbody>
            </table>

            <h4>THÔNG TIN GIAO HÀNG:</h4>
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input class="form-control" type="text" name="client_name">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" type="text" name="client_tel">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control" type="text" name="client_address">
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input class="form-control" type="text" name="client_note">
                </div>
            </form>

            <div class="row">
                <div class="col-sm-3 float-right">
                    <a href="{{ route('cart.get-order') }}" class="btn btn-success">Đặt hàng</a>

                </div>
            </div>

        @else
            Không có sản phẩm nào trong giỏ hàng của bạn
        @endif
    </div>

@endsection