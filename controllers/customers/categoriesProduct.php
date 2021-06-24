<?php 
 $sql = "SELECT * FROM category";
 $resutls = mysqli_query($conn, $sql);
 $items = [];
 while ($row = mysqli_fetch_assoc($resutls)) {
     $items[] = $row;
 }
 $html = '<li><button onclick="listProduct(0)" class="btn btn-secondary">Tất cả</button></li>';
 foreach ($items as $key => $value) {
     $html .= "<li><button onclick='listProduct(" . $value['id'] . ")' class='btn btn-secondary'>" . $value['price'] . "</button></li>";
 }
 $html .= "<button class='btn btn-secondary' onclick='myOrder(" . $_COOKIE['phone'] . ")>Đơn Hàng Của Bạn</button>";
 echo $html;
