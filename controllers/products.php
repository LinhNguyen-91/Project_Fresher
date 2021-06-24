<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');


switch ($action) {
    case 'create':

        $cate = mysqli_query($conn, "SELECT * FROM category");
        $cate_items = [];
        while ($row = mysqli_fetch_assoc($cate)) {
            $cate_items[] = $row;
        };
        include_once('./views/admin/products/create.php');
        break;
    case 'store':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name_pr = $_POST['name_product'];
            $price = $_POST['price'];

            $file = $_FILES['image']['tmp_name'];
            $path = "controllers/uploads/";
            $name = $_FILES['image']['name'];

            $image_url = $path . $name;
            $sql = "INSERT INTO products (name_product, image, price) VALUES ('$name_pr', '$image_url', '$price')";

            if (mysqli_query($conn, $sql)) {

                move_uploaded_file($file, $path . $name);
                
                header("Location: index.php?controller=products");
            } else {
                ?>
                <script>
                    alert("Có lỗi, vui lòng thử lại");
                    window.history.back();
                </script>
            <?php
            }
        }

        mysqli_close($conn);


        break;
    case 'edit':
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
        // 
        break;
    case 'update':

        $id = $_GET['id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name_product = $_POST['name_product'];
            $price = $_POST['price'];

            $file = $_FILES['image']['tmp_name'];
            $path = "controllers/uploads/";
            $name = $_FILES['image']['name'];


            $image_url = $path . $name;

            $sql = "UPDATE `products` SET `name_product`='$name_product',`image`='$image_url',`price`='$price' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                move_uploaded_file($file, $path . $name);
                  
                header("Location: index.php?controller=products");
            } else {
            ?>
                <script>
                    alert("Có lỗi, vui lòng thử lại <?php echo $conn->error ?>");
                    window.history.back();
                </script>
            <?php
            }
        };

        mysqli_close($conn);
        break;
    case 'delete';

        $id = $_GET['id'];
        $delete = mysqli_query($conn, "DELETE FROM products WHERE id = $id");

        if ($delete) {
            header("Location: index.php?controller=products");
            exit();
        } else { ?>
            <script>
                alert("Có lỗi, có thể sản phẩm vẫn còn được dùng, vui lòng kiểm tra lại.");
                window.history.back();
            </script>
        <?php }

        mysqli_close($conn);

        break;
    default:
        $result_pr = mysqli_query($conn, 'SELECT * FROM products');
        $items = [];
        while ($row = mysqli_fetch_assoc($result_pr)) {
            $items[] = $row;
        };

        mysqli_close($conn);
        include_once('./views/admin/products/index.php');
        break;
}

?>