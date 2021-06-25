<?php
$price = $_POST['price'];
//Code xử lý, insert dữ liệu vào table
$sql = "INSERT INTO category (price) VALUES ('$price')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?controller=categories");
    exit();
} else {
?>
    <script>
        alert("Có lỗi, vui lòng thử lại");
        window.history.back();
    </script>
<?php
}

mysqli_close($conn);
?>