<?php
require_once('./utils/utility.php');
require_once('./database/dbhelper.php');


?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('layouts/head.php'); ?>

<body>
    <div class="apps">
        <?php
        require_once("layouts/top.php");
        //Nếu giỏ hàng trống thì cho về trang chủ
        if ($cartList == NULL) {
            echo "<script>window.location.href='index.blade.php';</script>";
        }
        $discount = 0;
        if (!empty($_SESSION['coupon'])) {
            $coupon = $_SESSION['coupon'];
            $discount = $coupon['discount'];
        }
        ?>

        <div class="container-loader" id='loading'>

        </div>
        <div class="container">
            <div class="grid wide">
                <div class="container-pays">
                    <div class="container-pays__sale">
                        <p class="container-pays__sale-text">
                            Bạn có mã ưu đãi ?
                            <span class="container-pays__span js-pays__span">Ấn vào đây để nhập mã</span>
                        </p>
                        <div class="container-pays__login js-pays__login">
                            <span class="container-pays__login-text">
                                Nếu bạn có mã giảm giá, vui lòng điền vào phía bên dưới.
                            </span>
                            <form action="#" class="container-pays__login-from" id="form-coupon">
                                <input type="text" class="container-pays__login-sale" id="coupon-code">
                                <button class="btn btn--blue container-pays__login-button" id="submit-coupon">Áp dụng</button>
                            </form>
                        </div>
                        <div class="container-client">
                            <div class="row sm-gutter">
                                <div class="col l-7 m-7 c-12">
                                    <form action="" class="container-client__pay">
                                        <label for="" class="container-client__pay-text">Thông Tin Thanh Toán</label>
                                        <div class="container-client__flex">
                                            <div class="container-client__flex-name">
                                                <label for="" class="container-client__flex-text">Tên*</label>
                                                <input type="text" class="container-client__flex-input" id="firstname">
                                                <p class="container-client__flex-span"></p>
                                            </div>
                                            <div class="container-client__flex-name">
                                                <label for="" class="container-client__flex-text">Họ*</label>
                                                <input type="text" class="container-client__flex-input" id="lastname">
                                                <p class="container-client__flex-span"></p>
                                            </div>
                                        </div>
                                        <div class="container-client__last">
                                            <label for="" class="container-client__last-text">Tỉnh/Thành phố*</label>
                                            <select class="container-client__last-input" id="province" required>
                                                <option selected>Choose...</option>
                                            </select>
                                            <p class="container-client__last-span"></p>
                                        </div>
                                        <div class="container-client__last">
                                            <label for="" class="container-client__last-text">Quận/Huyện/Trị Trấn</label>
                                            <select class="container-client__last-input" id="district" required>
                                                <option selected>Choose...</option>
                                            </select>
                                            <p class="container-client__last-span"></p>
                                        </div>
                                        <div class="container-client__last">
                                            <label for="" class="container-client__last-text">Địa chỉ*</label>
                                            <input type="text" class="container-client__last-input" id="address" required>
                                            <p class="container-client__last-span"></p>
                                        </div>
                                        <div class="container-client__last">
                                            <label for="" class="container-client__last-text">Số điện thoại*</label>
                                            <input type="text" class="container-client__last-input" id="phoneNumber" required>
                                            <p class="container-client__last-span"></p>
                                        </div>
                                        <div class="container-client__last">
                                            <label for="" class="container-client__last-text">Địa chỉ Email*</label>
                                            <input type="text" class="container-client__last-input" id="email">
                                            <p class="container-client__last-span"></p>
                                        </div>
                                    </form>
                                </div>
                                <div class="col l-5 m-5 c-12">
                                    <div class="container-bill">
                                        <h2 class="container-bill__text">Đơn hàng của bạn</h2>
                                        <div class="container-bill__noti">
                                            <span class="container-bill__noti-span">Sản phẩm</span>
                                            <span class="container-bill__noti-span">Tạm tính</span>
                                        </div>
                                        <ul class="container-bill__list">
                                            <input type="hidden" id="products" value='<?= json_encode($cartList); ?>'>
                                            <input type="hidden" id="cart" value='<?= json_encode($cart); ?>'>
                                            <?php if ($cartList != null) foreach ($cartList as $key => $sp) : ?>
                                                <li class="container-bill__item">
                                                    <div class="container-bill__item-flex">
                                                        <p class="container-bill__item-text">
                                                            <?= $sp['name']; ?>
                                                            <span class="container-bill__item-sapn">x<?= $cart[$key]['quantity']; ?></span>
                                                        </p>
                                                        <p class="container-bill__item-money"><?= number_format($sp['price'] * $cart[$key]['quantity'], 0, ',', '.'); ?>đ</p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                        <div class="container-bill__price">
                                            <span class="container-bill__price-text">Tạm tính:</span>
                                            <span class="container-bill__price-text"><?= number_format($total, 0, ',', '.'); ?>đ</span>
                                        </div>
                                        <div class="container-bill__price">
                                            <?php $priceShip = executeResult('SELECT `priceShip` FROM `db_config`')[0]['priceShip']; ?>
                                            <span class="container-bill__price-text">Phí vận chuyển:</span>
                                            <span class="container-bill__price-text" id='priceShip'><?= number_format($priceShip, 0, ',', '.'); ?>đ</span>
                                        </div>
                                        <div class="container-bill__price">
                                            <span class="container-bill__price-text">Mã giảm giá:</span>
                                            <span class="container-bill__price-text" id="discount_price"><?= number_format($discount, 0, ',', '.'); ?>đ</span>
                                        </div>
                                        <div class="container-bill__price">
                                            <span class="container-bill__price-text">Thanh toán:</span>
                                            <span class="container-bill__price-text" id="amount_pay"><?= number_format($total + $priceShip - $discount, 0, ',', '.'); ?>đ</span>
                                        </div>
                                        <form action="" class="container-bill__pay">
                                            <p class="container-bill__pay-text">
                                                Không có hình thức thanh toán nào được thiết
                                                lập theo địa chỉ khu vực của bạn. Vui lòng liên hệ
                                                với quản trị website để hỗ trợ vấn đề này.
                                            </p>
                                            <button type="button" class="btn btn--green container-bill__pay-submit js-pay-submit">Đặt Hàng</button>
                                            <p class="container-bill__pay-noti">
                                                Thông tin cá nhân của bạn sẽ được sử dụng để
                                                xử lý đơn hàng, tăng trải nghiệm sử dụng website
                                                , và cho các mục đích cụ thể khác đã được mô tả trong
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-pay js-modal-turnon">
            <div class="modal-pay__over"></div>
            <div class="modal-pay__form">
                <div class="modal-form__list">
                    <img src="./assets/images/MoMo.png" alt="" class="modal-form__img-list">
                    <p class="modal-form__list-text">Quét mã QR Code để thanh toán</p>
                </div>
                <div class="modal-form__img">
                    <img src="./assets/images/qr.jpg" alt="" class="modal-form__img-last">
                    <p class="modal-form__list-span js-modal-number"></p>
                    <p class="modal-form__list-span js-modal-sucsess"></p>
                </div>
                <div class="modal-form__pays">
                    <!-- <button class="modal-form__pays-submit js-modal-pays">Đồng ý thanh toán</button> -->
                    <button class="modal-form__pays-close js-modal-close" id="paydone">Xem hóa đơn</button>
                </div>
            </div>
        </div>
        <?php require_once($baseUrl . "layouts/bot.php"); ?>
    </div>
    <!-- javasprit -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="./assets/js1/thanhtoan.js"></script>
    <script>
        $.ajax({
            url: './api/address.php',
            type: 'POST',
            data: {
                action: 'getprovince'
            },
            success: (data) => {
                if (data != '') {
                    var list = jQuery.parseJSON(data);
                    list = list.map(
                        (res) => $('<option>', {
                            value: res.id,
                            text: res.name
                        })
                    );
                    $('#province').append(list);
                }
            }
        });

        $('#province').on('change', () => {
            $.ajax({
                url: './api/address.php',
                type: 'POST',
                data: {
                    action: 'getdistrict',
                    provinceid: $('#province').val()
                },
                success: (data) => {
                    if (data != '') {
                        var list = jQuery.parseJSON(data);
                        list = list.map(
                            (res) => $('<option>', {
                                value: res.id,
                                text: res.name
                            })
                        );
                        $('#district').empty().append($('<option>', {
                            text: 'Choose...'
                        })).append(list);
                    }
                }
            })
        });

        const totalCost = <?= $total; ?>;
        const amountPay = <?= ($total + $priceShip - $discount); ?>;
        const priceShip = <?= $priceShip; ?>;
        var amountPayTemp = <?= ($total + $priceShip - $discount); ?>;
        var discount = <?= $discount ?>;

        $('#submit-coupon').on('click', () => {
            $.ajax({
                url: './api/cart.php',
                type: 'POST',
                data: {
                    action: 'getdiscount',
                    total: totalCost,
                    couponcode: $('#coupon-code').val()
                },
                success: (data) => {
                    var res = jQuery.parseJSON(data);
                    if (typeof(res.message) !== 'undefined') {
                        alert('Mã giảm giá không hợp lệ!');
                    } else {
                        upadateDiscountPrice(res);
                    }
                }
            });

            function upadateDiscountPrice(res) {
                discount = res.discount;
                $('#discount_price').text(new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(discount));
                var amountPayNew = amountPay - discount;
                amountPayTemp = amountPayNew;
                $('#amount_pay').text(new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amountPayNew));
            }
        });

        $('#paydone').on('click', () => {
            $('#loading').append('<div class="loader"><div class="point point-1"></div><div class="point point-2"></div><div class="point point-3"></div><div class="point point-4"></div></div>');

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var province = $('#province').val();
            var district = $('#district').val();
            var address = $('#address').val();
            var phoneNumber = $('#phoneNumber').val();
            var email = $('#email').val();
            var products = $('#products').val();
            var cart = $('#cart').val();
            var priceShip = <?= $priceShip; ?>;
            var discount_price = discount;
            var amount_pay = amountPayTemp;

            $.ajax({
                url: './api/cart.php',
                type: 'POST',
                data: {
                    action: 'create_order',
                    firstname: firstname,
                    lastname: lastname,
                    province: province,
                    district: district,
                    address: address,
                    phoneNumber: phoneNumber,
                    email: email,
                    products: products,
                    cart: cart,
                    totalCost: totalCost,
                    priceShip: priceShip,
                    discount_price: discount_price,
                    amount_pay: amount_pay
                },
                success: (data) => {
                    console.log(data);
                    var urlHoaDon = './hoadon.php?ordercode=' + data;
                    console.log(urlHoaDon);
                    setTimeout(() => {
                        window.open(urlHoaDon, '_blank');
                        window.location.href = 'index.blade.php';
                    }, 2000);

                }
            });
        });
    </script>
</body>

</html>
