<?php 
 $sum = isset($_GET['sum']) ? $_GET['sum'] : 0;
 $sql = "UPDATE  orders SET status = 1, total = $sum   WHERE id =$id";
 $resutls = mysqli_query($conn, $sql);
 $return = [
     'status' => 'ok'
 ];
 echo json_encode($return);
 die();