<?php 
$id_order = isset($_GET['id_order']) ? $_GET['id_order'] : 0;
$id_product = isset($_GET['id_product']) ? $_GET['id_product'] : 0;

$ql = "SELECT * FROM orders WHERE id = $id_order AND status = 0";
$resu = mysqli_query($conn, $ql);

$items = [];
while ($row = mysqli_fetch_assoc($resu)) {
    $items[] = $row;
}

if (count($items) == 0) {

   
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