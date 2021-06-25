<?php
 $name_pr = $_POST['name_product'];
 $price = $_POST['price'];

 $file = $_FILES['image']['tmp_name'];
 $path = "controllers/uploads/";
 $name = $_FILES['image']['name'];

 $image_url = $path . $name;
 $sql = "INSERT INTO products (name_product, image, price) VALUES ('$name_pr', '$image_url', '$price')";

 if (mysqli_query($conn, $sql)) {

     move_uploaded_file($file, $path . $name);

     header("Location: index.php?controller=products");
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