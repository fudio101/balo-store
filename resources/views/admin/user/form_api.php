<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if ($user == null || $user["role" != "1"]) {
	header('Location: ../');
}

if (!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteUser();
			break;
	}
}

function deleteUser()
{
	$id = getPost('id');
	// $updated_at = date("Y-m-d H:i:s");
	$sql = "UPDATE db_user SET modified_by = 'fudio101', status = 0 WHERE id = $id";
	execute($sql);
}
