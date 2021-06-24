<?php 
 setcookie('phone', $phone, time() - 2000, '/');
 setcookie('add', $add, time() - 2000, '/');
 setcookie('id_order', $add, time() - 2000, '/');
 $return = [
     'status' => 'ok'
 ];
 echo json_encode($return);
 die();