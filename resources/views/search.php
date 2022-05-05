<?php
require_once("./database/dbhelper.php");
require_once("./utils/utility.php");

$keyword = '';
$sort = 0;
if (!isset($_GET['key'])) {
    return header('Location: ./index.blade.php');
} else {
    $keyword = fixSqlInject($_GET['key']);
}

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

$rowProduct = executeResult("select * from `db_product` where `name` like '%$keyword%'", true);
//Không tìm thấy sản phẩm thì cho về trang chủ
if ($rowProduct == null) {
    return header('Location: ./index.blade.php');
}
///PHAN TRANG///
//calculate
$totalProduct = count(executeResult("select `id` from `db_product` where `status`=1  and `name` like '%$keyword%'"));
$numProductsPerPage = 4;
$maxPage = (int)ceil($totalProduct / $numProductsPerPage);
//get curent page
$curentPage = 1;
if (isset($_GET['page'])) {
    $curentPage = (int)$_GET['page'];
}
$curentPage = $curentPage < 1 ? 1 : $curentPage;
$curentPage = $curentPage > $maxPage ? $maxPage : $curentPage;

$pageStart = $curentPage - 2;
$pageEnd = $curentPage + 2;

if ($curentPage < 4) {
    $pageStart = 1;
    $pageEnd = $maxPage > 5 ? ($pageStart + 4) : $maxPage;
} elseif ($curentPage > $maxPage - 3) {
    $pageEnd = $maxPage;
    $pageStart = $maxPage > 5 ? ($pageEnd - 4) : 1;
}
$offset = ($curentPage - 1) * $numProductsPerPage;
///END PHAN TRANG///
$sortKey = "ORDER BY `created` DESC";
$sortKey = ($sort == 1) ? "ORDER BY `price` ASC" : (($sort == 2) ? "ORDER BY `price` DESC" : $sortKey);

$sql = "SELECT `id`,`avatar`,`name`,`price`
        FROM `db_product`
        WHERE `status`=1 AND `name` like '%$keyword%'
        $sortKey
        LIMIT $offset, $numProductsPerPage";
$rowsProduct = executeResult($sql);

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('./layouts/head.php'); ?>

<body>
    <div class="apps">
        <?php require_once($baseUrl . "layouts/top.php"); ?>

        <div class="container">
            <div class="grid wide">
                <div class="container-wrapper">
                    <div class="container-wrapper__page">
                        <h1 class="container-wrapper__page-h1">Sản phẩm</h1>
                        <nav class="container-wrapper__page-nav">
                            <a href="index.blade.php" class="container-wrapper__page-link">Trang chủ</a>
                            <span class="container-wrapper__page-span">/</span>
                            <span class="container-wrapper__page-span">Tìm kiếm sản phẩm</span>
                            <span class="container-wrapper__page-span">/</span>
                            <span class="container-wrapper__page-span"><?= $keyword; ?></span>
                        </nav>
                    </div>
                    <div class="container-wrapper__category">
                        <p class="container-wrapper__category-p container-wrapper__category-none">Có tất cả
                            <span class="container-wrapper__category-span"><?= $totalProduct; ?></span>
                            kết quả
                        </p>
                        <div class="container-select" id="sort">
                            <select name="" id="" class="container-select__list">
                                <option value="0" class="container-select__option">Thứ tự mặc định</option>
                                <option value="1" class="container-select__option">Thứ tự theo giá: từ thấp lên cao</option>
                                <option value="2" class="container-select__option">Thứ tự theo giá: từ cao xuống thấp</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container-small">
                    <div class="row sm-gutter">
                        <?php foreach ($rowsProduct as $product) : ?>
                            <div class="col l-3 m-6 c-12">
                                <a href="product.php?id=<?= $product['id']; ?>" class="container-small__form">
                                    <img src="<?= fixUrl($product['avatar'], './'); ?>" alt="" class="container-small__form-img">
                                    <div class="container-small__noti">
                                        <p class="container-small__noti-p"><?= $product['name']; ?></p>
                                        <div class="container-small__noti-div">
                                            <p class="container-small__noti-p1"><?= number_format($product['price'], 0, ',', '.'); ?>₫</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="container-page">
                        <ul class="container-page__form">
                            <li class="container-page__list">
                                <a href="search.php?key=<?= $keyword; ?>&sort=<?= $sort; ?>&page=<?= $curentPage > 5 ? ($curentPage - 5) : 1; ?>" class="container-page__link">
                                    <i class="container-page__icon fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <?php for ($index = $pageStart; $index <= $pageEnd; $index++) : ?>
                                <li class="container-page__list <?= $index == $curentPage ? 'open-color' : ''; ?>">
                                    <a href="search.php?key=<?= $keyword; ?>&sort=<?= $sort; ?>&page=<?= $index; ?>" class="container-page__link"><?= $index; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="container-page__list">
                                <a href="search.php?key=<?= $keyword; ?>&sort=<?= $sort; ?>&page=<?= $curentPage < ($maxPage - 5) ? ($curentPage + 5) : $maxPage; ?>" class="container-page__link">
                                    <i class="container-page__icon fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once($baseUrl . "layouts/bot.php"); ?>
    </div>
    <!-- javasprit -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('#sort').change(function() {
            var sort = $('#sort option:selected').val();
            window.location.href = "search.php?key=<?= $keyword; ?>&sort=" + sort;
        });
    </script>
</body>

</html>
