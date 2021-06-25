<?php
 $sql = "UPDATE orders SET status = -1 WHERE id =$id_order";
        $resutls = mysqli_query($conn, $sql);

            setcookie('phone', '', time() - 2000, '/');
            setcookie('add', '', time() - 2000, '/');
            setcookie('id_order', '', time() - 2000, '/');
            
        $return = [
            'status' => 'ok'
        ];
        echo json_encode($return);
       