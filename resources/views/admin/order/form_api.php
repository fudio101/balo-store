<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$user = getUserToken();
if ($user == null) {
	die();
}
$user_ = $user['username'];

if (!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'update_status':
			updateStatus();
			break;
	}
}

function updateStatus()
{
	$id = getPost('id');
	$status = getPost('status');
	global $user_;

	$sql = "UPDATE `db_order` SET `modified_by`='$user_',`status_code`=$status WHERE `id`=$id";
	execute($sql);
}
