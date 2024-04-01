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
                <li><a class="nav-link" href="dashboard.php"><i style="padding-right: 7px;" class="fa fa-tachometer"></i>Số liệu tổng thể</a></li>
                <li><a class="nav-link" href="all_users.php"><i style="padding-right: 7px;" class="fa fa-users"></i>Thành viên</a></li>
                <li><a class="nav-link" href="all_restaurants.php"><i style="padding-right: 7px;" class="fa fa-building"></i>Nhà hàng</a></li>
                <li><a class="nav-link current" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
                <li><a class="nav-link" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
                <li><a class="nav-link" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
            </ul>
        </div>

        <div class="card">
            <table width="1000px" style="margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th style="background-color: #F9C560;" class="text-center" colspan="2">Thông tin đơn hàng</th>
                    </tr>
                    <tr class="bold-list">
                        <th style="background-color: #F1F1F1;"> <span style="float: left;">Tên món</span> <span style="float: right;">Số lượng</span></th>
                        <th style="background-color: #F1F1F1; text-align: center;">Giá</th>
                    </tr>
                </thead>

                <tbody class="dish_order">
                    <?php
                    $o_de = mysqli_query($db, "SELECT * FROM `detail_orders` INNER JOIN dishes ON detail_orders.d_id = dishes.d_id WHERE o_id='$_GET[order_id]';");
                    while ($rows_detail = mysqli_fetch_array($o_de)) {
                    ?>
                        <tr>
                            <td> <?php echo $rows_detail['d_name']; ?> <span style="float: right;"><?php echo $rows_detail['quantity']; ?> </span></td>

                            <td> <?php echo number_format($rows_detail['price']) . " đ"; ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>

                <tbody class="info_order">
                    <?php
                    $query = mysqli_query($db, "SELECT * 
                FROM users_orders 
                INNER JOIN users ON users_orders.u_id = users.u_id
                -- INNER JOIN order_status ON users_orders.sta_id = order_status.sta_id
                WHERE o_id = $_GET[order_id]");
                    $order_info = mysqli_fetch_array($query);
                    ?>

                    <tr>
                        <th style="background-color: #F1F1F1; border-top: 2px solid #000;">Phương thức thanh toán:</th>
                        <td style="border-top: 2px solid #000;"><?php echo $order_info['payment'] ?></td>
                    </tr>

                    <tr>
                        <th style="background-color: #F1F1F1;">Voucher:</th>
                        <td>Không có</td>
                    </tr>

                    <tr>
                        <th style="background-color: #F1F1F1;">Phí vận chuyển:</th>
                        <td>Miễn phí</td>
                    </tr>

                    <tr>
                        <th style="background-color: #F1F1F1;">Tổng cộng</th>
                        <td><strong><?php echo number_format($order_info['total']) . " đ"; ?></strong></td>
                    </tr>

                </tbody>
            </table>

            <table width="1000px" style="margin-bottom: 100px;">

                <tr>
                    <th style="background-color: #F9C560;" class="text-center" colspan="2">Thông tin người nhận</th>
                </tr>

                <tr>
                    <th style="background-color: #F1F1F1; width: 50%;">Tên</th>
                    <td style="width: 50%;"><?php echo $order_info['l_name'] ?></td>
                </tr>
                <tr>
                    <th style="background-color: #F1F1F1; width: 50%;">Số điện thoại</th>
                    <td style="width: 50%;"><?php echo $order_info['phone'] ?></td>
                </tr>
                <tr>
                    <th style="background-color: #F1F1F1; width: 50%;">Địa chỉ</th>
                    <td style="width: 50%;"><?php echo $order_info['address'] ?></td>
                </tr>

            </table>
        </div>

    </body>

</html>
<?php } ?>