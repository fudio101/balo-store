<?php
$title = 'Order Management';
$baseUrl = '../';
require_once('../layouts/header.blade.php');

//pending, approved, cancel
$sql = "SELECT `db_order`.`id`, `db_order`.`orderCode`, `db_order`.`fullname`, `db_order`.`phone`, `db_order`.`money`,
		`db_order`.`price_ship`, `db_order`.`coupon`, `db_order`.`province`, `db_order`.`district`, `db_order`.`address`,
		`db_order`.`order_status`, `db_order`.`created`, `db_order`.`status_code`, `db_customer`.`address`, `db_customer`.`email`
		FROM `db_order`, `db_customer`
		WHERE `db_order`.`phone`=`db_customer`.`phone` AND `db_order`.`order_status`=1
		ORDER BY `db_order`.`status_code` ASC, `db_order`.`created` ASC;";
$data = executeResult($sql);
?>

<div class="row" style="margin-top: 48px;">
	<div class="col-md-12 table-responsive">
		<h3>Order Management</h3>

		<table class="table table-striped table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>#</th>
					<th>Order Code</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Total</th>
					<th>Created</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$index = 0;
				foreach ($data as $item) {
					echo '<tr style="height: 90px;">
					<th>' . (++$index) . '</th>
					<td><a href="detail.php?id=' . $item['id'] . '">' . $item['orderCode'] . '</a></td>
					<td>' . $item['fullname'] . '</td>
					<td>' . $item['phone'] . '</td>
					<td>' . $item['address'] . '</td>
					<td>' . max($item['money'] - $item['coupon'], 0) . '</td>
					<td>' . $item['created'] . '</td>
					<td>';
					if ($item['status_code'] == 1) {
						echo '<label class="badge bg-info">Paid</label>';
					} else if ($item['status_code'] == 2) {
						echo '	<label class="badge bg-info">Delivering</label>';
					} else if ($item['status_code'] == 3) {
						echo '	<label class="badge btn-primary">Delivered</label>';
					} else {
						echo '<label class="badge btn-danger">Canceled</label>';
					}
					echo '</td>
					<td>';
					if ($item['status_code'] == 1) {
						echo '	<button onclick="changeStatus(' . $item['id'] . ', 2)" class="btn btn-sm btn-success">Approve</button>
								<button onclick="changeStatus(' . $item['id'] . ', 4)" class="btn btn-sm bg-warning">Cancel</button>';
					} else if ($item['status_code'] == 2) {
						echo '	<button onclick="changeStatus(' . $item['id'] . ', 3)" class="btn btn-sm btn-success">Received</button>
								<button onclick="changeStatus(' . $item['id'] . ', 4)" class="btn btn-sm bg-warning">Cancel</button>';
					}
					echo '</td>
				</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	function changeStatus(id, status) {
		$.post('form_api.php', {
			'id': id,
			'status': status,
			'action': 'update_status'
		}, function(data) {
			location.reload()
		})
	}
</script>

<?php
require_once('../layouts/footer.blade.php');
?>
