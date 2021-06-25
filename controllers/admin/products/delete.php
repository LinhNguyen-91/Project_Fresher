<?php
$id = $_GET['id'];
$delete = mysqli_query($conn, "DELETE FROM products WHERE id = $id");

if ($delete) {
    header("Location: index.php?controller=products");
    exit();
} else { ?>
    <script>
        alert("Có lỗi, có thể sản phẩm vẫn còn được dùng, vui lòng kiểm tra lại.");
        window.history.back();
    </script>
<?php }

mysqli_close($conn);
?>