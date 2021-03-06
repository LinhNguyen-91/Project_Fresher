<?php
;
if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once('./views/masterpage/admin/path.php');
include_once('./views/masterpage/admin/header.php');
include_once('./views/masterpage/admin/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách hóa đơn</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách hóa đơn</li>
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
                       <div class ="col-sm-12">
                       <form action= "index.php?controller=orders&action=search" method = "POST">
                       Từ : <input name ="datebegin" type ="date"/> đến 
                       <input name="dateend" type ="date"/>
                       <input type="number" name="phone" placeholder="Nhập số điện thoại"/>
                       <input class="btn btn-primary" type ="submit" value = "Tìm"/>
                       <a href ="index.php?controller=orders&action=index"class="btn btn-primary">Hủy</a>
                       </form>
                       </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-primary text-center">
                                        <th>ID</th>
                                        <th>Số ĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày</th>
                                        <th>Giờ</th>
                                        <th>Tổng giá</th>
                                        <th>Tình trạng</th>
                                        <th>Ghi chú</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    <?php
                                    foreach ($arr_orders as $key => $value) { 
                                        if ($value['status'] < 0) {
                                            $status = 'Đã Hủy';
                                        }
                                        if ($value['status'] == 0) {
                                            $status = 'Chờ xác nhận';
                                        }
                                        if ($value['status'] == 1) {
                                            $status = 'Đang Giao';
                                        }
                                        if ($value['status'] == 2) {
                                            $status = 'Hoàn Thành';
                                        }
                                        ?>
                                   
                                        <tr style="text-align: center;">
                                            <td><?php echo $value['id'] ?></td>
                                            <th><?php echo $value['phone'] ?></th>
                                            <th><?php echo $value['address'] ?></th>
                                            <th><?php echo $value['date'] ?></th>
                                            <th><?php echo $value['time'] ?></th>
                                            <td><?php echo $value['total'] ?></td>
                                            <td><?php 
                                                    echo $status;
                                             
                                                 ?></td>
                                            <td><?php echo $row['notes'] ?></td>
                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="index.php?controller=orderitems&action=order&id=<?php echo $value['id'] ?>" class="btn btn-info"><i class="fas fa-info"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>

                                    <!--  -->
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Số ĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày</th>
                                        <th>Giờ</th>
                                        <th>Tổng giá</th>
                                        <th>Tình trạng</th>
                                        <th>Ghi chú</th>
                                        <th>Tùy chọn</th>
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
include_once('./views/masterpage/admin/footer.php')
?>