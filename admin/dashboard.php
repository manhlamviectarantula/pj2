<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
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
                <li><a class="nav-link current" href="dashboard.php"><i style="padding-right: 7px;" class="fa fa-tachometer"></i>Số liệu tổng thể</a></li>
                <li><a class="nav-link" href="all_users.php"><i style="padding-right: 7px;" class="fa fa-users"></i>Thành viên</a></li>
                <li><a class="nav-link" href="all_restaurants.php"><i style="padding-right: 7px;" class="fa fa-building"></i>Nhà hàng</a></li>
                <li><a class="nav-link" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
                <li><a class="nav-link" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
                <li><a class="nav-link" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
            </ul>

        </div>

        <div class="card">
            <table width="1000px">
                <tr>
                    <th style="background-color: #F9C560;" class="text-center" colspan="2">Số liệu tổng thể</th>
                </tr>
                <tr>
                    <td>Số lượng nhà hàng</td>
                    <td><?php $sql = "select * from restaurants";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);

                        echo $rws; ?></td>
                </tr>
                <tr>
                    <td>Số lượng món ăn</td>
                    <td><?php $sql = "select * from dishes";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);

                        echo $rws; ?></td>
                </tr>
                <tr>
                    <td>Số lượng thành viên</td>
                    <td><?php $sql = "select * from users";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);

                        echo $rws; ?></td>
                </tr>
                <tr>
                    <td>Số lượng đơn hàng</td>
                    <td><?php $sql = "select * from users_orders";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);

                        echo $rws; ?></td>
                </tr>
            </table>

    </body>

</html>
<?php } ?>