<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'create';
        include_once('./views/admin/categories/create.php');
        break;

    case 'store';
        $price = $_POST['price'];
        //Code xử lý, insert dữ liệu vào table
        $sql = "INSERT INTO category (price) VALUES ('$price')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?controller=categories");
            exit();
        } else {
        ?>
            <script>
                alert("Có lỗi, vui lòng thử lại");
                window.history.back();
            </script>
        <?php
        }

        mysqli_close($conn);

        break;
    case 'edit':

        $id = $_GET['id'];
        $get_ct = mysqli_query($conn, "SELECT * FROM category WHERE id = '$id'");
        $arr_list_ct = [];

        while ($row = mysqli_fetch_assoc($get_ct)) {
            $arr_list_ct[] = $row;
        }

        include_once('./views/admin/categories/update.php');
        break;
    case 'update';

        $id = $_GET['id'];
        $price = $_POST['price'];

        $sql = "UPDATE `category` SET `price`='$price' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?controller=categories");
        } else {
        ?>
            <script>
                alert("Có lỗi, vui lòng thử lại");
                window.history.back();
            </script>

<?php
        }


        mysqli_close($conn);

        break;
    case 'delete';
    default:

        $list_cate = mysqli_query($conn, 'SELECT * FROM category');
        $arr_cate = [];

        while ($row = mysqli_fetch_assoc($list_cate)) {
            $arr_cate[] = $row;
        }
        mysqli_close($conn);

        include_once('./views/admin/categories/index.php');
        break;
}

?>