<div class="row">
    @foreach($products as $product)
        <div class="col-sm-4">
            <img src="{{ $product->thumbnailURL }}" class="img-fluid">
            <a href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a>
            <p>@money($product->price) <span class="old-price">@money($product->old_price)</span></p>
        </div>
    @endforeach
</div>
{{ $products->links() }}