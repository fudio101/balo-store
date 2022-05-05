<?php
require_once("./database/dbhelper.php");
require_once("./utils/utility.php");

$orderCode = '';
if (!isset($_GET['ordercode'])) {
    return header('Location: ./index.blade.php');
} else {
    $orderCode = fixSqlInject($_GET['ordercode']);
}

$order = executeResult("SELECT * FROM `db_order` WHERE `orderCode`='$orderCode';", true);
if ($order == null) {
    return header('Location: ./index.blade.php');
}

$customer = executeResult("select * from `db_customer` where `phone`={$order['phone']};", true);
$products = executeResult("select * from `db_orderdetail` where `orderid`={$order['id']};");
$orderstatus = executeResult("select * from `db_orderstatus` where `id`={$order['status_code']};", true);

$province = executeResult("select * from `db_province` where `id`={$order['province']}", true)['name'];
$district = executeResult("select * from `db_district` where `id`={$order['district']}", true)['name'];
$fullAddress = "{$order['address']}, {$district}, {$province}.";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./assets/images/store-solid.svg" />
    <link rel="stylesheet" href="./assets/css/balo.css">
    <link rel="stylesheet" href="./assets/css/balobase.css">
    <link rel="stylesheet" href="./assets/css/phieupay.css">
    <link rel="stylesheet" href="./assets/css/gird.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/icon/fontawesome-free-5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Phiếu thanh toán</title>
</head>

<body>
    <!-- <pre>
        <?php //print_r($order);
        ?>
        <?php //print_r($customer);
        ?>
        <?php //print_r($products);
        ?>
        <?php //print_r($orderstatus);
        ?>
    </pre> -->
    <div class="grid wide">
        <div class="row sm-gutter">
            <div class="col l-12 m-12 c-12">
                <div class="bill">
                    <div class="bill-slip">
                        <h2 class="bill-slip__text">Thông tin khách hàng</h2>
                        <form action="" method="">
                            <table class="bill-slip__table">
                                <tr>
                                    <td><label for="" class="bill-ship__label">Họ Tên:</label></td>
                                    <td class="bill-ship__value"><span class="bill-slip__span"><?= $order['fullname']; ?></span></td>
                                </tr>
                                <tr>
                                    <td><label for="" class="bill-ship__label">Email:</label></td>
                                    <td class="bill-ship__value"><span class="bill-slip__span"><?= $customer['email']; ?></span></td>
                                </tr>
                                <tr>
                                    <td><label for="" class="bill-ship__label">Điện thoại:</label></td>
                                    <td class="bill-ship__value"><span class="bill-slip__span"><?= $order['phone']; ?></span></td>
                                </tr>
                                <tr>
                                    <td><label for="" class="bill-ship__label">Địa chỉ:</label></td>
                                    <td class="bill-ship__value"><span class="bill-slip__span"><?= $fullAddress; ?></span></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="bill-product">
                        <h2 class="bill-product__text">Thông tin đơn hàng</h2>
                        <div class="bill-product__noti">
                            <p class="bill-product__noti-code">Mã đơn hàng: <span class="bill-product__noti-text">#<?= $order['orderCode']; ?></span></p>
                            <p class="bill-product__noti-code">Ngày tạo: <span class="bill-product__noti-text"><?= date('H:i:s d/m/Y', strtotime($order['created'])); ?></span></p>
                        </div>
                        <form action="" method="">
                            <table class="bill-product__table-1">
                                <tr class="tr-pay">
                                    <th colspan="2"><label for="" class="bill-product__th">Sản phẩm</label></th>
                                    <th><label for="" class="bill-product__th">Số lượng</label></th>
                                    <th><label for="" class="bill-product__th">Đơn giá</label></th>
                                    <th><label for="" class="bill-product__th">Tổng</label></th>
                                </tr>

                                <?php foreach ($products as $product) : ?>
                                    <?php $inforProduct = executeResult("select `name` from `db_product` where `id`={$product['productid']}", true); ?>
                                    <tr>
                                        <td colspan="2"><span class="bbill-product__span-text"><?= $inforProduct['name']; ?></span></td>
                                        <td><span class="bbill-product__span-text text-cent"><?= $product['number']; ?></span></td>
                                        <td><span class="bbill-product__span-text text-cent"><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span></td>
                                        <td><span class="bbill-product__span-text text-cent"><?= number_format($product['price'] * $product['number'], 0, ',', '.'); ?> VNĐ</span></td>
                                    </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td><span class="bbill-product__pay-text">Tổng cộng:</span></td>
                                    <td><span class="bbill-product__pay-sum"><?= number_format($order['money'], 0, ',', '.'); ?> VNĐ</span></td>
                                </tr>
                                <tr>
                                    <td><span class="bbill-product__pay-text">Phí vận chuyển</span></td>
                                    <td><span class="bbill-product__pay-sum"><?= number_format($order['price_ship'], 0, ',', '.'); ?> VNĐ</span></td>
                                </tr>
                                <tr>
                                    <td><span class="bbill-product__pay-text">Voucher:</span></td>
                                    <td><span class="bbill-product__pay-sum">-<?= number_format($order['coupon'], 0, ',', '.'); ?> VNĐ</span></td>
                                </tr>
                                <tr>
                                    <td><span class="bbill-product__pay-text">Tổng thành tiền</span></td>
                                    <td><span class="bbill-product__pay-sum"><?= number_format($order['money'] + $order['price_ship'] - $order['coupon'], 0, ',', '.'); ?> VNĐ</span></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <p class="bill-noti">Trạng thái hóa đơn: <span><?= $orderstatus['orderstatus'] ?></span></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
