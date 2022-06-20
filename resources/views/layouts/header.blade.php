<?php
/**
 * @author Fudio101
 * Date: 04/05/2022
 * Time: 14:05
 */
?>

<header class="hearder">
    <div class="hearder-top" id="hearder">
        <div class="grid wide">
            <div class="hearder-notifi">
                <ul class="hearder-top__list">
                    <li class="hearder-top__list-call">
                        <i class="hearder-top-icon fas fa-phone-alt"></i>
                        0337202484
                    </li>
                </ul>
                <ul class="hearder-top__list hide-on-mobile-tablet">
                    <li class="hearder-top__list-li">
                        <a href="" class="hearder-top__list-link">
                            <i class="hearder-top-icon fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="hearder-top__list-li">
                        <a href="" class="hearder-top__list-link">
                            <i class="hearder-top-icon fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="hearder-top__list-li">
                        <a href="" class="hearder-top__list-link">
                            <i class="hearder-top-icon fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="hearder-top__list-li">
                        <a href="" class="hearder-top__list-link">
                            <i class="hearder-top-icon fas fa-envelope"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="hearder-navbar">
        <div class="grid wide">
            <div class="hearder-seach">
                <div class="hearder-seach__icon js-menu__icon">
                    <i class="hearder-seach__icon-bar fas fa-bars"></i>
                </div>
                <div class="hearder-seach__logo">
                    <a href="{{route('homepage')}}" class="hearder-seach__logo-link">
                        <img src="{{asset('assets/images/logo.png')}}" alt="" class="hearder-seach__logo-img">
                    </a>
                </div>
                <div class="hearder-seach__search">
                    <input type="text" class="hearder-seach__search-input hearder-seach__search-hover"
                           id="searchBox"
                           value="{{session('keySearch','')}}" placeholder="Tìm kiếm...">
                    <button class="header-seach__search-icon" id="submitSearchBox">
                        <i class="header-seach__search-icon-icon fas fa-search"></i>
                    </button>
                </div>
                <script>
                    $('#submitSearchBox').on('click', () => {
                        const keyword = $('#searchBox').val();
                        window.location.href = './search.php?key=' + keyword;
                    });
                    $("#searchBox").keyup(function (e) {
                        const code = e.key; // recommended to use e.key, it's normalized across devices and languages
                        if (code === "Enter") {
                            const keyword = $('#searchBox').val();
                            window.location.href = './search.php?key=' + keyword;
                        }
                    });
                </script>


                <div class="hearder-seach__login">
                    <ul class="hearder-seach__login-list">

                        <li class="hearder-seach__login-li hearder-seach__login-shoping">
                            <a href="cart.php"
                               class="hearder-seach__login-link hide-on-mobile-tablet">
                                Giỏ Hàng / <span>{{number_format($total, 0, ',', '.')}}đ</span>
                            </a>
                            <div class="hearder-seach__login-link-cart">
                                <i class="hearder-seach__login-cart fas fa-shopping-cart"></i>
                                <span
                                    class="hearder-seach__login-pay hearder-seach__login-pay-cart">{{$counter}}</span>
                            </div>

                            <!-- hiện đã có sản phẩm -->
                            <div class="hearder-shoping hearder-cart">
                                <div class="hearder-shop">
                                    <ul class="hearder-shop__list">

                                        @if ($cart != null)
                                            @foreach ($cart as $key => $cartProduct)
                                                <li class="hearder-shop__li">
                                                    <a href="{{'?= $baseUrl.product.php?id=.$cart[$key][id] ?'}}"
                                                       class="hearder-shop__notifi-link">
                                                        <img src="{{'?= fixUrl($product_[avatar], $baseUrl) ?'}}" alt=""
                                                             class="hearder-shop__img">
                                                    </a>
                                                    <div class="hearder-shop__notifi">
                                                        <p class="hearder-shop__notifi-item">
                                                            <a href="{{'?= $baseUrl.product.php?id=.$cart[$key][id] ?'}}"
                                                               class="hearder-shop__notifi-link">
                                                                {{'?= $product_[name] ?'}}
                                                            </a>
                                                        </p>
                                                        <div class="hearder-shop__mini">
                                                        <span
                                                            class="hearder-shop__mini-span">{{'?= $cart[$key][quantity] ?'}} x</span>
                                                            <span
                                                                class="hearder-shop__mini-money">{{'?= number_format($product_[price], 0, ',', '.') ?'}}₫</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class="hearder-shop__sumoney">
                                        <span class="hearder-shop__sumoney-noti">Tổng số tiền:</span>
                                        <span class="hearder-shop__sumoney-money">
                                            {{ number_format($total, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                    <div class="hearder-shop__box">
                                        <button class="hearder-shop__box-bottom">
                                            <a href="{{'?= $baseUrl ?'}}cart.php" class="hearder-shop__box-link">Xem giỏ
                                                hàng</a>
                                        </button>
                                        <button class="hearder-shop__box-bottom">
                                            <a href="{{'?= $baseUrl ?'}}pay.php" class="hearder-shop__box-pay">Thanh
                                                toán</a>
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="hearder-footer hide-on-mobile-tablet">
        <div class="grid wide">
            <div class="hearder-from">
                <ul class="hearder-footer__list">
                    <li class="hearder-footer__link ">
                        <a href="{{route('homepage')}}" class="hearder-footer__href hearder-footer__black">
                            Trang chủ
                        </a>
                    </li>
                    <li class="hearder-footer__link hearder-footer__link-href">
                        <span style="cursor: default;" class="hearder-footer__href">
                            Sản phẩm
                            <i class="hearder-footer__href-icon fas fa-angle-down"></i>
                        </span>
                        <div class="hearder-footer__sugget">
                            <ul class="hearder-footer__sugget-list">

                                @foreach ($categories as $key => $item)
                                    <a href="{{route('category',[$item->id])}}"
                                       class="hearder-footer__sugget-link">
                                        <li class="hearder-footer__sugget-li">{{$item->name}}</li>
                                    </a>
                                @endforeach

                            </ul>
                        </div>
                    </li>
                    <li class="hearder-footer__link">
                        <a href="" class="hearder-footer__href">
                            Phụ kiện
                        </a>
                    </li>
                    <li class="hearder-footer__link">
                        <a href="" class="hearder-footer__href">
                            Tin tức
                        </a>
                    </li>
                    <li class="hearder-footer__link">
                        <a href="" class="hearder-footer__href">
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

