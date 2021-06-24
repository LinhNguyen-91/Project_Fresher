<?php
session_start();
$id_order_begin =0;
// define('FODER_CHUA', dirname(__FILE__));
// $foder =FODER_CHUA;

$action = isset($_GET['action']) ? $_GET['action'] : 'user';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$id_order =0;
switch ($controller) {

    case 'admin';
   
        include './controllers/admin.php';
        break;

    default:
    
        include './controllers/customer.php';
        break;
}

?>

