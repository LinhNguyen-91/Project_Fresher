<?php
// header('Access-Control-Allow-Origin:http://localhost');

include_once '/var/www/html/Project/models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');
$id_order = isset($_GET['id_order']) ? $_GET['id_order'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$phone = isset($_GET['phone']) ? $_GET['phone'] : 0;

switch ($action) {
    case 'listproduct':
        $id = $_GET['id'];
        $sql = '';
        if ($id == 0) {
            $sql = "SELECT products.id as id, products.name_product as product,products.image as imag,category.price as price FROM products
        JOIN category
        ON products.price = category.id";
        } else {
            $sql = "SELECT products.id as id, products.name_product as product,products.image as imag,category.price as price FROM products
    JOIN category
    ON products.price = category.id WHERE products.price = $id";
        }

        $resutls = mysqli_query($conn, $sql);

        $items = [];
        while ($row = mysqli_fetch_assoc($resutls)) {
            $items[] = $row;
        }
        $html = '';
        foreach ($items as $key => $value) {
            $img = isset($value['imag']) ? $value['imag'] : 'controllers/uploads/hinh_mac_dinh.jpeg';
            $price =  number_format($value['price'], 0, ',', '.') . '<sup>đ</sup>';

            $html .= '<div class="col-md-4 col-sm-6 col-xs-12 pb-2 d-flex justify-content-center">';
            $html .=  '<div class="img-food">';
            $html .=           "<img class='thumb' src ='" . $img . "'>";
            $html .=         "<div class='title d-flex justify-content-center' style='color: black;'>";
            $html .=              "<b>" . $value['product'] . "</b>";

            $html .=         '</div>';
            $html .=          '<div class="bt-checkout d-flex justify-content-center">';
            $html .=              "<button type='button' id='' class='btn btn-success' onclick=' insertProduct(" . $value['id'] . ")'>" . $price . "</button>";
            $html .=           '</div>';
            $html .=     '</div>';
            $html .=   '</div>';
        }
        echo $html;
        break;
    case 'cancelorder':

        $sql = "UPDATE orders SET status = -1 WHERE id =$id_order";
        $resutls = mysqli_query($conn, $sql);

        if ($id_order) {
            setcookie('phone', $phone, time() - 2000, '/');
            setcookie('add', $add, time() - 2000, '/');
            setcookie('id_order', $add, time() - 2000, '/');
        }
        $return = [
            'status' => 'ok'
        ];
        echo json_encode($return);
        break;

    case 'deleteproduct':

        $sql = "DELETE FROM order_items WHERE id =$id";
        $resutls = mysqli_query($conn, $sql);
        $return = [
            'status' => 'ok'
        ];
        echo json_encode($return);

        break;

    case 'insert':
        $id_order = isset($_GET['id_order']) ? $_GET['id_order'] : 0;
        $id_product = isset($_GET['id_product']) ? $_GET['id_product'] : 0;

        $ql = "SELECT * FROM orders WHERE id = $id_order AND status = 0";
        $resu = mysqli_query($conn, $ql);

        $items = [];
        while ($row = mysqli_fetch_assoc($resu)) {
            $items[] = $row;
        }

        if (count($items) == 0) {

            setcookie('phone', $phone, time() - 2000, '/');
            setcookie('add', $add, time() - 2000, '/');
            setcookie('id_order', $add, time() - 2000, '/');
            $return = [
                'status' => 'login'
            ];
        } else {
            $sql = "INSERT INTO  order_items (id_order,id_product) VALUE ($id_order,$id_product)";
            $resutls = mysqli_query($conn, $sql);
            $return = [
                'status' => 'ok'
            ];
        }
        echo json_encode($return);
        die();
        break;

    case 'order':

        $sum = isset($_GET['sum']) ? $_GET['sum'] : 0;

        $sql = "UPDATE  orders SET status = 1, total = $sum   WHERE id =$id";
        $resutls = mysqli_query($conn, $sql);
        // if ($id_order) {
        //     setcookie('phone', $phone, time() - 2000, '/');
        //     setcookie('add', $add, time() - 2000, '/');
        //     setcookie('id_order', $add, time() - 2000, '/');
        // }

        $return = [
            'status' => 'ok'
        ];
        echo json_encode($return);
        die();
        break;
    case 'myorder':

        if ($phone) {
            $sql = "SELECT * FROM orders WHERE phone= $phone AND status >0 ORDER BY id desc";
            $resutls = mysqli_query($conn, $sql);
            $items = [];
            while ($row = mysqli_fetch_assoc($resutls)) {
                $items[] = $row;
            }

            $table = '';
            $status = '';
            foreach ($items as $key => $value) {
                $date = strtotime($value['date']);
                if ($value['status'] == 1) {
                    $status = 'Đang Giao';
                }
                if ($value['status'] == 2) {
                    $status = 'Hoàn Thành';
                }
                $table .= '<tr>';

                $table .= '<td>';
                $table .= ++$key;
                $table .= '</td>';

                $table .= '<td>';
                $table .=  $value['address'];
                $table .= '</td>';
                $table .= '<td>';
                $table .= date('d/m/Y', $date);
                $table .= '</td>';
                $table .= '<td>';
                $table .= $value['time'];
                $table .= '</td>';
                $table .= '<td>';
                $table .= number_format($value['total'], 0, ',', '.') . '<sup>đ</sup>';
                $table .= '</td>';
                $table .= '<td>';
                $table .=  $status;
                $table .= '</td>';
                $table .= '</tr>';
            }

            echo $table;
        }
        break;
    case 'category':

        if ($id_order) {
            $sql = "SELECT * FROM category";
            $resutls = mysqli_query($conn, $sql);
            $items = [];
            while ($row = mysqli_fetch_assoc($resutls)) {
                $items[] = $row;
            }
            $html = '<li><button onclick="listProduct(0)" class="btn btn-secondary">Tất cả</button></li>';
            foreach ($items as $key => $value) {
                $html .= "<li><button onclick='listProduct(" . $value['id'] . ")' class='btn btn-secondary'>" . $value['price'] . "</button></li>";
            }
            $html .= "<button class='btn btn-secondary' onclick='myOrder(" . $_COOKIE['phone'] . ")>Đơn Hàng Của Bạn</button>";
            echo $html;
        }
        break;
    case 'productorder':
        $sql2 = "SET GLOBAL sql_mode = (SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
        $resutls2 = mysqli_query($conn, $sql2);
        $sql = "SELECT order_items.id as id_order_items,
            products.id as id, 
            orders.status as status,
             order_items.id_product, 
             products.name_product as product,
              category.price as price,
               COUNT(id_product) as qty
                    FROM order_items
                     JOIN products
                     ON order_items.id_product = products.id 
                     JOIN category
                     ON products.price = category.id
                     JOIN orders
                     ON order_items.id_order = orders.id

                     WHERE order_items.id_order = $id_order
                     GROUP BY order_items.id_product";

        $resutls = mysqli_query($conn, $sql);

        $items = [];
        while ($row = mysqli_fetch_assoc($resutls)) {
            $items[] = $row;
        }

        $check = '<button onclick="order()" class="btn btn-success">Đặt</button>';
        $table = '';
        $sum = 0;
        $status = '';
        $cancel = "<button class='btn btn-warning' onclick = 'cancelOrder(" . $id_order . ")'>Hủy Đơn </button>";
        setcookie('check', 'true', time() + 1800, '/');

        if (count($items) == 0) {

            setcookie('check', 'true', time() - 2000, '/');
            $table = "<button class='btn btn-warning' onclick = 'cancelOrder(" . $id_order . ")'>Hủy Đơn </button>";
        } else {
            foreach ($items as $key => $value) {
                if ($value['status'] == 1) {
                    $status = 'Đang Giao';
                    $check = '';
                    $cancel = "<a class='btn btn-warning'  '>Thoát </a>";
                }
                if ($value['status'] == 0) {
                    $status = '<button class="btn btn-danger" onclick="deleteProduct(' . $value['id_order_items'] . ')" >Xóa</button>';
                }

                if ($value['status'] == 2) {
                    $status = 'Hoàn Thành';
                }
                $sum += $value['price'] * $value['qty'];


                if ($value['status']) {
                    setcookie('check', 'true', time() - 2000, '/');
                }
                $table .= '<tr>';
                $table .= '<td data-th="Product">';
                $table .= $value['product'];
                $table .= '</td>';
                $table .= '<td>';
                $table .= $value['qty'];
                $table .= '</td>';
                $table .= '<td data-th="Price">';
                $table .= number_format($value['price'], 0, ',', '.') . '<sup>đ</sup>';
                $table .= '</td>';
                $table .= '<td data-th="">';
                $table .= $status;
                $table .= '</td></tr>';
            }
            $table .= '<tr>';
            $table .= '<td>';
            $table .= $check;
            $table .= '</td>';
            $table .= '<td>';
            $table .= $cancel;
            $table .= '</td>';
            $table .= '<th>';
            $table .= 'Tổng :';
            $table .= '</th>';
            $table .= "<th id='data_sum' data=" . $sum . ">";
            $table .= number_format($sum, 0, ',', '.') . '<sup>đ</sup>';
            $table .= '</th>';
            $table .= '</tr>';
            $table .= '</br>';
        }

        echo $table;
        die();
        break;

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
