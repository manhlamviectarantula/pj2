<!DOCTYPE html>
<html lang="en">
<style>
    .error {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
    }

    .registed {
        background: #D9EEE1;
        color: #04AA6D;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
    }

    .primary {
        background: #C4E1EB;
        color: #0091F7;
        padding: 10px;
        width: 100%;
        border-radius: 5px;
    }
</style>
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $_SESSION['oldr_v_name'] = $_POST['v_name'];
    $_SESSION['oldr_vou_des'] = $_POST['vou_des'];

    $v_name = ($_POST['v_name']);
    $value = str_replace(',', '', $_POST['value']);
    $vou_des = ($_POST['vou_des']);

    $check_voucher = mysqli_query($db, "SELECT v_name FROM voucher where v_name = '$v_name'");

    if (mysqli_num_rows($check_voucher) > 0) {
        header("Location: add_voucher.php?error=Mã voucher đã tồn tại");
    } else {
        $mql2 = "INSERT INTO voucher (v_name,value,vou_des) 
    VALUES ('$v_name','$value','$vou_des')";

        mysqli_query($db, $mql2);

        header("Location: add_voucher.php?registed=Thêm voucher thành công");

        unset($_SESSION["oldr_v_name"]);
        unset($_SESSION["oldr_vou_des"]);
    }
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
            <li><a class="nav-link" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
            <li><a class="nav-link" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
            <li><a class="nav-link current" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
        </ul>

    </div>

    <div class="card card-form">
        <div class="wrapper-btn">
            <a href="add_voucher.php" class="card-btn current">Thêm voucher</a>
        </div>

        <div class="container">
            <form class="fill-form" action="" method="post" enctype="multipart/form-data">
                <?php if (isset($_GET['registed'])) { ?>
                    <div class="col-sm-12">
                        <p class="registed"><?php echo $_GET['registed']; ?></p>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="col-sm-12">
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    </div>
                <?php } ?>
                <h6 style="text-align: center;">Thông tin voucher</h6>

                <div class="row">
                    <div class="col-6">
                        <label for="username">Mã voucher</label>
                        <input type="text" name="v_name" required="" value="<?php echo isset($_SESSION['oldr_v_name']) ? $_SESSION['oldr_v_name'] : ''; ?>" oninvalid="this.setCustomValidity('Chưa nhập Mã voucher')" oninput="setCustomValidity('')">
                    </div>

                    <div class="col-6">
                        <label for="password">Giá giảm</label>
                        <input type="text" name="value" oninput="formatCurrency(this)">
                    </div>

                    <div class="col-6">
                        <label for="password">Mô tả</label>
                        <input type="text" name="vou_des" required="" value="<?php echo isset($_SESSION['oldr_vou_des']) ? $_SESSION['oldr_vou_des'] : ''; ?>" oninvalid="this.setCustomValidity('Chưa nhập Mô tả')" oninput="setCustomValidity('')">
                    </div>

                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Thêm">
                        <a href="voucher.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/index.js"></script>

</body>

</html>