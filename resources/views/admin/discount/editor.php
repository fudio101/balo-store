<?php
$title = 'Add/Edit Discount';
$baseUrl = '../';
require_once('../layouts/header.blade.php');

$id = $code = $discount = $limit_number = $payment_limit = $expiration_date = $description = '';
require_once('form_save.php');

$id = getGet('id');
if ($id != '' && $id > 0) {
    $sql = "select * from db_discount where id = $id and status = 1";
    $userItem = executeResult($sql, true);
    if ($userItem != null) {
        $code = $userItem['code'];
        $discount = $userItem['discount'];
        $limit_number = $userItem['limit_number'];
        $payment_limit = $userItem['payment_limit'];
        $expiration_date = $userItem['expiration_date'];
        $description = $userItem['description'];
    } else {
        $id = 0;
    }
} else {
    $id = 0;
}

?>
<!-- include summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script> -->
<script></script>

<div class="row" style="margin-top: 48px;">
    <div class="col-md-12 table-responsive">
        <h3>Add/Edit Products</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="mb-2 mt-3" for="code">Code:</label>
                        <input required="true" type="text" class="form-control" id="code" name="code" value="<?= $code ?>">
                        <input type="text" name="id" value="<?= $id ?>" hidden="true">
                    </div>


                    <div class="form-group">
                        <label class="mb-2 mt-3" for="discount">Discount:</label>
                        <input required="true" type="number" min="1" class="form-control" id="discount" name="discount" value="<?= $discount ?>">
                    </div>


                    <div class="form-group">
                        <label class="mb-2 mt-3" for="num">Limit Number:</label>
                        <input required="true" type="number" min="0" class="form-control" id="num" name="num" value="<?= $limit_number ?>">
                    </div>


                    <div class="form-group">
                        <label class="mb-2 mt-3" for="exp_date">Expiration date:</label>
                        <input required="true" type="date" class="form-control" id="exp_date" name="exp_date" value="<?= $expiration_date ?>">
                    </div>


                    <div class="form-group">
                        <label class="mb-2 mt-3" for="pay_limit">Payment limit:</label>
                        <input required="true" type="number" min="0" class="form-control" id="pay_limit" name="pay_limit" value="<?= $payment_limit ?>">
                    </div>


                    <div class="form-group">
                        <label class="mb-2 mt-3" for="desc">Description:</label>
                        <input required="true" type="text" class="form-control" id="desc" name="desc" value="<?= $description ?>">
                    </div>

                    <button class="btn btn-success mt-3">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once('../layouts/footer.blade.php');
?>
