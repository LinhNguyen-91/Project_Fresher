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

    default:
    
        include './controllers/customer.php';
        break;
}

?>

