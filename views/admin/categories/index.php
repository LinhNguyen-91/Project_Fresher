<?php
if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once('./views/admin/path.php');
include_once('./views/admin/header.php');
include_once('./views/admin/sidebar.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách danh mục</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                                        <th>Giá</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    <?php
                                    foreach ($arr_cate as $key => $value) { ?>
                                        <tr style="text-align: center;">
                                            <td><?php echo $value['id'] ?></td>
                                            <td><?php echo $value['price'] ?></td>
                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="index.php?controller=categories&action=edit&id=<?php echo $value['id']  ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                    <a class="btn btn-danger" onclick="deleteItems(<?php echo $value['id'] ?>)"><i class="fas fa-trash"></i></a>
                                                    <script>
                                                        function deleteItems(id) {
                                                            if (confirm("Bạn có chắc xóa danh mục này?")) {
                                                                window.location.href = "index.php?controller=categories&action=delete&id=" + id;
                                                            } else {
                                                                exit();
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php  } ?>

                                    <!--  -->
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
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