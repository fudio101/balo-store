@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="grid wide">
            <div class="container-wrapper">
                <div class="container-wrapper__page">
                    <h1 class="container-wrapper__page-h1">Sản phẩm</h1>
                    <nav class="container-wrapper__page-nav">
                        <a href="index.blade.php" class="container-wrapper__page-link">Trang chủ</a>
                        <span class="container-wrapper__page-span">/</span>
                        <span class="container-wrapper__page-span">Sản phẩm</span>
                        <span class="container-wrapper__page-span">/</span>
                        <span class="container-wrapper__page-span">{{$category->name}}</span>
                    </nav>
                </div>
                <div class="container-wrapper__category">
                    <p class="container-wrapper__category-p container-wrapper__category-none">Có tất cả
                        <span class="container-wrapper__category-span">{{$totalProduct}}</span>
                        kết quả
                    </p>
                    <div class="container-select" id="sort">
                        <select name="" id="" class="container-select__list">
                            <option value="0" class="container-select__option" {{$sort === 0?'selected':''}}>
                                Thứ tự mặc định
                            </option>
                            <option value="1" class="container-select__option" {{$sort === 1?'selected':''}}>
                                Thứ tự theo giá: từ thấp lên cao
                            </option>
                            <option value="2" class="container-select__option" {{$sort === 2?'selected':''}}>
                                Thứ tự theo giá: từ cao xuống thấp
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="container-small">
                <div class="row sm-gutter">
                    @foreach ($products as $product)
                        <div class="col l-3 m-6 c-12">
                            <a href="{{route('product',$product->id)}}" class="container-small__form">
                                <img src="{{$product->avatarUrl}}" alt=""
                                     class="container-small__form-img">
                                <div class="container-small__noti">
                                    <p class="container-small__noti-p">{{$product->name}}</p>
                                    <div class="container-small__noti-div">
                                        <p class="container-small__noti-p1">{{number_format($product->price, 0,',','.')}}
                                            ₫</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="container-page">
                    <ul class="container-page__form">
                        <li class="container-page__list">
                            <a href="{{route('category',[$category->id,'sort'=>$sort,'page'=>$currentPage > 5 ? ($currentPage - 5) : 1])}}"
                               class="container-page__link">
                                <i class="container-page__icon fas fa-angle-double-left"></i>
                            </a>
                        </li>
                        @for ($index = $pageStart; $index <= $pageEnd; $index++)
                            <li class="container-page__list {{$index == $currentPage ? 'open-color' : ''}}">
                                <a href="{{route('category',[$category->id,'sort'=>$sort,'page'=>$index])}}"
                                   class="container-page__link">{{$index}}</a>
                            </li>
                        @endfor
                        <li class="container-page__list">
                            <a href="{{route('category',[$category->id,'sort'=>$sort,'page'=>$currentPage < ($maxPage - 5) ? ($currentPage + 5) : $maxPage])}}"
                               class="container-page__link">
                                <i class="container-page__icon fas fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#sort').change(function () {
                var sort = $('#sort option:selected').val();
                window.location.href = "{{route('category',[$category->id,'sort'=>$sort,'page'=>$currentPage])}}".replace('sortKey', sort);
            });
        });
    </script>
@endsection
