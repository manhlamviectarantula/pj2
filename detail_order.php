<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đặt đồ ăn online</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <header id="header">
            <nav class="navbar navbar-expand-sm">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <img src="./images/logo.png" alt="" style="width:150px;" class="img-rounded">
                    </a>
                    <div class="menu float-lg-right">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="restaurants.php">Đặt món</a>
                            </li>
                            <?php
                            if (empty($_SESSION["user_id"])) // if user is not login
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="registration.php">Đăng ký</a></li>';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="your_orders.php">Lịch sử</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="account.php">Tài khoản</a></li>';
                            }
                            ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="logresbg">
            <div class="padform container">
                <table class="table table-bordered table-hover">
                    <?php
                    $o_de_1 = mysqli_query($db, "SELECT * FROM `users_orders` WHERE o_id=$_GET[o_id]");
                    $total1 = mysqli_fetch_array($o_de_1);
                    ?>
                    <thead>
                        <tr>
                            <th colspan="2" style="color: #DCA656;background-color: #291F25; text-align: center;"><?php echo $total1['cre_date'] ?></th>
                        </tr>
                        <tr>
                            <th style="background-color: #F1F1F1;"> <span style="float: left;">Tên món</span> <span style="float: right;">Số lượng</span></th>
                            <th style="background-color: #F1F1F1; text-align: center;">Giá</th>
                        </tr>
                    </thead>

                    <tbody class="dish_order">
                        <?php
                        $o_de = mysqli_query($db, "SELECT * FROM `detail_orders` INNER JOIN dishes ON detail_orders.d_id = dishes.d_id WHERE o_id='$_GET[o_id]';");
                        while ($rows_detail = mysqli_fetch_array($o_de)) {
                        ?>
                            <tr>
                                <td> <?php echo $rows_detail['d_name']; ?> <span style="float: right;"><?php echo $rows_detail['quantity']; ?> </span></td>

                                <td> <?php echo number_format($rows_detail['price']) . " đ"; ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                    <tbody class="info_order">
                        <tr>
                            <th style="background-color: #F1F1F1; border-top: 2px solid #000;">Phương thức thanh toán:</th>
                            <td style="border-top: 2px solid #000;"><?php echo $total1['payment']; ?></td>
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
                            <th style="background-color: #F1F1F1;">Tổng cộng:</th>
                            <td><strong><?php echo number_format($total1['total']) . " đ"; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php include('footer.php') ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<?php
}
?>