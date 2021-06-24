<?php

header('Access-Control-Allow-Origin: URL1');
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('FODER_CHUA', dirname(__FILE__));
include_once FODER_CHUA . '/models/connect.php';
$connect = new Connect();
$conn = $connect->connect();
mysqli_set_charset($conn, 'UTF8');
$phone = isset($_POST['phone']) ? $_POST['phone'] : 0;
$add = isset($_POST['add']) ? $_POST['add'] : 0;
$time = date("H:i:s");
$date = date("Y-m-d");
if ($phone != 0) {
     $sql = "INSERT INTO orders (phone,address,date,time,total,status) VALUE ('$phone','$add', '$date', '$time',0,0)";

     $sql2 = "SELECT * FROM orders ORDER BY id DESC LIMIT 1";
     $mysql = mysqli_query($conn, $sql);

     $resutls = mysqli_query($conn, $sql2);

     while ($row = mysqli_fetch_assoc($resutls)) {
          $items[] = $row;
     }
     $id = $items[0]['id'];

     setcookie('phone', $phone, time() + 1800, '/');
     setcookie('add', $add, time() + 1800, '/');
     setcookie('id_order', $id, time() + 1800, '/');
     $return = [
          'status' => 'ok'
     ];
     echo json_encode($return);
     die();
}
?>
<!DOCTYPE html>
<html>

<head>
     <title>Cơm Chiên Đồng Quê</title>
     <!-- custom-theme -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

     <script type="application/x-javascript">
          addEventListener("load", function() {
               setTimeout(hideURLbar, 0);
          }, false);

          function hideURLbar() {
               window.scrollTo(0, 1);
          }
     </script>
     <link rel="stylesheet" href="assets/login/css/style.css">
     <link href="assets/login/css/font-awesome.css" rel="stylesheet">
     <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
     <style>
          .error {
               color: red;
               font-style: italic;
               font-size: small;
          }
     </style>
</head>

<body>
     <div class="login-form w3_form">
          <!--  Title-->
          <div class="login-title w3_title">
               <h1>QUÁN CƠM ĐỒNG QUÊ</h1>
          </div>
          <div class="login w3_login">
               <h2 class="login-header w3_header">Nhập thông tin</h2>
               <div class="w3l_grid">
                    <form id="form-login" class="login-container" action="#" method="post">
                         <input type="number" placeholder="Số điện thoại" Name="phone" required="">
                         <input type="text" placeholder="Địa chỉ" Name="add" required="">
                         <input type="submit" value="Đặt món">
                    </form>
               </div>
          </div>

     </div>
     <div class="footer-w3l">
          <p class="agile"> &copy; 2017 Elegant Login Form . All Rights Reserved | Design by Nhat Linh</a></p>
     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

     <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.min.js"></script>
     <script>
          $(document).ready(function() {
               $("#form-login").validate({
                    rules: {
                         phone: {
                              required: true,
                              minlength: 10,
                              maxlength: 10
                         },
                         add: {
                              required: true,
                              minlength: 5
                         }
                    },
                    messages: {
                         phone: {
                              required: "Vui lòng nhập số điện thoại",
                              minlength: "Nhập số di động 10 số của bạn",
                              maxlength: "Nhập số di động 10 số của bạn",
                         },
                         add: {
                              required: "Vui lòng nhập địa chỉ ship đến",
                              minlength: "Vui lòng nhập đầy đủ địa chỉ"
                         }
                    },
                    submitHandler: function() {
                         var form_data = jQuery('#form-login').serialize();
                         var url = 'http://localhost/laravel/Project_Fresher/login.php';

                         jQuery.ajax({
                              url: url,
                              type: "post",
                              data: form_data,
                              dataType: 'json',
                              success: function(json) {
                                   if (json.status == 'ok') {
                                        window.location = './index.php?';
                                   }
                              }

                         });

                    }

               });
          });
     </script>
     <?php

     ?>
</body>

</html>