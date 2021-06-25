<?php
$id = $_GET['id'];
$name_product = $_POST['name_product'];
$price = $_POST['price'];

$file = $_FILES['image']['tmp_name'];
$path = "controllers/uploads/";
$name = $_FILES['image']['name'];


$image_url = $path . $name;

$sql = "UPDATE `products` SET `name_product`='$name_product',`image`='$image_url',`price`='$price' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    move_uploaded_file($file, $path . $name);

    header("Location: index.php?controller=products");
} else {
?>
    <script>
        alert("Có lỗi, vui lòng thử lại <?php echo $conn->error ?>");
        window.history.back();
    </script>
<?php

};

mysqli_close($conn);
?>