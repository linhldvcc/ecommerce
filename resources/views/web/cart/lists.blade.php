@extends('web.layout.index')
@section('content')
    <div class="row">
        @if(count($products))
            <div class="col-sm-8">
                @foreach($products as $product)
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="{{ $product->thumbnailURL }}" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            {{ $product->title }}
                            <p>@money($product->price)</p>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" min="1" step="1" value="{{ $product->qty }}">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-danger" product-id="{{ $product->id }}">Xóa</button>
                        </div>
                    </div>
                    <hr />
                @endforeach
            </div>
            <div class="col-sm-4">
                <p>Thành tiền: @money($totalPrice)</p>
                <a href="{{ route('cart.get-order') }}" class="btn btn-success">Đặt hàng</a>
            </div>
        @else
            Không có sản phẩm nào trong giỏ hàng của bạn
        @endif
    </div>
@endsection