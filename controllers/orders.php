<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'search';
        $dateBegin = $_POST['datebegin'];
        if ($dateBegin == 0){
            $dateBegin = '2020-01-01';
        }
        $dateEnd = $_POST['dateend'];
        if ($dateEnd == 0){
            $dateEnd = date('Y-m-d');
        }
       
        $phone = $_POST['phone'];
        $sql = " SELECT * FROM orders WHERE date >= '$dateBegin' AND date <= '$dateEnd' AND phone like '%$phone%'";
        $result = mysqli_query($conn, $sql);

        $arr_orders = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $arr_orders[] = $row;
        }

        include_once './views/admin/orders/show.php';
        mysqli_close($conn);
        break;
   
    default:
    $result = mysqli_query($conn, 'SELECT * FROM orders');
    $arr_orders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $arr_orders[] = $row;
    }

    include_once './views/admin/orders/index.php';
    mysqli_close($conn);
        break;
}
