<?php
  $id =  $_GET['id'];
  $result_orders = mysqli_query($conn, "SELECT * FROM orders WHERE id = $id");
  $result_details = mysqli_query($conn, "SELECT * FROM order_items WHERE id_order = '$id'");
  $arr_fetch = [];
  $arr_fetch_details = [];
  $avc = [];

  while ($row = mysqli_fetch_assoc($result_orders)) {
      $arr_fetch[] = $row;
  }

  while ($row = mysqli_fetch_assoc($result_details)) {
      $arr_fetch_details[] = $row;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['status'])) {
          $status = $_POST['status'];
      };

      $sql = mysqli_query($conn, "UPDATE orders SET `status` = $status WHERE id = $id");

      header("Location: index.php?controller=orderitems&action=order&id=$id");
  }

  mysqli_close($conn);
  include_once './views/admin/orderitems/index.php';
?>
