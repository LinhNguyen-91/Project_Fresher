<?php
session_start();

// define('FODER_CHUA', dirname(__FILE__));
// $foder =FODER_CHUA;

$action = isset($_GET['action']) ? $_GET['action'] : 'user';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';

switch ($controller) {

    case 'admin';
        include_once './controllers/admin/admin.php';
        break;
    case 'products';
        include_once './controllers/admin/products/products.php';
        break;
    case 'categories';
        include_once './controllers/admin/categories/categories.php';
        break;
    case 'orders';
        include_once './controllers/admin/orders/orders.php';
        break;
    case 'orderitems';
        include_once './controllers/admin/orderitems/orderitems.php';
        break;
    default:
        include './controllers/customer.php';
        break;
}
