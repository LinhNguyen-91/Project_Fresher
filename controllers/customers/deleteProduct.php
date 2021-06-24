<?php 
 $sql = "DELETE FROM order_items WHERE id =$id";
 $resutls = mysqli_query($conn, $sql);
 $return = [
     'status' => 'ok'
 ];
 echo json_encode($return);