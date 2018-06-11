@extends('web/layout/index')

@section('css')
    <link href="{{ url('/lib/xzoom/style.css') }}" rel="stylesheet">
@endsection

@section('content')
   <div class="row">
       <div class="col-md-4">
           <img src="{{ $product->thumbnailURL }}" class="img-fluid">
       </div>
       <div class="col-md-8" id="product-lists">
           <h2>{{ $product->title }}</h2>
           <p>@money($product->price)</p>
            <p class="old-price">@money($product->old_price)</p>
           <div>
               {!! $product->desc !!}
           </div>
           <div class="divider"></div>
               <input type="hidden" id="product-id" value="{{ $product->id }}">
               <div class="form-group">
                   <p>nhập số lượng cần mua</p>
                   <input id="product-qty" type="number" step="1" min="1" required>
               </div>

               <button class="btn btn-success" id="add-to-cart-btn">Thêm vào giỏ hàng</button>
       </div>
   </div>
@endsection

@section('script')
    <script src="{{ url('lib/xzoom/dist/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#add-to-cart-btn').on("click", function(){
                var productQty = $('#product-qty').val();

                if(Number(productQty) < 1 || parseInt(productQty) % 1 !== 0) {
                    alert("Vui lòng nhập số lượng!");
                    return;
                }

                $.ajax({
                    type:'POST',
                    url:'{{ route('cart.add-item') }}',
                    data:{
                        _token: "{{ csrf_token() }}",
                        product_qty: productQty,
                        product_id: $('#product-id').val(),
                    },
                    success:function(response) {
                        if(response.success) {
                            alert("Đã thêm vào giỏ hàng");
                            $('#cart-badge').html(response.cartCount);
                        } else {
                            alert("Có lỗi xảy ra, vui lòng thử lại");
                        }
                    },
                    error: function(){
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    },
                });
            });
        })
    </script>
@endsection