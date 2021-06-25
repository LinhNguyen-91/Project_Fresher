<?php
$cate = mysqli_query($conn, "SELECT * FROM category");
$cate_items = [];
while ($row = mysqli_fetch_assoc($cate)) {
    $cate_items[] = $row;
};
include_once('./views/admin/products/create.php');
