<?php
if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once('./views/admin/header.php');
include_once('./views/admin/sidebar.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Chi tiết hóa đơn</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item">Hóa đơn</li>
                        <li class="breadcrumb-item active">Chi tiết hóa đơn</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chi tiết hóa đơn của</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-order d-flex flex-row">
                                <div class="col-md-6">
                                    <table class="table table-bordered tabler-hover">
                                        <thead>
                                            <?php foreach ($arr_fetch as $key => $value) { ?>
                                                <tr>
                                                    <th>Số điện thoại</th>
                                                    <th><?php echo $value['phone'] ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Ngày/giờ</th>
                                                    <th><?php echo $value['date'] . '/' . $value['time'] ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Địa chỉ</th>
                                                    <th><?php echo $value['address'] ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Tình trạng</th>
                                                    <th><?php if ($value['status'] == 0) {
                                                            echo "Not shipped";
                                                        } else {
                                                            echo "Shipped";
                                                        }  ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Tổng giá</th>
                                                    <th><?php echo number_format($value['total'], 0, ',', '.') . '<sup>đ</sup>' ?></th>
                                                </tr>
                                            <?php } ?>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="post">
                                        <div class="row" style="margin-bottom:40px">
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <label>Tình trạng</label>
                                                    <select type="text" name="status" class="form-control">
                                                        <option value="0">Chưa giao</option>
                                                        <option value="1">Đã giao</option>
                                                    </select>
                                                </div>
                                                <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-primary text-center">
                                        <th>ID</th>
                                        <th>ID hóa đơn</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arr_fetch_details as $key => $value) { ?>
                                        <tr style="text-align: center;">
                                            <td><?php echo $value['id'] ?></td>
                                            <td><?php echo $value['id_order'] ?></td>
                                            <td><?php
                                                $id_pr = $value['id_product'];
                                                $product_name = mysqli_query($conn, "SELECT * FROM products WHERE id = $id_pr");
                                                while ($pr = mysqli_fetch_array($product_name)) {
                                                    echo $pr['name_product'];
                                                };
                                                ?>
                                            </td>
                                            <td><?php echo $value['notes'] ?></td>

                                        </tr>
                                    <?php } ?>


                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>ID hóa đơn</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?php
include_once('./views/admin/footer.php')
?>