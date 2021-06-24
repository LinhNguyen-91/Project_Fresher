<?php
session_start();
<<<<<<< HEAD
$id_order_begin =0;
// define('FODER_CHUA', dirname(__FILE__));
// $foder =FODER_CHUA;

=======
>>>>>>> 2268b672e8a4ff0e7efb2aab540e5080ecce1fc4
$action = isset($_GET['action']) ? $_GET['action'] : 'user';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$id_order =0;
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
