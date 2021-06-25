<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'search';
        include_once('./controllers/admin/orders/search.php');
        break;

    default:
        include_once('./controllers/admin/orders/index.php');
        break;
}
