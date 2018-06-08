@extends('web/layout/index')
@section('content')
    <div class="row">
        <div class="col-sm-4">

            <div class="card">
                <div class="card-header">
                    Category
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('product.getByCategory', $category->id) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-8" id="product-lists">
            @include('web.common.product_lists')
        </div>
    </div>
@endsection()
