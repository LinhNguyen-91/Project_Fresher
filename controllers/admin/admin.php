<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once './models/connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'erro';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');

switch ($action) {
    
    case 'login';

        if ($_SESSION['username']) {
            header("Location: ./index.php?controller=admin");
        }

        include_once('./views/login.php');

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
        

        break;
    case 'logout';
        unset($_SESSION['username']);
        header("Location: index.php?controller=admin&action=login");

        break;
    default:

        $count_pr = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM products");
        $count_orders = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM orders");
        $total_price = mysqli_query($conn, "SELECT SUM(total) AS 'total' FROM orders WHERE status = '2'");
        $row_pr = mysqli_fetch_assoc($count_pr);
        $row_orders = mysqli_fetch_assoc($count_orders);
        $row_total = mysqli_fetch_assoc($total_price);

        include_once './views/admin/admin.php';
        break;
}
