function cancelOrder(id_order) {
    let confi = confirm('Bạn muốn hủy đơn hàng?');
    if (confi) {

        jQuery.ajax({
            url: './index.php?action=cancelorder',
            data: {
                id_order: id_order,
            },
            type: "GET",
            dataType: 'json',
            success: function (json) {
                if (json.status == 'ok') {
                    window.location = './login.php';
                }
            }
        });
    }
}
function myOrder(phone) {
    $('#modal').modal('show');

    jQuery.ajax({
        url: './index.php?action=myorder',
        data: {
            phone: phone,
        },
        type: "GET",
        success: function (html) {
            $("#modalorder").html(html);
        }
    });
}
function listProduct(id) {

    jQuery.ajax({
        url: './index.php?action=listproduct',
        data: {
            id: id,
        },
        type: "GET",
        success: function (html) {
            $("#listproduct").html(html);
        },
    
    });
}
function insertProduct(id) {

    jQuery.ajax({
        url: './index.php?action=insert',
        data: {

            id_order: id_order,
            id_product: id,
        },
        type: "GET",
        dataType: 'json',
        success: function (json) {
            if (json.status == 'ok') {
               
                productsOrder();
            } else {
                window.location = './login.php';
            }
        }
    });
}
function order() {
    let dataSum = $('#data_sum').attr('data');

    let confi = confirm('Bạn có muốn đặt món và giao đến ' + add + '?');
    if (confi) {

        jQuery.ajax({
            url: './index.php?action=order',
            data: {
                id: id_order,
                sum: dataSum,
            },
            type: "GET",
            dataType: 'json',
            success: function (json) {
                let status = json.status;
                if (status == 'ok') {
                    alert('Đặt hàng thành công !');
                    productsOrder();
                }
            }
        });
    }
}
function deleteProduct(id) {

    jQuery.ajax({
        url: './index.php?action=deleteproduct',
        data: {
            id: id,
        },
        type: "GET",
        dataType: 'json',
        success: function (json) {
            let status = json.status;
            if (status == 'ok') {
                productsOrder();
            }
        }
    });
}
function productsOrder() {

    jQuery.ajax({
        url: './index.php?action=productorder',
        data: {
            id_order: id_order,
        },
        type: "GET",
        success: function (html) {

            $("#bill-product").html(html);

        }
    });
}
