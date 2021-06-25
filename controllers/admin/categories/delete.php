<?php
$id = $_GET['id'];
$delete = mysqli_query($conn, "DELETE FROM category WHERE id = $id");

if ($delete) {
    header("Location: index.php?controller=categories");
    exit();
} else { ?>
    <script>
        alert("Có lỗi, có thể danh mục vẫn còn được dùng, vui lòng kiểm tra lại.");
        window.history.back();
    </script>
<?php }

mysqli_close($conn);
?>