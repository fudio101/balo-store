<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if ($user == null) {
	die();
}

$user_ = $user["username"];

if (!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteProduct();
			break;
		case 'import':
			importProduct();
			break;
	}
}

function deleteProduct()
{
	global $user_;
	$id = getPost('id');
	$sql = "UPDATE `db_product` SET `modified_by`='$user_',`status`=0 WHERE `id`=$id";
	execute($sql);
}

function importProduct()
{
	global $user_;
	$id = getPost('id');
	$sql = "SELECT number FROM `db_product` WHERE `id`=$id";
	$result = executeResult($sql, true);
	$quantity = getPost('quantity') + $result['number'];
	$sql = "UPDATE `db_product` SET `modified_by`='$user_',`number`=$quantity WHERE `id`=$id";
	execute($sql);
}
