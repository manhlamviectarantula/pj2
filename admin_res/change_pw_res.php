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
    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pw1 = $_POST['new_pw1'];

    $sql = "SELECT password from restaurants where rs_id='" . $_SESSION["admres_id"] . "' ";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);

    $pass = md5($old_pw);

    // if ($pass == $row['password']) {
    //     if ($new_pw1 == '') {
    //         $error[] = 'Vui lòng nhập lại mật khẩu mới';
    //     }
    //     if ($new_pw != $new_pw1) {
    //         $error[] = 'Nhập lại mật khẩu mới chưa đúng';
    //     }
    //     if (!isset($error)) {
    //         $new_hashed_password =  md5($new_pw);
    //         $result = mysqli_query($db, "UPDATE restaurants SET password='$new_hashed_password' WHERE rs_id='" . $_SESSION["admres_id"] . "'");

    //         echo '<script>alert("Đổi mật khẩu thành công");window.location.href = "info_res.php";</script>';
    //     }
    // } else {
    //     $error[] = 'Nhập sai mật khẩu cũ';
    // }

    // if (isset($error)) {
    //     foreach ($error as $error) {
    //         echo '<script>alert("' . $error . '")</script>';
    //     }
    // }

    if (strlen($new_pw) < 6) {
        header("Location: change_pw_res.php?error=Mật khẩu mới chưa hợp lệ");
    } else {
        if ($pass == $row['password']) {

            if ($new_pw != $new_pw1) {
                header("Location: change_pw_res.php?error=Nhập lại mật khẩu mới chưa đúng");
            } else {
                $new_hashed_password =  md5($new_pw);
                $result = mysqli_query($db, "UPDATE restaurants SET password='$new_hashed_password' WHERE rs_id='" . $_SESSION["admres_id"] . "'");

                header("Location: change_pw_res.php?registed=Đổi mật khẩu thành công");
            }
        } else {
            header("Location: change_pw_res.php?error=Nhập sai mật khẩu cũ");
        }
    }
}
?>
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
            <li><a class="nav-link current" href="info_res.php"><i style="padding-right: 7px;" class="fa fa-folder-open"></i>Thông tin nhà hàng</a></li>
            <li><a class="nav-link" href="pre_order.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món cần chuẩn bị</a></li>
        </ul>

    </div>

    <div class="card card-form">
        <div class="wrapper-btn">
            <a href="change_pw_res.php" class="card-btn current">Đổi mật khẩu</a>
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
                <h6 style="text-align: center;">Đổi mật khẩu</h6>
                <div class="row">
                    <div class="col-12">
                        <label for="fname">Mật khẩu cũ</label>
                        <input type="password" id="" name="old_pw" required="" oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu cũ')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-12">
                        <label for="email">Mật khẩu mới</label>
                        <input type="password" id="" name="new_pw" required="" oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu mới')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-12">
                        <label for="phone">Nhập lại mật khẩu mới</label>
                        <input type="password" id="" name="new_pw1" required="" oninvalid="this.setCustomValidity('Chưa nhập lại mật khẩu mới')" oninput="setCustomValidity('')">
                    </div>

                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Xác nhận">
                        <a href="info_res.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>