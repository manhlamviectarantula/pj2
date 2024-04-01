<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
ob_start();
function getStatusColor($statusName)
{
    switch ($statusName) {
        case 'Chờ xác nhận':
            return '#989898';
        case 'Đang giao':
            return '#1976D2';
        case 'Đã hủy':
            return '#D42216';
        case 'Thành công':
            return '#82BD4E';
        default:
            return '';
    }
}
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} elseif (isset($_GET['partnerCode'])) {
    // $orderId = $_GET['orderId'];
    $amount = $_GET['amount'];
    $orderType = $_GET['orderType'];
    $payType = $_GET['payType'];

        $sql_users_orders = "INSERT INTO users_orders (u_id, total, payment) VALUES ('" . $_SESSION["user_id"] . "', '" . $amount . "', 'MOMO ATM')";

        // Thực hiện truy vấn users_orders
        if (mysqli_query($db, $sql_users_orders)) {
            // Nếu thành công, lấy ID cuối cùng được chèn
            $last_id = mysqli_insert_id($db);
            // Chèn bảng momo
            $insert_momo = "INSERT INTO momo (o_id, amount, order_type, pay_type) 
                VALUES ('$last_id', '$amount', '$orderType', '$payType')";
            $cart_query = mysqli_query($db, $insert_momo);
            // Sử dụng ID cuối cùng được chèn cho truy vấn detail_orders
            foreach ($_SESSION["cart_item"] as $item) {
                $sql_detail_orders = "INSERT INTO detail_orders (o_id, d_id, quantity, price,vou_id) VALUES ('" . $last_id . "', '" . $item["d_id"] . "',
                 '" . $item["quantity"] . "', '" . $item["price"] . "','1')";
                mysqli_query($db, $sql_detail_orders);
            }
        }
        header('location: your_orders.php');
        unset($_SESSION["cart_item"]);
        unset($item["d_name"]);
        unset($item["quantity"]);
        unset($item["price"]);
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
                <table class="table table-bordered table-hover history-form">
                    <thead>
                        <tr>
                            <th>Ngày đặt</th>
                            <th>Tổng cộng</th>
                            <th>Trạng thái</th>
                            <th style="width: 9%;">Chi tiết</th>
                            <th style="width: 9%;">Đặt lại</th>
                            <th style="width: 9%;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_res = mysqli_query($db, "SELECT * FROM `users_orders` INNER JOIN `order_status` on `users_orders`.`sta_id` = `order_status`.`sta_id` WHERE `users_orders`.`u_id` = '" . $_SESSION['user_id'] . "' ORDER BY o_id DESC");
                        if (!mysqli_num_rows($query_res) > 0) {
                            echo '<tr><td colspan="6"><center>Chưa có đơn hàng nào</center></td></tr>';
                        } else {
                            while ($row = mysqli_fetch_array($query_res)) {
                        ?>
                                <tr>
                                    <td data-column="date"> <?php echo $row['cre_date']; ?></td>
                                    <td data-column="total"> <?php echo number_format($row['total']); ?> đ</td>

                                    <?php
                                    echo '<td class="text-center" style="max-width: 50px; white-space: nowrap; font-weight: bold; border-color: #212529; color: ' . getStatusColor($row['sta_name']) . ';">' . $row['sta_name'] . '</td>';
                                    ?>
                                    <td class="text-center" data-column="Action">
                                        <a href="detail_order.php?o_id=<?php echo $row['o_id']; ?>" class="btn btn-primary btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-ellipsis-h" style="font-size:16px"></i></a>
                                    </td>
                                    <td class="text-center" data-column="Action">
                                        <a href="repeat_order.php?order_repeat=<?php echo $row['o_id']; ?>" class="btn btn-secondary btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-repeat" style="font-size:16px"></i></a>
                                    </td>
                                    <td class="text-center" data-column="Action">
                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
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