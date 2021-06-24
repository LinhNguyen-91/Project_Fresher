<?php
$sql = "SELECT * FROM orders WHERE phone= $phone AND status >0 ORDER BY id desc";
$resutls = mysqli_query($conn, $sql);
$items = [];
while ($row = mysqli_fetch_assoc($resutls)) {
    $items[] = $row;
}
$table = '';
$status = '';
foreach ($items as $key => $value) {
    $date = strtotime($value['date']);
    if ($value['status'] == 1) {
        $status = 'Đang Giao';
    }
    if ($value['status'] == 2) {
        $status = 'Hoàn Thành';
    }
    $table .= '<tr>';

    $table .= '<td>';
    $table .= ++$key;
    $table .= '</td>';

    $table .= '<td>';
    $table .=  $value['address'];
    $table .= '</td>';
    $table .= '<td>';
    $table .= date('d/m/Y', $date);
    $table .= '</td>';
    $table .= '<td>';
    $table .= $value['time'];
    $table .= '</td>';
    $table .= '<td>';
    $table .= number_format($value['total'], 0, ',', '.') . '<sup>đ</sup>';
    $table .= '</td>';
    $table .= '<td>';
    $table .=  $status;
    $table .= '</td>';
    $table .= '</tr>';
}

echo $table;
