<?php
if (!empty($_POST)) {
	$id = getPost('id');
	$title = getPost('title');
	$price = getPost('price');

	$thumbnail = moveFile('thumbnail');
	$imgs = moveFiles('imgs');

	$description = getPost('description');
	$category_id = getPost('category_id');
	$producer_id = getPost('producer_id');

	$user_ = $user['username'];

	if ($id > 0) {
		//update
		if ($thumbnail == '' && $imgs == '') {
			$sql = "update db_product set name = '$title', price = $price, detail = '$description', catid = '$category_id', producer = '$producer_id', modified_by = '$user_' where id = $id";
		} elseif ($thumbnail != '' && $imgs != '') {
			$sql = "SELECT avatar, img FROM db_product WHERE id = $id";
			$item = executeResult($sql, true);
			deleteFile($item['avatar']);
			deleteFiles($item['img']);
			$sql = "update db_product set avatar = '$thumbnail', img = '$imgs', name = '$title', price = $price, detail = '$description', producer = '$producer_id', catid = '$category_id', modified_by = '$user_' where id = $id";
		} elseif ($thumbnail != '') {
			$sql = "SELECT avatar FROM db_product WHERE id = $id";
			$item = executeResult($sql, true);
			deleteFile($item['avatar']);
			$sql = "update db_product set avatar = '$thumbnail', name = '$title', price = $price, detail = '$description', producer = '$producer_id', catid = '$category_id', modified_by = '$user_' where id = $id";
		} else {
			$sql = "SELECT  img FROM db_product WHERE id = $id";
			$item = executeResult($sql, true);
			deleteFiles($item['img']);
			$sql = "update db_product set img = '$imgs', name = '$title', price = $price, detail = '$description', producer = '$producer_id', catid = '$category_id', modified_by = '$user_' where id = $id";
		}

		execute($sql);

		header('Location: ./');
	} else {
		//insert
		$sql = "INSERT INTO `db_product`(`catid`, `name`, `avatar`, `img`, `detail`, `producer`, `price`, `created_by`) 
		VALUES ($category_id, '$title', '$thumbnail', '$imgs', '$description', $producer_id, '$price', '$user_')";
		execute($sql);

		header('Location: ./');
	}
}
