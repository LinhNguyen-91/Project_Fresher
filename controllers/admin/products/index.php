<?php
$result_pr = mysqli_query($conn, 'SELECT * FROM products');
$items = [];
while ($row = mysqli_fetch_assoc($result_pr)) {
    $items[] = $row;
};

mysqli_close($conn);
include_once('./views/admin/products/index.php');
