<!-- làm slide -->
{{--        <div class="container-slideshow">--}}
{{--            <div class="container-slide">--}}
{{--                <input type="radio" name="bottom" id="bottom_1">--}}
{{--                <input type="radio" name="bottom" id="bottom_2">--}}
{{--                <div class="container-slide__list container-slide__id">--}}
{{--                    <div class="container-slide__list-img">--}}
{{--                        <img src="./assets/images/slider_1.jpg" alt="" class="container-slide__list-img-slide">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="container-slide__list">--}}
{{--                    <div class="container-slide__list-img">--}}
{{--                        <img src="./assets/images/slider_1.jpg" alt="" class="container-slide__list-img-slide">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="container-navigation">--}}
{{--                <label for="bottom_1" class="container-navigation__bar"></label>--}}
{{--                <label for="bottom_2" class="container-navigation__bar"></label>--}}
{{--            </div>--}}
{{--        </div>--}}
@extends('layouts.main')

@section('content')
    <div class="container-menu">
        <div class="grid wide">
            <div class="container-sale">
                <span class="container-sale__notifi">Sản phẩm mới</span>
                <img src="{{asset('assets/images/flash_sale.jpg')}}" alt="" class="container-sale__img">
            </div>
            <div class="row sm-gutter">

                @foreach ($products as $product)
                    <div class="col l-2-4 m-4 c-6 container-shoping__culum">
                        <a href="{{route('product',$product->id)}}" class="container-home__fb">
                            <div class="container-shoping">
                                <div class="container-shoping__img">
                                    <img src="{{$product->avatarUrl}}" alt=""
                                         class="container-shoping__img-image">
                                </div>
                                <div class="container-shoping__content">
                                            <span class="container-shoping__content-span">
                                                {{$product->name}}
                                            </span>
                                </div>
                                <div class="container-shoping__money">
                                            <span class="container-shoping__money-line">
                                                {{number_format($product->price, 0, ',', '.')}}₫
                                            </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="container-page">
                <ul class="container-page__form">
                    <li class="container-page__list">
                        <a href="{{route('homepage',['page'=>$currentPage > 5 ? ($currentPage - 5) : 1])}}"
                           class="container-page__link">
                            <i class="container-page__icon fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    @for ($index = $pageStart; $index <= $pageEnd; $index++)
                        <li class="container-page__list {{$index == $currentPage ? 'open-color' : ''}}">
                            <a href="{{route('homepage',['page'=>$index])}}"
                               class="container-page__link">{{$index}}</a>
                        </li>
                    @endfor
                    <li class="container-page__list">
                        <a href="{{route('homepage',['page'=>$currentPage < ($maxPage - 5) ? ($currentPage + 5) : $maxPage])}}"
                           class="container-page__link">
                            <i class="container-page__icon fas fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row sm-gutter">
                <div class="col l-4 m-4 c-0 container-shoping__culum">
                    <div class="container-banner">
                        <img src="{{asset('assets/images/bannar1.jpg')}}" alt="" class="container-banner__img">
                    </div>
                </div>
                <div class="col l-4 m-4 c-12 container-shoping__culum">
                    <div class="container-banner__imger">
                        <img src="{{asset('assets/images/banner2.jpg')}}" alt="" class="container-banner__img-culumn">
                        <img src="{{asset('assets/images/banner3.jpg')}}" alt="" class="container-banner__img-culumn">
                    </div>
                </div>
                <div class="col l-4 m-4 c-0 container-shoping__culum">
                    <div class="container-banner">
                        <img src="{{asset('assets/images/banner4.jpg')}}" alt="" class="container-banner__img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-voter">
        <div class="grid wide">
            <div class="container-section">

                @foreach($categories as $key=>$category)
                    <div class="container-sale__shop">
                        <span class="container-sale__span">{{$category->name}}</span>
                    </div>
                    <div class="row sm-gutter">

                        @foreach ($catProducts[$key] as $item)
                            <div class="col l-2-4 m-4 c-6 container-shoping__culum">
                                <a href="{{route('product',$item->id)}}" class="container-home__fb">
                                    <div class="container-vali">
                                        <div class="container-vali__img">
                                            <img src="{{$item->avatarUrl}}" alt=""
                                                 class="container-vali__img-image">
                                        </div>
                                        <div class="container-vali__content">
                                            <span class="container-vali__content-span">
                                                {{$item->name}}
                                            </span>
                                        </div>
                                        <div class="container-vali__money">
                                            <span class="container-vali__money-line">
                                                {{number_format($item->price, 0, ',', '.')}}₫
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="container-sale__shop-add">
                        <a href="category.php?id={{$category->id}}" class="btn container-sale__shop-add-link">Xem
                            thêm</a>
                    </div>
                @endforeach

                <div class="row sm-gutter">
                    <div class="col l-6 m-6 c-12">
                        <img src="{{asset('assets/images/anh3.jpg')}}" alt=""
                             class="container-section__img container-section__img-padding">
                    </div>
                    <div class="col l-6 m-6 c-12">
                        <img src="{{asset('assets/images/anh4.jpg')}}" alt=""
                             class="container-section__img container-section__img-padding">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- javasprit -->
    <script>
        let counter = 1;
        setInterval(function () {
            document.getElementById('bottom_' + counter).checked = true;
            counter++;
            if (counter > 2) {
                counter = 1;
            }
        }, 4000);
    </script>
@endsection
