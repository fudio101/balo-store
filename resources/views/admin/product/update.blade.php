@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form action="{{route('productUpdate',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-9">
                                <div class="form-group">
                                    <label class="mb-2" for="usr">Product Name:</label>
                                    <input type="text" class="form-control" id="usr" name="name"
                                           value="{{(old('name')) ?: $product->name}}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="description">Content:</label>
                                    <!-- <textarea class="form-control mt-2" rows="5" name="description" id="description"></textarea> -->
                                    <textarea class="form-control summernote mt-2" name="detail"
                                              id="description">{{old('detail')?: $product->detail}}</textarea>
                                </div>

                                <button class="btn btn-success mt-3">Save</button>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="mb-2" for="thumbnail">Thumbnail:</label>
                                    <input type="file" class="form-control" id="thumbnail" name="avatar"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                </div>
                                <img class="mt-2" src="{{$product->avatarUrl}}" id="category-img-tag" width="100%"
                                     alt=""/>

                                <div class="form-group mt-3">
                                    <label class="mb-2" for="imgs">Images:</label>
                                    <input type="file" class="form-control" id="imgs" name="images[]"
                                           accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" multiple>
                                </div>
                                <div class="row" id="images-preview"></div>

                                <div class="form-group mt-3">
                                    <label for="category_id">Product Category:</label>
                                    <select class="form-control mt-2" name="category_id" id="category_id">
                                        <option value="">-- Select --</option>
                                        @foreach($categories as $item)
                                            <option
                                                value="{{$item->id}}" {{$item->id==(old('category_id')?: $product->category_id)?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="producer_id">Producer:</label>
                                    <select class="form-control mt-2" name="producer_id" id="producer_id">
                                        <option value="">-- Select --</option>
                                        @foreach($producers as $item)
                                            <option
                                                value="{{$item->id}}" {{$item->id==(old('producer_id')?: $product->producer_id)?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="mb-2" for="price">Price:</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                           value="{{old('price')?: $product->price}}">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('textarea.summernote').summernote({
            placeholder: 'We need something here',
            tabsize: 2,
            height: 512,
            color: [
                ['Orginal', 'red', 'green', 'blue'],
                ['#155593', '#c4b540', '#1dd381', '#ba1cd2']
            ],
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                [
                    'color',
                    ['color']
                ],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        function readURL(input) {
            if (input.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#category-img-tag').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.target.files[0]);
            }
        }

        $("#thumbnail").change(function (event) {
            readURL(event);
        });

        $("#imgs").change(function (event) {
            var imgsPv = $('#images-preview')
            imgsPv.empty()
            Array.from(event.target.files).forEach((element) => {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imgsPv.append(`<img class="col-6" src="${e.target.result}" alt="">`);
                }

                reader.readAsDataURL(element);
            })
        });
    </script>
@endsection
