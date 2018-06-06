@extends('admin.layout')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <link href="{{ url('lib/dropzone/min/dropzone.min.css') }}" rel="stylesheet">
    <style>
        .dropzone .dz-preview .dz-image img {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Sửa Product
                </div>
                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề Product..." value="{{ $product->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="desc" id="desc-ckeditor" rows="9" class="form-control" placeholder="Mô tả sản phẩm..." required>{{ $product->desc }}</textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Giá hiện tại</label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="Giá hiện tại" value="{{ $product->price }}" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Giá cũ</label>
                                <input type="text" step="0.01" name="old_price" class="form-control" placeholder="Giá cũ" value="{{ $product->old_price }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Category</label>
                            <div class="col-md-9">
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                {{ Form::checkbox('category_id[]', $category->id, in_array($category->id, $productCategories)) }} {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    Không có Category
                                @endif

                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Gallery
                </div>
                <div class="card-body">
                    <form action="{{ route('product_image.upload', $product->id) }}" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone">
                        @csrf
                        <div class="dz-message">
                            <div class="col-xs-8">
                                <div class="message">
                                    <p>Bấm vào đây hoặc kéo thả ảnh vào để Upload</p>
                                </div>
                            </div>
                        </div>
                        <div class="fallback">
                            <input type="file" name="file" multiple>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--Dropzone Preview Template--}}
        <div id="preview" style="display: none;">

            <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail /></div>

                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size></span></div>
                    <div class="dz-filename"><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>



                <div class="dz-success-mark">

                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                        <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                        <title>Check</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                        </g>
                    </svg>

                </div>
                <div class="dz-error-mark">

                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                        <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                        <title>error</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                            <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        {{--End of Dropzone Preview Template--}}


    </div>
@endsection
@section('scripts')
    <!--CKEDITOR PLUGIN-->
    <script src="{{ url('lib/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('desc-ckeditor');
    </script>
    <!--END CKEDITOR PLUGIN-->

    <!--DROPZONE PLUGIN-->
    <script src="{{ url('lib/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        var total_photos_counter = 0;
        Dropzone.options.dropzone = {
            acceptedFiles: "image/jpeg,image/png,image/gif",
            parallelUploads: 100,
            maxFilesize: 16,
            previewTemplate: document.querySelector('#preview').innerHTML,
            addRemoveLinks : true,
            dictRemoveFile: 'Remove file',
            dictFileTooBig: 'Image is larger than 16MB',
            timeout: 10000,
            dictInvalidFileType: "upload only JPG/PNG",
            previewContainer: '#preview',

            init: function () {
                var thisDropzone = this;

                $.getJSON('{{ route('product_image.get_all', $product->id) }}', function(data) { // get the json response

                    $.each(data.images, function(key,value){ //loop through it
                        var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response

                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "/"+value.path);//uploadsfolder is the folder where you have all those uploaded files
                        thisDropzone.emit("thumbnail", mockFile, "/"+value.path);
                        thisDropzone.emit("complete", mockFile);

                        mockFile.previewElement.id = value.id;
                    });
                });

                this.on("removedfile", function (file) {

                    console.log(file);

                    $.post({
                        url: "{{ route('product_image.delete', $product->id) }}",
                        data: {id: file.previewElement.id, _token: "{{ csrf_token() }}"},
                        dataType: 'json',
                        success: function (data) {
                            total_photos_counter--;
                            $("#counter").text("# " + total_photos_counter);
                        }
                    });
                });
            },
            success: function (file, response) {

                console.log(response);
                file.previewElement.id = response.serverId;

                total_photos_counter++;
                $("#counter").text("# " + total_photos_counter);
            }
        };
    </script>
    <!--END DROPZONE PLUGIN-->
@endsection