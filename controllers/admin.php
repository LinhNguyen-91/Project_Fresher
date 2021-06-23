<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');

switch ($action) {
    case 'products/index':

        $result_pr = mysqli_query($conn, 'SELECT * FROM products');
        $items = [];
        while ($row = mysqli_fetch_assoc($result_pr)) {
            $items[] = $row;
        };

        mysqli_close($conn);
        include_once('./views/admin/products/index.php');
        break;
    case 'products/create':

        $cate = mysqli_query($conn, "SELECT * FROM category");
        $cate_items = [];
        while ($row = mysqli_fetch_assoc($cate)) {
            $cate_items[] = $row;
        };
        include_once('./views/admin/products/create.php');
        break;
    case 'products/store':

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name_pr = $_POST['name_product'];
            $price = $_POST['price'];

            $file = $_FILES['image']['tmp_name'];
            $path = "controllers/uploads/";
            $name = $_FILES['image']['name'];

            $image_url = $path . $name;
            $sql = "INSERT INTO products (name_product, image, price) VALUES ('$name_pr', '$image_url', '$price')";

            if (mysqli_query($conn, $sql)) {

                if (move_uploaded_file($file, $path . $name)) {
                    echo "Tải tập tin thành công";
                } else {
                    echo "Tải tập tin thất bại";
                }
                header("Location: index.php?controller=admin&action=products/index");
            } else {
?>
                <script>
                    alert("Có lỗi, vui lòng thử lại");
                    window.history.back();
                </script>
                <!-- $error = $conn->error; -->
            <?php
            }
        }

        mysqli_close($conn);


        break;
    case 'products/edit':
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
    case 'products/update':

        $id = $_GET['id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name_product = $_POST['name_product'];
            $price = $_POST['price'];

            $file = $_FILES['image']['tmp_name'];
            $path = "controllers/uploads/";
            $name = $_FILES['image']['name'];

            if (move_uploaded_file($file, $path . $name)) {
                echo "Tải tập tin thành công";
            } else {
                echo "Tải tập tin thất bại";
            }
            $image_url = $path . $name;

            $sql = "UPDATE `products` SET `name_product`='$name_product',`image`='$image_url',`price`='$price' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?controller=admin&action=products/index");
            } else {
            ?>
                <script>
                    alert("Có lỗi, vui lòng thử lại <?php echo $conn->error ?>");
                    window.history.back();
                </script>
                <!-- $error = $conn->error; -->
            <?php
            }
        };

        mysqli_close($conn);
        break;
    case 'products/delete';

        $id = $_GET['id'];
        $delete = mysqli_query($conn, "DELETE FROM products WHERE id = $id");

        if ($delete) {
            header("Location: index.php?controller=admin&action=products/index");
            exit();
        } else { ?>
            <script>
                alert("Có lỗi, có thể sản phẩm vẫn còn được dùng, vui lòng kiểm tra lại.");
                window.history.back();
            </script>
            <!-- $error = $conn->error; -->
            <?php }

        mysqli_close($conn);

        break;
    case 'categories/index';

        $list_cate = mysqli_query($conn, 'SELECT * FROM category');
        $arr_cate = [];

        while ($row = mysqli_fetch_assoc($list_cate)) {
            $arr_cate[] = $row;
        }
        mysqli_close($conn);

        include_once('./views/admin/categories/index.php');
        break;

    case 'categories/create';
        include_once('./views/admin/categories/create.php');
        break;

    case 'categories/store';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["price"])) {
                $price = $_POST['price'];
            }

            //Code xử lý, insert dữ liệu vào table
            $sql = "INSERT INTO category (price) VALUES ('$price')";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?controller=admin&action=categories/index");
                exit();
            } else {
            ?>
                <script>
                    alert("Có lỗi, vui lòng thử lại");
                    window.history.back();
                </script>
                <!-- $error = $conn->error; -->
            <?php
            }
        }

        mysqli_close($conn);

        break;
    case 'categories/edit':

        $id = $_GET['id'];
        $get_ct = mysqli_query($conn, "SELECT * FROM category WHERE id = '$id'");
        $arr_list_ct = [];

        while ($row = mysqli_fetch_assoc($get_ct)) {
            $arr_list_ct[] = $row;
        }

        include_once('./views/admin/categories/update.php');
        break;
    case 'categories/update';

        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['price'])) {
                $price = $_POST['price'];
            }

            $sql = "UPDATE `category` SET `price`='$price' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?controller=admin&action=categories/index");
            } else {
            ?>
                <script>
                    alert("Có lỗi, vui lòng thử lại");
                    window.history.back();
                </script>
                <!-- $error = $conn->error; -->
            <?php
            }
        }

        mysqli_close($conn);

        break;
    case 'categories/delete';
        $id = $_GET['id'];
        $delete = mysqli_query($conn, "DELETE FROM category WHERE id = $id");

        if ($delete) {
            header("Location: index.php?controller=admin&action=categories/index");
            exit();
        } else { { ?>
                <script>
                    alert("Có lỗi, có thể danh mục này vẫn được sử dụng, vui lòng kiểm tra lại.");
                    window.history.back();
                </script>
                <!-- $error = $conn->error; -->
<?php }
        }

        mysqli_close($conn);

        break;
    case 'orders/search';
        $dateBegin = $_POST['datebegin'];
        if ($dateBegin == 0){
            $dateBegin = '2020-01-01';
        }
        $dateEnd = $_POST['dateend'];
        if ($dateEnd == 0){
            $dateEnd = date('Y-m-d');
        }
       
        $phone = $_POST['phone'];
        $sql = " SELECT * FROM orders WHERE date >= '$dateBegin' AND date <= '$dateEnd' AND phone like '%$phone%'";
        // $sql = "SELECT * FROM orders WHERE phone like '%$phone%'";
        $result = mysqli_query($conn, $sql);

        $arr_orders = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $arr_orders[] = $row;
        }

        include_once './views/admin/orders/show.php';
        mysqli_close($conn);
        break;
    case 'orders/index';

        $result = mysqli_query($conn, 'SELECT * FROM orders');
        $arr_orders = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $arr_orders[] = $row;
        }

        include_once './views/admin/orders/index.php';
        mysqli_close($conn);
        break;
    case 'orderitems/order';
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

            header("Location: index.php?controller=admin&action=orderitems/order&id=$id");
        }


        include_once './views/admin/orderitems/index.php';
        mysqli_close($conn);
        break;
    case 'login';

        if ($_SESSION['username']) {
            header("Location: ./index.php?controller=admin");
        }

        include_once('./views/login.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);


            if (!$username || !$password) {
                echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
                exit;
            }


            $query = mysqli_query($conn, "SELECT username, password FROM users WHERE username='$username'");
            if (mysqli_num_rows($query) == 0) {
                echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.";
                exit;
            }

            $row = mysqli_fetch_array($query);


            if ($row['password'] != $password) {
                echo "Mật khẩu không đúng. Vui lòng nhập lại.";
                exit;
            }

            $_SESSION['username'] = $username;
            header("Location: ./index.php?controller=admin");
        }

        break;
    case 'logout';
        unset($_SESSION['username']);
        header("Location: index.php?controller=admin&action=login");

        break;
    default:

        $count_pr = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM products");
        $count_orders = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM orders");
        $total_price = mysqli_query($conn, "SELECT SUM(total) AS 'total' FROM orders WHERE status = '1'");
        $row_pr = mysqli_fetch_assoc($count_pr);
        $row_orders = mysqli_fetch_assoc($count_orders);
        $row_total = mysqli_fetch_assoc($total_price);

        include_once './views/admin/admin.php';
        break;
}
