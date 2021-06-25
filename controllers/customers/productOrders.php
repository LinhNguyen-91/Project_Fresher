<?php
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
            $cancel = "<button class='btn btn-danger' onclick ='exit()' >Thoát</button>";
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

        $table .= '<tr><td data-th="Product">' .  $value['product'] . '</td>
            <td>' . $value['qty'] . '</td><td data-th="Price">' .
            number_format($value['price'], 0, ',', '.') . '<sup>đ</sup>
            </td><td data-th="">' . $status . '</td></tr>';
    }
    $table .= "<tr><td>" . $check . "</td><td>" . $cancel . "</td><th>Tổng :</th>
    <th id='data_sum' data=" . $sum . ">" . number_format($sum, 0, ',', '.') . "<sup>đ</sup> 
    </th></tr></br>";
}

echo $table;
die();
