<?php
session_start();

// define('FODER_CHUA', dirname(__FILE__));
// $foder =FODER_CHUA;

$action = isset($_GET['action']) ? $_GET['action'] : 'user';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';

switch ($controller) {

    case 'admin';
   
        include './controllers/admin.php';
        break;
        
        case 'products';
        include './controllers/products.php';
        break;
    case 'categories';
        include './controllers/categories.php';
        break;
    case 'orders';
        include './controllers/orders.php';
        break;
    case 'orderitems';
        include './controllers/orderitems.php';
        break;
    default:
        include './controllers/customer.php';
        break;
}

?>

