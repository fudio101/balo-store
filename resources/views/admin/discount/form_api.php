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
        case 'delete_discount':
            deleteDiscount();
            break;
    }
}

function deleteDiscount()
{
    try {
        $id = getPost('id');
        global $user_;
        $sql = "UPDATE `db_discount` SET `modified_by`='$user_',`status`=0 WHERE `id`= $id";
        execute($sql);
    } catch (PDOException $e) {
        echo $e;
    }
}
