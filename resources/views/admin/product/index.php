<?php
$title = 'Quản Lý Sản Phẩm';
$baseUrl = '../';
require_once('../layouts/header.blade.php');

$sql = "select db_product.*, db_category.name as category_name from db_product left join db_category on db_product.catid = db_category.id where db_product.status = 1";
$data = executeResult($sql);
?>

<div class="row" style="margin-top: 46px;">
	<div class="col-md-12 table-responsive">
		<h3>Product Management</h3>

		<a href="editor.php"><button class="btn btn-success">Add Product</button></a>

		<table class="table table-striped table-hover" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Thumbnail</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Quantity Sold</th>
					<th>Import</th>
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
					<td><center><img src="' . fixUrl($item['avatar']) . '" style="height: 100px; object-fit: contain;"/></center></td>
					<td>' . $item['name'] . '</td>
					<td>' . $item['price'] . '</td>
					<td>' . $item['category_name'] . '</td>
					<td>' . $item['number'] . '</td>
					<td>' . $item['number_buy'] . '</td>
					<td style="width: 50px">
						<center>
							<button onclick="importGoods(' . $item['id'] . ')" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
						<center>
					</td>
					<td style="width: 50px">
						<a href="editor.php?id=' . $item['id'] . '">
							<center>
								<button class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button>
							</center>
						</a>
					</td>
					<td style="width: 50px">
						<center>
							<button onclick="deleteProduct(' . $item['id'] . ')" class="btn btn-danger"><i class="bi bi-x"></i></button>
						<center>
					</td>
				</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	function deleteProduct(id) {
		option = confirm('Are you sure you want to delete this product?')
		if (!option) return;

		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data) {
			location.reload()
		})
	}

	function importGoods(id) {
		quantity = prompt('How many products do you want to import?')
		if (!quantity) return;

		$.post('form_api.php', {
			'id': id,
			'action': 'import',
			'quantity': quantity
		}, function(data) {
			location.reload()
		})
	}
</script>

<?php
require_once('../layouts/footer.blade.php');
?>
