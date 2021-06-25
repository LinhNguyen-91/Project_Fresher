<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once('./models/connect.php');
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'create':
        include_once('./controllers/admin/products/create.php');
        break;
    case 'store':
        include_once('./controllers/admin/products/store.php');
        break;
    case 'edit':
       include_once('./controllers/admin/products/edit.php');
        break;
    case 'update':
        include_once('./controllers/admin/products/update.php');
        break;
    case 'delete';
        include_once('./controllers/admin/products/delete.php');
        break;
    default:
        include_once('./controllers/admin/products/index.php');
        break;
}

?>