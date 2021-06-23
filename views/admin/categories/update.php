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
                    <h1 class="m-0">Cập nhật danh mục</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
                        <li class="breadcrumb-item active">Cập nhật danh mục</li>
                        
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form id="create_product" action="./index.php?controller=admin&action=categories/update&id=<?php echo $id?>" method="POST" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Nhập</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                foreach ($arr_list_ct as $key => $value) { ?>
                                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="number" name="price" class="form-control input100" value="<?php echo $value['price'] ?>">
                                    </div>

                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                <?php };
                                ?>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.container-fluid -->
            <div class="row">
                <div class="col-12">
                    <a href="controller=admin&action=categories/index" class="btn btn-secondary">Hủy</a>
                    <input id="sub" type="submit" value="Cập nhật" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
</div>



<?php
include_once('./views/admin/footer.php')
?>