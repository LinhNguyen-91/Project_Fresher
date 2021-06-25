<?php
$id = $_GET['id'];
$price = $_POST['price'];

$sql = "UPDATE `category` SET `price`='$price' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?controller=categories");
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