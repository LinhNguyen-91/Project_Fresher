<?php
 $sql = "UPDATE orders SET status = -1 WHERE id =$id_order";
        $resutls = mysqli_query($conn, $sql);

        if ($id_order) {
            setcookie('phone', $phone, time() - 2000, '/');
            setcookie('add', $add, time() - 2000, '/');
            setcookie('id_order', $add, time() - 2000, '/');
        }
        $return = [
            'status' => 'ok'
        ];
        echo json_encode($return);
       