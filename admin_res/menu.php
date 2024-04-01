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
                <li><a class="nav-link current" href="menu.php"><i style="padding-right: 7px;" class="fa fa-cutlery"></i>Menu</a></li>
                <li><a class="nav-link" href="info_res.php"><i style="padding-right: 7px;" class="fa fa-folder-open"></i>Thông tin nhà hàng</a></li>
                <li><a class="nav-link" href="pre_order.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món cần chuẩn bị</a></li>
            </ul>

        </div>

        <div class="card">
            <div class="wrapper-btn">
                <a href="add_menu.php" class="card-btn">Thêm món ăn</a>
            </div>

            <table width=" 1000px">
                <tr>
                    <th style="background-color: #F9C560;" class="text-center" colspan="4">Danh sách món ăn</th>
                </tr>
                <?php
                $sql = "SELECT * FROM dishes where rs_id = '" . $_SESSION['admres_id'] . "' ";
                $query = mysqli_query($db, $sql);

                if (mysqli_num_rows($query) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        echo '<tr>';
                        echo '<td style="width: 5%;">' . $count . '</td>';
                        echo '<td style="width: 85%;">' . $row['d_name'] . '</td>';
                        echo '<td style="width: 5%;"<td><a href="update_menu.php?dis_upd='. $row['d_id'] .'" ><i class="fa fa-pencil" style="font-size:16px; color: #1976D2;"></i></a></td>';
                        echo '<td style="width: 5%;"<td><a href="delete_menu.php?dis_del=' . $row['d_id'] . '" ><i class="fa fa-trash-o" style="font-size:16px; color: #D42216;"></i></a></td>';
                        echo '</tr>';
                        $count++;
                    }
                } else {
                    echo '<tr><td colspan="4"><center>Chưa có món ăn nào</center></td></tr>';
                }
                ?>
            </table>

        </div>

    </body>

</html>