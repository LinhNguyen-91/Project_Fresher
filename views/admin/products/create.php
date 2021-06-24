<?php
if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once ('./views/admin/path.php');
include_once ('./views/admin/header.php');
include_once ('./views/admin/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm Món</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang Chú</a></li>
                        <li class="breadcrumb-item"><a href="#">Món Ăn</a></li>
                        <li class="breadcrumb-item active">Thêm Mới</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form id="create_product" action="./index.php?controller=products&action=store" method="POST" enctype="multipart/form-data">
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
                           
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="name_product" class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label></label>
                                </div>
                                <div class="form-group d-flex">
                                    <input type="file" name="image" id="img" placeholder ="Chọn hình ảnh">
                                </div>
                                <!--  -->
                                <div class="form-group">
                                    <label>Giá </label>
                                </div>
                                <div class="form-group">
                                    <select name="price" id="price">
                                        <?php
                                        foreach ($cate_items as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo number_format($value['price'], 0, '.', '.') ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                               
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
                    <a href="./index.php?controller=products" class="btn btn-secondary">Hủy</a>
                    <input id="sub" type="submit" value="Thêm mới" class="btn btn-success float-right">
                </div>
            </div>
        </form>

    </section>
</div>

<?php
include_once ('./views/admin/footer.php')
?>
