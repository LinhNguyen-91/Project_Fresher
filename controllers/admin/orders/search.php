<?php
$dateBegin = $_POST['datebegin'];
if ($dateBegin == 0) {
    $dateBegin = '2020-01-01';
}
$dateEnd = $_POST['dateend'];
if ($dateEnd == 0) {
    $dateEnd = date('Y-m-d');
}

$phone = $_POST['phone'];
$sql = " SELECT * FROM orders WHERE date >= '$dateBegin' AND date <= '$dateEnd' AND phone like '%$phone%'";
$result = mysqli_query($conn, $sql);

$arr_orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $arr_orders[] = $row;
}

include_once './views/admin/orders/search.php';
mysqli_close($conn);
?>