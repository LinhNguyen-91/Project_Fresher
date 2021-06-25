<?php
    $list_cate = mysqli_query($conn, 'SELECT * FROM category');
    $arr_cate = [];

    while ($row = mysqli_fetch_assoc($list_cate)) {
        $arr_cate[] = $row;
    }
    mysqli_close($conn);

    include_once('./views/admin/categories/index.php');
    ?>