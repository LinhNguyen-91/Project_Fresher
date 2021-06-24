<?php 
 $id = $_GET['id'];
        $sql = '';

        if ($id == 0) {
            $sql = "SELECT products.id as id, products.name_product as product,products.image as imag,category.price as price FROM products
                    JOIN category
                    ON products.price = category.id";
        } else {
            $sql = "SELECT products.id as id, products.name_product as product,products.image as imag,category.price as price FROM products
                    JOIN category
                     ON products.price = category.id WHERE products.price = $id";
        }

        $resutls = mysqli_query($conn, $sql);

        $items = [];
        while ($row = mysqli_fetch_assoc($resutls)) {
            $items[] = $row;
        }
        $html = '';
        foreach ($items as $key => $value) {
            $img = isset($value['imag']) ? $value['imag'] : 'controllers/uploads/hinh_mac_dinh.jpeg';
            $price =  number_format($value['price'], 0, ',', '.') . '<sup>đ</sup>';

            $html .= '<div class="col-md-4 col-sm-6 col-xs-12 pb-2 d-flex justify-content-center">';
            $html .=  '<div class="img-food">';
            $html .=           "<img class='thumb' src ='" . $img . "'>";
            $html .=         "<div class='title d-flex justify-content-center' style='color: black;'>";
            $html .=              "<b>" . $value['product'] . "</b>";

            $html .=         '</div>';
            $html .=          '<div class="bt-checkout d-flex justify-content-center">';
            $html .=              "<button type='button' id='' class='btn btn-success' onclick=' insertProduct(" . $value['id'] . ")'>" . $price . "</button>";
            $html .=           '</div>';
            $html .=     '</div>';
            $html .=   '</div>';
        }
        echo $html;
?>