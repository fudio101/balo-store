<?php
if (!empty($_POST)) {
	$id = getPost('id');
	$code = $_POST['code'];
	$discount = getPost('discount');
	$limit_number = getPost('num');
	$payment_limit = getPost('pay_limit');
	$expiration_date = getPost('exp_date');
	$description = getPost('desc');

	$user_ = $user['username'];


	if ($id > 0) {
		//update
		$sql = "SELECT avatar FROM db_product WHERE id = $id";
		$item = executeResult($sql, true);
		$sql = "update db_discount 
		set code='$code', discount=$discount, limit_number=$limit_number, payment_limit=$payment_limit, expiration_date='$expiration_date', description='$description' , modified_by='$user_' 
		where id=$id";


		execute($sql);

		header('Location: ./');
		die();
	} else {

		$sql = "SELECT * FROM db_discount WHERE code='$code' AND status=1";
		$result = executeResult($sql, true);

		if ($result == null) {
			//insert
			$sql = "INSERT INTO `db_discount`(`code`, `discount`, `limit_number`, `expiration_date`, `payment_limit`, `description`, `created_by`) 
					VALUES ('$code', $discount, $limit_number, '$expiration_date', $payment_limit, '$description', '$user_')";
			execute($sql);
			header('Location: ./');

		} else {
			echo '<script language="javascript">';
			echo 'alert("This code is active!!")';
			echo '</script>';
		}
	}
}
