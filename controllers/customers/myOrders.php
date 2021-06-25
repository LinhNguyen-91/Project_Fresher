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
    $table .= '<tr><td>' . ++$key . '</td><td>' . $value['address'] . '</td>
    <td>' .  date('d/m/Y', $date) . '</td><td>' . $value['time'] . '</td>
    <td>' . number_format($value['total'], 0, ',', '.') . '<sup>đ</sup>' .
        '</td><td>' . $status . '</td></tr>';
}

echo $table;
