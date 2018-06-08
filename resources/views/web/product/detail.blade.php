@extends('web/layout/index')
@section('content')
   <div class="row">
       <div class="col-md-4">
           gallery
       </div>
       <div class="col-md-8">
           <h2>{{ $product->title }}</h2>
           <p>@money($product->price)</p>
            <p class="old-price">@money($product->old_price)</p>
           <div>
               {!! $product->desc !!}
           </div>
           <div class="divider"></div>
           <form>
               @csrf
               <input type="hidden" name="product" value="{{ $product->id }}">
               <div class="form-group">
                   <p>nhập số lượng cần mua</p>
                   <input type="number" step="1" min="1" required>
               </div>

               <button class="btn btn-success">Thêm vào giỏ hàng</button>
           </form>

       </div>
   </div>
@endsection()
