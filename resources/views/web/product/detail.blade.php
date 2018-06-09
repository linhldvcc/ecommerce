@extends('web/layout/index')
@section('content')
   <div class="row">
       <div class="col-md-4">
           gallery
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
@endsection()
@section('script')
    <script>
        $(document).ready(function(){
            $('#add-to-cart-btn').on("click", function(){
                $.ajax({
                    type:'POST',
                    url:'{{ route('card.add-item') }}',
                    data:{
                        _token: "{{ csrf_token() }}",
                        product_qty: $('#product-qty').val(),
                        product_id: $('#product-id').val(),
                    },
                    success:function(response) {
                        alert("okay");
                    }
                });
            });
        })
    </script>
@endsection
