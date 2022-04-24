<?php

if (!empty($_POST)) {
	$id = getPost('id');
	$fullname = getPost('fullname');
	$username = getPost('username');
	$email = getPost('email');
	$phone_number = getPost('phone_number');
	$address = getPost('address');
	$password = getPost('password');
	$user_ = $user["username"];
	$role_id = getPost('role_id');
	if ($password != '') {
		$password = getSecurityMD5($password);
	}

	if ($id > 0) {
		//update
		$sql = "select * from db_user where email = '$email' and id <> $id";
		$userItem = executeResult($sql, true);

		if ($userItem != null) {
			$msg = 'This email already exists in another account, please check again!!!';
		} else {
			if ($password != '') {
				$sql = "update db_user set fullname = '$fullname' email = '$email', phone = '$phone_number', address = '$address', password = '$password', role = $role_id, modified_by = '$user_'
				where id = $id";
			} else {
				$sql = "update db_user set fullname = '$fullname', email = '$email', phone = '$phone_number', address = '$address', role = $role_id, modified_by = '$user_' 
				where id = $id";
			}
			execute($sql);
			$sql = "SELECT * FROM `db_user` WHERE id = $id;";
			$user = executeResult($sql, true);
			$_SESSION['user'] = $user;
			header('Location: ./');
			die();
		}
	} else {
		$sql = "select * from db_user where email = '$email' or username = '$username'";
		$userItem = executeResult($sql, true);
		//insert
		if ($userItem == null) {
			//insert
			$sql = "INSERT INTO db_user(fullname, username, password, role, email, phone , address, created_by) VALUES 
			('$fullname', '$username', '$password', '$role_id', '$email', '$phone_number', '$address', '$user_')";
			execute($sql);
			header('Location: ./');
			die();
		} else {
			//Tai khoan da ton tai -> failed
			$msg = 'Username or email has been registered, please check again!!!';
		}
	}
}
