<?php
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id_order = isset($_GET['id_order']) ? $_GET['id_order'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$phone = isset($_GET['phone']) ? $_GET['phone'] : 0;


switch ($action) {

    case 'listproduct':
        include_once './controllers/customers/listProducts.php';

        break;

    case 'cancelorder':
        include_once './controllers/customers/cancelOrder.php';

        break;

    case 'deleteproduct':
        include_once './controllers/customers/deleteProduct.php';

        break;

    case 'insert':
        include_once './controllers/customers/insertProduct.php';

        break;

    case 'order':
        include_once './controllers/customers/order.php';

        break;

    case 'myorder':
        include_once './controllers/customers/myOrders.php';


        break;


    case 'productorder':
        include_once './controllers/customers/productOrders.php';

        break;
    case 'exit';
        include_once './controllers/customers/exit.php';

    default:

        $sql = "SELECT * FROM category";
        $resutls = mysqli_query($conn, $sql);

        $category = [];
        while ($row = mysqli_fetch_assoc($resutls)) {
            $category[] = $row;
        }

        include_once './views/list_products.php';
        break;
}
