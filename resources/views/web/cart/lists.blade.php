@extends('web.layout.index')
@section('content')
    <div class="row">
        @if(count($products))
            <div class="col-sm-8">
                @foreach($products as $product)
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ $product->thumbnailURL }}" class="img-fluid">
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a>
                            <p>@money($product->price)</p>
                        </div>
                        <div class="col-sm-3">
                            <input class="product-qty" product-id="{{ $product->id }}" type="number" min="1" step="1" value="{{ $product->qty }}">
                        </div>
                        <div class="col-sm-1 pull-right">
                            <button class="cart-delete-item-btn btn btn-danger" product-id="{{ $product->id }}">Xóa</button>
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
            <div class="col-sm-12">
                <h5>Không có sản phẩm nào trong giỏ hàng của bạn</h5>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.product-qty').blur(function(){
                var product_qty = $(this).val();

                if(product_qty) {
                    $.ajax({
                        type:'POST',
                        url:'{{ route('cart.update-item') }}',
                        data:{
                            _token: "{{ csrf_token() }}",
                            product_id: $(this).attr('product-id'),
                            product_qty: product_qty,
                        },
                        success:function(response) {
                            location.reload();
                        },
                        error: function() {
                            alert("Có lỗi xảy ra, vui lòng thử lại.")
                        },
                    });
                }

            })

            $('.cart-delete-item-btn').on("click", function(){
                $.ajax({
                    type:'POST',
                    url:'{{ route('cart.delete-item') }}',
                    data:{
                        _token: "{{ csrf_token() }}",
                        product_id: $(this).attr('product-id'),
                    },
                    success:function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra, vui lòng thử lại.")
                    },
                });
            });
        })
    </script>
@endsection