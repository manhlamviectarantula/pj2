<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

$query = mysqli_query($db, "SELECT * FROM users_orders INNER JOIN order_status ON users_orders.sta_id = order_status.sta_id ORDER BY o_id DESC");

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


// Trước khi thực hiện cập nhật trạng thái
if (isset($_GET['id']) && isset($_GET['status'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    mysqli_query($db, "UPDATE users_orders SET sta_id='$status' WHERE o_id='$id'");
    header("location:orders.php");
    die();
}
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
        <table style="margin-bottom : 30px;" width=" 1000px">
            <tr>
                <th style="background-color: #F9C560;" class="text-center" colspan="7">Danh sách đơn hàng</th>
            </tr>
            <tr class="bold-list">
                <td style="white-space: nowrap;">Mã đơn hàng</td>
                <td>Thời gian đặt hàng</td>
                <td style="white-space: nowrap;">Tổng cộng</td>
                <td style="white-space: nowrap;">Trạng thái</td>
                <td>Sửa trạng thái</td>
                <td style="white-space: nowrap;">Chi tiết</td>
                <td>Xóa</td>
            </tr>

            <?php
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<td style="width: 5%;">' . $row['o_id'] . '</td>';
                    echo '<td style="width: 85%;">' . $row['cre_date'] . '</td>';
                    echo '<td style="width: 85%; white-space: nowrap;">' . number_format($row['total']) . ' đ</td>';

                    echo '<td class="text-center" style="min-width: 150px; white-space: nowrap; font-weight: bold; color: ' . getStatusColor($row['sta_name']) . ';">' . $row['sta_name'] . '</td>';

                    echo '<td>';
                    echo '<select onchange="status_update(this.options[this.selectedIndex].value, ' . $row['o_id'] . ')">';
                    echo '<option value="" selected disabled>Update Status</option>';
                    echo '<option value="1">Chờ xác nhận</option>';
                    echo '<option value="2">Đang giao</option>';
                    echo '<option value="3">Đã hủy</option>';
                    echo '<option value="4">Thành công</option>';
                    echo '</select>';
                    echo '</td>';

                    echo '<td style="width: 5%;"><a href="update_order.php?order_id=' . $row['o_id'] . '"><i class="fa fa-bars" style="font-size:16px; color: #1976D2;"></i></a></td>';
                    echo '<td style="width: 5%;"><a href="delete_order.php?order_del=' . $row['o_id'] . '"><i class="fa fa-trash-o" style="font-size:16px; color: #D42216;"></i></a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7"><center>Chưa có đơn hàng nào</center></td></tr>';
            }
            ?>
        </table>
    </div>
    <script type="text/javascript">
        function status_update(value, id) {
            let url = "http://localhost/pj2/admin/orders.php";
            window.location.href = url + "?status=" + value + "&id=" + id;
        }
    </script>
</body>

</html>