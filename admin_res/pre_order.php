<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- NAV 1 -->
    <div class="header">
        <nav class="navbar n1 navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../images/logo.png" alt="Logo" style="width:150px;" class="d-inline-block align-top">
                    <i style="margin-top: 5px;font-size: 33px;" class="fa fa-building" aria-hidden="true"></i>
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="logout.php" role="button">
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="left-sidebar">
        <ul class="nav-side">
            <li><a class="nav-link" href="menu.php"><i style="padding-right: 7px;" class="fa fa-cutlery"></i>Menu</a></li>
            <li><a class="nav-link" href="info_res.php"><i style="padding-right: 7px;" class="fa fa-folder-open"></i>Thông tin nhà hàng</a></li>
            <li><a class="nav-link  current" href="pre_order.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món cần chuẩn bị</a></li>
        </ul>

    </div>

    <div class="card">

        <table width=" 1000px">
            <tr>
                <th style="background-color: #F9C560;" class="text-center" colspan="5">Danh sách món ăn cần chuẩn bị</th>
            </tr>
            <tr class="bold-list">
                <td style="white-space: nowrap;">Mã đơn hàng</td>
                <td>Tên món ăn</td>
                <td style="white-space: nowrap;">Số lượng</td>
                <td style="white-space: nowrap;">Trạng thái</td>
                <td style="white-space: nowrap;">Sửa trạng thái</td>
            </tr>
            <?php

            function generateRandomColors($count)
            {
                $colors = array();
                for ($i = 0; $i < $count; $i++) {
                    $r = mt_rand(200, 255);
                    $g = mt_rand(200, 255);
                    $b = mt_rand(200, 255);
                    $color = sprintf("#%02x%02x%02x", $r, $g, $b);
                    $colors[] = $color;
                }
                return $colors;
            }

            $sql = "SELECT * FROM users_orders
INNER JOIN detail_orders ON users_orders.o_id = detail_orders.o_id
INNER JOIN dishes ON detail_orders.d_id = dishes.d_id
WHERE dishes.rs_id = '" . $_SESSION['admres_id'] . "'
ORDER BY users_orders.o_id";
            $query = mysqli_query($db, $sql);

            // Mảng lưu trữ màu cho từng số đơn hàng
            if (!isset($_SESSION['colorMap'])) {
                $_SESSION['colorMap'] = array();
            }

            $prevOrderId = null;

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    if ($row['o_id'] !== $prevOrderId) {
                        echo '<tr><td colspan="5"><b>Order ID: ' . $row['o_id'] . '</b></td></tr>';
                        $prevOrderId = $row['o_id'];
                    }

                    if (!isset($_SESSION['colorMap'][$row['o_id']])) {
                        $randomColor = generateRandomColors(1)[0];
                        $_SESSION['colorMap'][$row['o_id']] = $randomColor;
                    }

                    $randomColor = $_SESSION['colorMap'][$row['o_id']];

                    echo '<tr style="background-color: ' . $randomColor . ';">';
                    echo '<td style="width: 5%;">' . $row['o_id'] . '</td>';
                    echo '<td style="width: 80%;">' . $row['d_name'] . '</td>';
                    echo '<td style="width: 5%;">' . $row['quantity'] . '</td>';
                    echo '<td style="width: 5%;">Đang chuẩn bị</td>';
                    echo '<td>';
                    echo '<select onchange="status_update(this.options[this.selectedIndex].value, ' . $row['o_id'] . ')">';
                    echo '<option value="" selected disabled>Update Status</option>';
                    echo '<option value="1">Đang chuẩn bị</option>';
                    echo '<option value="2">Đã chế biến</option>';
                    echo '<option value="3">Shipper đã lấy</option>';
                    echo '</select>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5"><center>Chưa có món ăn nào</center></td></tr>';
            }

            ?>


        </table>

    </div>

</body>

</html>