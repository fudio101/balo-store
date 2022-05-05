<?php
require_once("./database/dbhelper.php");
require_once("./utils/utility.php");

$product = $products = $products2 = $imgs = null;
$categoryName = '';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_product WHERE id = $id and status =1";
    $product = executeResult($sql, true);

    if ($product == null) {
        header("Location: index.blade.php");
    }
    $imgs = getImages($product['img'], 8);

    $sql = "SELECT * FROM db_category WHERE status = 1 and id = " . $product['catid'];
    $category = executeResult($sql, true);
    $categoryName = $category['name'];

    //select 5 products of first db_product with greatest number_buy and status = 1
    $sql = "SELECT * FROM db_product WHERE status = 1 ORDER BY number_buy DESC LIMIT 5";
    $products = executeResult($sql, false);

    //select random 4 products in db_product and status = 1
    $sql = "SELECT * FROM db_product WHERE status = 1 AND catid = {$product['catid']} ORDER BY RAND() LIMIT 4";
    $products2 = executeResult($sql, false);
} else {
    header('location: index.blade.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('./layouts/head.php'); ?>

<body>
    <div class="apps">
        <?php require_once($baseUrl . "layouts/top.php"); ?>

        <div class="container">
            <div class="container-folder">
                <div class="grid wide">
                    <div class="container-folder__header">
                        <a href="index.blade.php" class="container-folder__header-href">Trang chủ</a>
                        <span class="container-folder__header-span">/</span>
                        <a href="./category.php?catid=<?= $product['catid'] ?>" class="container-folder__header-link">Sản phẩm</a>
                        <span class="container-folder__header-span">/</span>
                        <a href="./category.php?catid=<?= $product['catid'] ?>" class="container-folder__header-link"><?= $categoryName ?></a>
                    </div>
                </div>
            </div>
            <div class="container-product">
                <div class="grid wide">
                    <div class="row sm-gutter">
                        <!-- làm slide sản phẩm -->
                        <div class="col l-9 m-12 c-12">
                            <div class="container-product__padding">
                                <div class="row sm-gutter">
                                    <div class="col l-5 m-12 c-12">
                                        <div class="container-cart">

                                            <?php foreach ($imgs as $img) : ?>
                                                <div class="container-cart__myslide js-myslide">
                                                    <img src="<?= $img ?>" alt="" class="container-cart__img">
                                                </div>
                                            <?php endforeach; ?>

                                            <!-- Next and previous buttons -->
                                            <a class="container-cart__prev container-cart__none" onclick="plusSlides(-1)">❮</a>
                                            <a class="container-cart__next container-cart__none" onclick="plusSlides(1)">❯</a>

                                            <div class="container-list">
                                                <div class="row sm-gutter">

                                                    <?php
                                                    $i = 0;
                                                    foreach ($imgs as $img) :
                                                    ?>

                                                        <div class="col l-3 m-3 c-3">
                                                            <div class="container-list__hiden js-hiden" onclick="currentSlide(<?= ++$i ?>)">
                                                                <img class="container-list__demo container-list__cursor js-demo" src="<?= $img ?>" alt="">
                                                            </div>
                                                        </div>

                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- làm phần nội dung và số lượng sản phẩm -->
                                    <div class="col l-7 m-12 c-12">
                                        <div class="container-info">
                                            <h1 class="container-info__head">
                                                <?= $product['name'] ?>
                                            </h1>
                                            <div class="container-info__price">
                                                <span class="container-info__price-new"><?= number_format($product['price'], 0, ',', '.') . '₫' ?></span>
                                            </div>
                                            <p class="container-info__p"><?= $product['number'] > $product['number_buy'] ? '' : 'Hết hàng' ?></p>
                                            <form action="" class="container-form">
                                                <div class="container-form__add">
                                                    <div class="container-form__add-number">
                                                        <input type="button" class="container-form__add-sub" value="-">
                                                        <input type="number" class="container-form__add-cart fix-number" id="numProducts" min="1" max="1000" value="1">
                                                        <input type="button" class="container-form__add-sub1" value="+">
                                                    </div>
                                                    <button class="btn btn--green container-form__add-button" id="addToCart" <?= $product['number'] > $product['number_buy'] ? '' : 'disabled' ?>>Thêm vào giỏ hàng</button>
                                                </div>
                                                <button class="btn btn--blue container-form_pay" onclick="buyNow()" <?= $product['number'] > $product['number_buy'] ? '' : 'disabled' ?>>Mua ngay</button>
                                            </form>
                                            <p class="container-info__noti">
                                                Mọi sản phẩm của chúng tôi đều được chăm chút tỉ mỉ đến từng chi tiết – Đặt mua ngay trước khi hết hàng nhé bạn!
                                            </p>
                                            <p class="container-info__category">Danh mục:
                                                <a href="./category.php?catid=<?= $product['catid'] ?>" class="container-info__category-link">
                                                    <?= $categoryName ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-painted">
                                <p class="container-painted__p">Mô Tả</p>
                                <div class="container-painted__noti">
                                    <?= $product['detail'] ?>
                                </div>
                            </div>
                            <div class="container-sp">
                                <h1 class="container-sp__head">Sản phẩm tương tự</h1>
                                <div class="container-sp__ps">
                                    <div class="row sm-gutter">

                                        <?php foreach ($products2 as $key => $product_) : ?>

                                            <div class="col l-3 m-4 c-6">
                                                <a href="./product.php?id=<?= $product_['id'] ?>" class="container-sp__cart">
                                                    <img src="<?= fixUrl($product_['avatar'], './') ?>" alt="" class="container-sp__cart-img">
                                                    <div class="container-sp__noti">
                                                        <p class="container-sp__noti-p"><?= $product_['name'] ?></p>
                                                        <div class="container-sp__noti-div">
                                                            <p class="container-sp__noti-p1"><?= number_format($product_['price'], 0, ',', '.') ?>₫</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col l-3 m-0 c-0">
                            <div class="container-last">
                                <div class="container-last__list">
                                    <img src="./assets/images/policy_images_1.png" alt="" class="container-last__list-img">
                                    <div class="container-last__list-div">
                                        <span class="container-last__list-span">Miễn phí vận chuyển</span>
                                        <span class="container-last__list-span">Cho các đơn hàng > 5tr</span>
                                    </div>
                                </div>
                                <div class="container-last__list">
                                    <img src="./assets/images/policy_images_4.png" alt="" class="container-last__list-img">
                                    <div class="container-last__list-div">
                                        <span class="container-last__list-span">Thanh toán</span>
                                        <span class="container-last__list-span">Được bảo mật 100%</span>
                                    </div>
                                </div>
                                <div class="container-last__list">
                                    <img src="./assets/images/policy_images_2.png" alt="" class="container-last__list-img">
                                    <div class="container-last__list-div">
                                        <span class="container-last__list-span">Hỗ trợ 24/7.</span>
                                        <span class="container-last__list-span">Liên hệ hỗ trợ 24h/ngày</span>
                                    </div>
                                </div>
                                <div class="container-last__list">
                                    <img src="./assets/images/policy_images_3.png" alt="" class="container-last__list-img">
                                    <div class="container-last__list-div">
                                        <span class="container-last__list-span">Hoàn tiền 100%</span>
                                        <span class="container-last__list-span">Nếu sản phẩm bị lỗi, hư hỏng</span>
                                    </div>
                                </div>
                            </div>
                            <div class="container-sidebar">
                                <h2 class="container-sidebar__h2">
                                    Sản phẩm yêu thích
                                </h2>
                                <div class="container-sidebar__group">

                                    <?php foreach ($products as $key => $product_) : ?>
                                        <div class="row sm-gutter">
                                            <div class="col l-12 m-12 c-12 abc">
                                                <a href="./product.php?id=<?= $product_['id'] ?>" class="container-sidebar__group-flex">
                                                    <img src="<?= fixUrl($product_['avatar'], './') ?>" alt="" class="container-sidebar__group-img">
                                                    <div class="container-sidebar__group-div">
                                                        <span class="container-sidebar__group-noti">
                                                            <?= $product_['name'] ?>
                                                        </span>
                                                        <div class="container-silebar__group-list">
                                                            <span class="container-sidebar__group-span" style="font-weight: 700; color: black;"><?= number_format($product_['price'], 0, ',', '.') ?>₫</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once($baseUrl . "layouts/bot.php"); ?>

    </div>
    <!-- javasprit -->
    <script src="./assets/js/sanpham.js"></script>
    <script>
        $(document).ready(function() {
            $('#addToCart').click(function() {
                var id = <?= $product['id'] ?>;
                var quantity = $('#numProducts').val();
                $.ajax({
                    url: './api/cart.php',
                    type: 'POST',
                    data: {
                        id: id,
                        quantity: quantity,
                        action: 'add'
                    },
                    success: function(data) {
                        if (data != '')
                            alert(data);
                        location.reload();
                    }
                });
            });
        })

        function buyNow() {
            var id = <?= $product['id'] ?>;
            var quantity = $('#numProducts').val();
            $.ajax({
                url: './api/cart.php',
                type: 'POST',
                data: {
                    id: id,
                    quantity: quantity,
                    action: 'add'
                },
                success: function(data) {
                    if (data != '')
                        alert(data);
                    if (data != 'Không đủ số lượng sản phẩm')
                        location.href = './cart.php';
                    else
                        location.reload();
                }
            });
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("js-myslide");
            var dots = document.getElementsByClassName("js-hiden");
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                // console.log(slides[i])
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        // Next/previous controls
        function plusSlides(n) {
            showSlides((slideIndex += n));
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides((slideIndex = n));
        }

        $(".container-form__add-sub").click(() => {
            var val = $(".fix-number").val();
            if (val > 1) {
                $(".fix-number").val(parseInt(val - 1), 10);
            }
        });

        $(".container-form__add-sub1").click(() => {
            $(".fix-number").val(parseInt($(".fix-number").val(), 10) + 1);
        });
    </script>
</body>

</html>
