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
                    <img src="./imgad/adminlogo.png" alt="Logo" style="width:40px;" class="d-inline-block align-top">
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
            <li><a class="nav-link" href="dashboard.php"><i style="padding-right: 7px;" class="fa fa-tachometer"></i>Số liệu tổng thể</a></li>
            <li><a class="nav-link" href="all_users.php"><i style="padding-right: 7px;" class="fa fa-users"></i>Thành viên</a></li>
            <li><a class="nav-link" href="all_restaurants.php"><i style="padding-right: 7px;" class="fa fa-building"></i>Nhà hàng</a></li>
            <li><a class="nav-link" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
            <li><a class="nav-link  current" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
            <li><a class="nav-link" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
        </ul>

    </div>

    <div class="card">

        <table style="margin-bottom: 50px;" width=" 1000px">
            <tr>
                <th style="background-color: #F9C560;" class="text-center" colspan="5">Danh sách món ăn đã chế biến xong và đợi shipper đến lấy</th>
            </tr>
            <tr class="bold-list">
                <td style="white-space: nowrap;">Mã đơn hàng</td>
                <td>Tên món ăn</td>
                <td style="white-space: nowrap;">Số lượng</td>
                <td style="white-space: nowrap;">Trạng thái</td>
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
ORDER BY users_orders.o_id";
            $query = mysqli_query($db, $sql);

            if (!isset($_SESSION['colorMap'])) {
                $_SESSION['colorMap'] = array();
            }

            $prevOrderId = null; 

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    if ($row['o_id'] !== $prevOrderId) {
                        echo '<tr><td colspan="4"><b>Order ID: ' . $row['o_id'] . '</b></td></tr>';
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
                    echo '<td style="width: 5%;">Shipper đã lấy</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4"><center>Chưa có món ăn nào</center></td></tr>';
            }

            ?>


        </table>

    </div>

</body>

</html>