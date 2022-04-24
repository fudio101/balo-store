<?php
$title = 'Discount Manager';
$baseUrl = '../';
require_once('../layouts/header.blade.php');

//pending, approved, cancel
$sql = "SELECT * FROM `db_discount` WHERE `status` = 1";
$data = executeResult($sql);
?>

<div class="row" style="margin-top: 48px;">
    <div class="col-md-12 table-responsive">
        <h3>Discount Manager</h3>

        <a href="editor.php"><button class="btn btn-success">Add Product</button></a>

        <table class="table table-striped table-hover" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Limit number</th>
                    <th>Number used</th>
                    <th>Expiration date</th>
                    <th>Payment limit</th>
                    <th>Description</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach ($data as $item) {
                    echo '<tr>
					<th>' . (++$index) . '</th>
					<td>' . $item['code'] . '</td>
					<td>' . $item['discount'] . '</td>
					<td>' . $item['limit_number'] . '</td>
					<td>' . $item['number_used'] . '</td>
					<td>' . $item['expiration_date'] . '</td>
					<td>' . $item['payment_limit'] . '</td>
					<td>' . $item['description'] . '</td>
                    <td style="width: 50px">
						<a href="editor.php?id=' . $item['id'] . '"><center><button class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button></center></a>
                    <td style="width: 50px">
                        <center><button onclick="deleteDiscount(' . $item['id'] . ')" class="btn btn-danger"><i class="bi bi-x"></i></button></center>
                    </td>
				</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function deleteDiscount(id) {
        $.post('form_api.php', {
            'id': id,
            'action': 'delete_discount'
        }, function(data) {
            location.reload();
        })
    }
</script>

<?php
require_once('../layouts/footer.blade.php');
?>
