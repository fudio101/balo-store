<?php
session_start();

$total = $number = 0;
$cart = $cartList = $category = null;
if (!empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $item) {
        $number++;
        $sql = "SELECT `id`, `catid`, `name`, `avatar`, `number`, `number_buy`, `price` FROM db_product WHERE id = {$item['id']} and status = 1";
        $result = executeResult($sql, true);
        $cartList[] = $result;
        $total += $result['price'] * $item['quantity'];
    }
}

$sql = "SELECT * FROM db_category WHERE status = 1";
$result = executeResult($sql, false);
if ($result != null) {
    foreach ($result as $item) {
        $category[] = $item;
    }
}

?>

<header class="hearder">
    <div class="hearder-top" id="hearder">
        <div class="grid wide">
            <div class="hearder-notifi">
                <ul class="hearder-top__list">
                    <li class="hearder-top__list-call">
                        <i class="hearder-top-icon fas fa-phone-alt"></i>
                        0999999999 - 0999999999
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
                    <a href="./index.php" class="hearder-seach__logo-link">
                        <img src="<?= $baseUrl ?>assets/images/logo.png" alt="" class="hearder-seach__logo-img">
                    </a>
                </div>
                <div class="hearder-seach__search">
                    <input type="text" class="hearder-seach__search-input hearder-seach__search-hover" id="searchBox" value="<?= isset($_GET['key']) ? $_GET['key'] : ''; ?>" placeholder="Tìm kiếm...">
                    <button class="header-seach__search-icon" id="submitSearchBox">
                        <i class="header-seach__search-icon-icon fas fa-search"></i>
                    </button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                <script>
                    $('#submitSearchBox').on('click', () => {
                        var keyword = $('#searchBox').val();
                        var linkToSearch = './search.php?key=' + keyword;
                        window.location.href = linkToSearch;
                    });
                    $("#searchBox").keyup(function(e) {
                        var code = e.key; // recommended to use e.key, it's normalized across devices and languages
                        if (code === "Enter") {
                            var keyword = $('#searchBox').val();
                            var linkToSearch = './search.php?key=' + keyword;
                            window.location.href = linkToSearch;
                        }
                    });
                </script>


                <div class="hearder-seach__login">
                    <ul class="hearder-seach__login-list">

                        <li class="hearder-seach__login-li hearder-seach__login-shoping">
                            <a href="<?= $baseUrl ?>cart.php" class="hearder-seach__login-link hide-on-mobile-tablet">
                                Giỏ Hàng / <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                            </a>
                            <div class="hearder-seach__login-link-cart">
                                <i class="hearder-seach__login-cart fas fa-shopping-cart"></i>
                                <span class="hearder-seach__login-pay hearder-seach__login-pay-cart"><?= $number ?></span>
                            </div>

                            <!-- hiện đã có sản phẩm -->
                            <div class="hearder-shoping hearder-cart">
                                <div class="hearder-shop">
                                    <ul class="hearder-shop__list">

                                        <?php if ($cartList != null) foreach ($cartList as $key => $product_) : ?>
                                            <li class="hearder-shop__li">
                                                <a href="<?= $baseUrl . 'product.php?id=' . $cart[$key]['id'] ?>" class="hearder-shop__notifi-link">
                                                    <img src="<?= fixUrl($product_['avatar'], $baseUrl) ?>" alt="" class="hearder-shop__img">
                                                </a>
                                                <div class="hearder-shop__notifi">
                                                    <p class="hearder-shop__notifi-item">
                                                        <a href="<?= $baseUrl . 'product.php?id=' . $cart[$key]['id'] ?>" class="hearder-shop__notifi-link">
                                                            <?= $product_['name'] ?>
                                                        </a>
                                                    </p>
                                                    <div class="hearder-shop__mini">
                                                        <span class="hearder-shop__mini-span"><?= $cart[$key]['quantity'] ?> x</span>
                                                        <span class="hearder-shop__mini-money"><?= number_format($product_['price'], 0, ',', '.') ?>₫</span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                    <div class="hearder-shop__sumoney">
                                        <span class="hearder-shop__sumoney-noti">Tổng số tiền:</span>
                                        <span class="hearder-shop__sumoney-money"><?= number_format($total, 0, ',', '.') ?>đ</span>
                                    </div>
                                    <div class="hearder-shop__box">
                                        <button class="hearder-shop__box-bottom">
                                            <a href="<?= $baseUrl ?>cart.php" class="hearder-shop__box-link">Xem giỏ
                                                hàng</a>
                                        </button>
                                        <button class="hearder-shop__box-bottom">
                                            <a href="<?= $baseUrl ?>pay.php" class="hearder-shop__box-pay">Thanh
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
                        <a href="./index.php" class="hearder-footer__href hearder-footer__black">
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

                                <?php foreach ($category as $key => $value) : ?>
                                    <a href="./category.php?id=<?= $value['id'] ?>" class="hearder-footer__sugget-link">
                                        <li class="hearder-footer__sugget-li"><?= $value['name'] ?></li>
                                    </a>
                                <?php endforeach; ?>

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

<div class="hearder-from hearder-modal js-hearder-modal">
    <div class="hearder-modal__over">
        <i class="hearder-modal__over-time fas fa-times js-icon__times"></i>
    </div>
    <ul class="hearder-footer__list hearder-footer__list-culumn hearder-modal-footer js-list__menu">
        <li class="hearder-footer__link hearder-footer__menu-seach">
            <img src="<?= $baseUrl ?>assets/images/logo.png" alt="">
        </li>
        <li class="hearder-footer__link hearder-footer__menu ">
            <a href="<?= $baseUrl ?>index.html" class="hearder-footer__href hearder-footer__black">
                Trang chủ
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu hearder-footer__link-href hearder-footer__link-focus">
            <span href="<?= $baseUrl ?>sanpham1.html" class="hearder-footer__href hearder-footer__menu-prodct">
                Sản phẩm
                <i class="hearder-footer__href-icon fas fa-angle-down"></i>
            </span>
            <ul class="hearder-footer__sugget-list hearder-footer__menu-cart hearder-footer__menu-cart-product">
                <a href="<?= $baseUrl ?>tuixach.html" class="hearder-footer__sugget-link">
                    <li class="hearder-footer__sugget-li">Túi Xách</li>
                </a>
                <a href="<?= $baseUrl ?>balo.html" class="hearder-footer__sugget-link">
                    <li class="hearder-footer__sugget-li">Balo</li>
                </a>
                <a href="<?= $baseUrl ?>vali.html" class="hearder-footer__sugget-link">
                    <li class="hearder-footer__sugget-li">Vali</li>
                </a>
            </ul>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Phụ kiện
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Tin tức
            </a>
        </li>
        <li class="hearder-footer__link hearder-footer__menu">
            <a href="" class="hearder-footer__href">
                Liên hệ
            </a>
        </li>
    </ul>
</div>