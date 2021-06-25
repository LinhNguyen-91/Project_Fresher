<?php
 $id = $_GET['id'];
 $get_pr = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");


 $items_pr = [];
 while ($row = mysqli_fetch_assoc($get_pr)) {
     $items_pr[] = $row;
 };
 //
 $cate = mysqli_query($conn, "SELECT * FROM category");
 $cate_items = [];
 while ($row = mysqli_fetch_assoc($cate)) {
     $cate_items[] = $row;
 };
 include_once('./views/admin/products/update.php');
 ?>