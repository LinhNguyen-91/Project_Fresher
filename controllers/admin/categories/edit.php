<?php
$id = $_GET['id'];
$get_ct = mysqli_query($conn, "SELECT * FROM category WHERE id = '$id'");
$arr_list_ct = [];

while ($row = mysqli_fetch_assoc($get_ct)) {
    $arr_list_ct[] = $row;
}

include_once('./views/admin/categories/update.php');
?>