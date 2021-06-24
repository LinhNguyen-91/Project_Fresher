<?php
if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
$connect = new Connect();
$conn = $connect->connect();
include_once('./views/admin/header.php');
include_once('./views/admin/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách món ăn</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?controller=admin">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách món ăn</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-primary text-center">
                                        <th>ID</th>
                                        <th>Tên món ăn</th>
                                        <th>Ảnh</th>
                                        <th>Giá</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    <?php
                                    foreach ($items as $key => $value) { ?>
                                        <tr style="text-align: center;">
                                            <td><?php echo $value['id'] ?></td>
                                            <td><?php echo $value['name_product'] ?></td>
                                            <td>
                                                <img src="<?php echo $value['image'] ?>" alt="" height="110" width="110">
                                            </td>
                                            <td><?php
                                                $id_price = $value['price'];
                                                $price = mysqli_query($conn, "SELECT * FROM category WHERE id = $id_price");
                                                while ($row = mysqli_fetch_assoc($price)) {
                                                    echo number_format($row['price'], 0, '.', '.');
                                                }
                                                ?></td>
                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="index.php?controller=products&action=edit&id=<?php echo $value['id']  ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                    <a class="btn btn-danger" onclick="deleteItems(<?php echo $value['id'] ?>)"><i class="fas fa-trash"></i></a>
                                                    <script>
                                                        function deleteItems(id) {
                                                            if (confirm("Bạn có chắc xóa sản phẩm này?")) {
                                                                window.location.href = "index.php?controller=products&action=delete&id=" + id;
                                                            } else {
                                                                exit();
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }

                                    ?>
                                    <!--  -->
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Tên món ăn</th>
                                        <th>Ảnh</th>
                                        <th>Giá</th>
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
include_once('./views/admin/footer.php')
?>