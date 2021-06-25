<?php
 $result = mysqli_query($conn, 'SELECT * FROM orders');
 $arr_orders = [];

 while ($row = mysqli_fetch_assoc($result)) {
     $arr_orders[] = $row;
 }

 include_once './views/admin/orders/index.php';
 mysqli_close($conn);
?>