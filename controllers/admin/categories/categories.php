<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'create';
        include_once('./controllers/admin/categories/create.php');
        break;

    case 'store';
        include_once('./controllers/admin/categories/store.php');
        break;
    case 'edit':
        include_once('./controllers/admin/categories/edit.php');
        break;
    case 'update';
        include_once('./controllers/admin/categories/update.php');
        break;
    case 'delete';
        include_once('./controllers/admin/categories/delete.php');
    default:
        include_once('./controllers/admin/categories/index.php');
        break;
}
