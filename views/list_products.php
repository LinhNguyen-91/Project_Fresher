<?php

if (!$_COOKIE['phone'] || !$_COOKIE['add']) {

    header('Location:login.php');
}

$id_order = isset($_GET['id_order']) ? $_GET['id_order'] : $_COOKIE['id_order'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Index</title>
</head>

<body>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="titlerestoran">
                    <div class="namerestoran" style="text-align:center">
                        <h3><b>Danh Sách Đơn Hàng</b></h3>
                    </div>

                </div>
                <div class="modal-body">
                    <div id="">
                        <table class="table table-hover">
                            <thead>
                                <tr class="col-lg-12">
                                    <th class="">STT</th>

                                    <th class="">Địa chỉ</th>
                                    <th class="">Ngày</th>
                                    <th class="">Giờ</th>
                                    <th class="">Tiền</th>

                                    <th class="">Status</th>
                                </tr>
                            </thead>
                            <tbody id="modalorder">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="p-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="banner-carouse text-white">
                    <div>
                        <h2>Chào Mừng <?= $_COOKIE['phone'] ?> </h2>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--  -->

    <section id="section-pd">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-8 col-md-8 col-sm-8 col-8">
                    <div class="demo w-100" style="border-radius:5px;width: 100%; height: 100%;  background-color:#dbdbdb">
                        <div class="list-row">
                            <ul class="d-flex flex-nowrap" style="padding-top:10px">
                                <li><button onclick="listProduct(0)" class="btn btn-secondary">Tất cả</button></li>
                                <div id='categogy'></div>
                                <?php foreach ($category as $key => $value) : ?>
                                    <li><button onclick="listProduct(<?= $value['id'] ?>)" class="btn btn-secondary"><?= number_format($value['price'], 0, ',', '.') . '<sup>đ</sup>' ?></button></li>
                                <?php endforeach; ?>
                                <button class="btn btn-secondary" onclick="myOrder(<?= $_COOKIE['phone'] ?>)">Đơn Hàng Của Bạn</button>
                            </ul>

                        </div>
                        <div>
                            <div class="d-flex justify-content-center">
                                <h4>Menu</h4>
                            </div>


                            <div class="p-2">
                                <div class="container">
                                    <div id='listproduct' class="row justify-content-center" style="overflow:auto;height:700px">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  -->

                </div>
                <div class="col-xs-4 col-md-4 col-sm-4 col-4">
                    <div class="bill w-100 rounded" style="background-color:#e9e9e9">
                        <div class="d-flex justify-content-center">
                            <h4>Món đã chọn</h4>
                        </div>
                        <div class="p-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="col-lg-12">
                                        <th class="">Món</th>
                                        <th class="">Số Lượng</th>
                                        <th class="">Giá</th>
                                        <th class="">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody id="bill-product">

                                </tbody>

                            </table>

                            <!--  -->
                            <div class="line-border" style="width: 100%; height:2px; background-color:black"></div>
                            <i>Quán cơm Đồng Quê kính chào quý khách !</i> </br>
                            <i>Địa chỉ:28 Lý Thường Kiệt - TP Huế</i></br>
                            <b><i>Miễn phí ship nội thành. Hân hạnh được đón tiếp.</i></b>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <!-- Footer -->
    <footer class="page-footer font-small mdb-color lighten-3 pt-4">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="background-color: #a0a2a5;">© 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/"> MDBootstrap.com</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <!--  -->

    <!--  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./assets/js/listproduct.js"> </script>
    <script>
        var id_order = <?= $id_order ?>;
        var add = '<?= $_COOKIE['add'] ?>';
        productsOrder();
        listProduct(0);
        setInterval(productsOrder, 30000);
    </script>


</body>

</html>