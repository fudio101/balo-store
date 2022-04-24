<?php
$title = 'Order Details';
$baseUrl = '../';
require_once('../layouts/header.blade.php');

$orderId = getGet('id');

$sql = "SELECT `db_orderdetail`.`number`, `db_orderdetail`.`price`, `avatar`, `name`
		FROM `db_product`, `db_orderdetail`
		WHERE `db_orderdetail`.`orderid`=$orderId AND `db_orderdetail`.`productid`=`db_product`.`id`";
$data = executeResult($sql);

$sql = "SELECT `db_customer`.`phone`, `db_customer`.`fullname`, `db_customer`.`address`, `db_customer`.`email`
		FROM `db_order`, `db_customer`
		WHERE `db_order`.`id`=$orderId AND `db_order`.`phone`=`db_customer`.`phone`";
$customer = executeResult($sql, true);

$sql = "SELECT `coupon`
		FROM `db_order`
		WHERE `id`=$orderId";
$coupon = executeResult($sql, true);
?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<h3>Order Details</h3>
	</div>
	<div class="col-md-8 table-responsive">
		<table class="table table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>#</th>
					<th>Thumbnail</th>
					<th>Product name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$index = 0;
				$subtotal = 0;
				foreach ($data as $item) {
					$subtotal += $item['price'] * $item['number'];
					echo '<tr>
					<th>' . (++$index) . '</th>
					<td><img src="' . fixUrl($item['avatar']) . '" style="height: 120px"/></td>
					<td>' . $item['name'] . '</td>
					<td>' . $item['price'] . '</td>
					<td>' . $item['number'] . '</td>
					<td>' . $item['price'] * $item['number'] . '</td>
				</tr>';
				}
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<th>Total</th>
					<th><?= $subtotal ?></th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<th>Discount</th>
					<th><?= $coupon['coupon'] ?></th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<th>Subtotal</th>
					<th><?= max($subtotal - $coupon['coupon'], 0) ?></th>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-4">
		<table class="table table-bordered table-hover" style="margin-top: 20px;">
			<tr>
				<th>Name: </th>
				<td><?= $customer['fullname'] ?></td>
			</tr>
			<tr>
				<th>Email: </th>
				<td><?= $customer['email'] ?></td>
			</tr>
			<tr>
				<th>Address: </th>
				<td><?= $customer['address'] ?></td>
			</tr>
			<tr>
				<th>Phone: </th>
				<td><?= $customer['phone'] ?></td>
			</tr>
		</table>
	</div>
</div>
<?php
require_once('../layouts/footer.blade.php');
?>
