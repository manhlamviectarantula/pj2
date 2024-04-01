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

$ssql = "SELECT * FROM users where u_id='" . $_GET['user_upd'] . "' ";
$res = mysqli_query($db, $ssql);
$newrow = mysqli_fetch_array($res);

$_SESSION["user_upd"] = $_GET['user_upd'];


if (isset($_POST['submit'])) {
    $username = ($_POST['username']);
    $fname = ($_POST['fname']);
    $lname = ($_POST['lname']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);
    $address = ($_POST['address']);

    $check_username = mysqli_query($db, "SELECT username FROM users WHERE username = '" . $_POST['username'] . "' && username != '" . $newrow['username'] . "'");

    //     if (mysqli_num_rows($check_username) ==  0) {
    //         if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    //             $error =     '<div class="col-sm-12">
    //     <p class="error">Email chưa hợp lệ</p>
    // </div>';
    //         } elseif (strlen($_POST['phone']) < 10) {
    //             $error =     '<div class="col-sm-12">
    //     <p class="error">Số điện thoại chưa hợp lệ</p>
    // </div>';
    //         } else {
    //             $mql = "update users set username='$username', f_name='$fname', l_name='$lname',email='$email',phone='$phone',
    //             address='$address' where u_id='" . $_GET['user_upd'] . "' ";
    //             mysqli_query($db, $mql);

    //             $success =     '<div class="col-sm-12">
    //     <p class="registed">Đã cập nhật thông tin</p>
    // </div>';
    //             // header("Refresh:0");
    //             // header("Location: update_users.php?user_upd=" . $_SESSION["user_upd"]);
    //             header("Location: update_users.php?registed=Cập nhật thông tin thành công&user_upd=" . $_SESSION["user_upd"]);

    //             unset($_SESSION["user_upd"]);
    //         }
    //     } else {
    //         $error =     '<div class="col-sm-12">
    //     <p class="error">Tên tài khoản đã tồn tại</p>
    // </div>';
    //     }

    if (mysqli_num_rows($check_username) ==  0) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: update_users.php?error=Email không hợp lệ&user_upd=" . $_SESSION["user_upd"]);
        } elseif (strlen($_POST['phone']) < 10) {
            header("Location: update_users.php?error=Số điện thoại không hợp lệ&user_upd=" . $_SESSION["user_upd"]);
        } else {
            $mql = "update users set username='$username', f_name='$fname', l_name='$lname',email='$email',phone='$phone',
        address='$address' where u_id='" . $_GET['user_upd'] . "' ";
            mysqli_query($db, $mql);

            // header("Refresh:0");
            // header("Location: update_users.php?user_upd=" . $_SESSION["user_upd"]);
            header("Location: update_users.php?registed=Cập nhật thông tin thành công&user_upd=" . $_SESSION["user_upd"]);

            unset($_SESSION["user_upd"]);
        }
    } else {
        header("Location: update_users.php?error=Tên tài khoản đã tồn tại&user_upd=" . $_SESSION["user_upd"]);
    }

    // header("Location: update_users.php?user_upd='" . $_SESSION["user_upd"] . "'&registed=Cập nhật thông tin thành công");
    // header("Location: update_users.php?user_upd='9'&registed=Cập nhật thông tin thành công");
    // unset($_SESSION['user_ipd']);
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
            <li><a class="nav-link current" href="all_users.php"><i style="padding-right: 7px;" class="fa fa-users"></i>Thành viên</a></li>
            <li><a class="nav-link" href="all_restaurants.php"><i style="padding-right: 7px;" class="fa fa-building"></i>Nhà hàng</a></li>
            <li><a class="nav-link" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
            <li><a class="nav-link" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
            <li><a class="nav-link" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
        </ul>

    </div>

    <div class="card card-form">
        <div class="container">
            <form class="fill-form" action="" method="post">

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

                <?php
                echo $error;
                echo $success;
                ?>

                <h6 style="text-align: center;">Thông tin thành viên</h6>

                <div class="row">
                    <div class="col-6">
                        <label for="fname">Tên tài khoản</label>
                        <input type="text" id="" name="username" value="<?php echo $newrow['username']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Tên tài khoản')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Họ</label>
                        <input type="text" id="" name="fname" value="<?php echo $newrow['f_name']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Họ')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Tên</label>
                        <input type="text" id="" name="lname" value="<?php echo $newrow['l_name']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Tên')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Email</label>
                        <input type="text" id="" name="email" value="<?php echo $newrow['email']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Email')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Số điện thoại</label>
                        <input type="text" id="" name="phone" value="<?php echo $newrow['phone']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Số điện thoại')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Địa chỉ nhận hàng</label>
                        <input type="text" id="" name="address" value="<?php echo $newrow['address']; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Địa chỉ')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Lưu">
                        <a href="all_users.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>