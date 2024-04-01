<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
error_reporting(0);
session_start();

if (isset($_POST['submit'])) {
    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pw1 = $_POST['new_pw1'];

    $sql = "SELECT password from users where u_id='" . $_SESSION['user_id'] . "' ";
    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);

    $pass = md5($old_pw);

    if ($pass == $row['password']) {
        if (strlen($new_pw) < 6) {
            header("Location: change_pw.php?error=Mật khẩu mới phải hơn 5 kí tự");
        } elseif ($new_pw != $new_pw1) {
            header("Location: change_pw.php?error=Nhập lại mật khẩu mới chưa đúng");
        }else{
            $new_hashed_password =  md5($new_pw);
            $result = mysqli_query($db, "UPDATE users SET password='$new_hashed_password' WHERE u_id='" . $_SESSION['user_id'] . "'");

            // echo '<script>alert("Đổi mật khẩu thành công");window.location.href = "account.php";</script>';
            header("Location: account.php?registed=Đổi mật khẩu thành công");
        }
    } else {
        header("Location: change_pw.php?error=Nhập sai mật khẩu cũ");
    }
}
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
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="logresbg">
        <div class="padform">
            <form action="" method="post">
                <div class="container bgform">
                    <div class="row">
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

                        <?php if (isset($_GET['primary'])) { ?>
                            <div class="col-sm-12">
                                <p class="primary"><?php echo $_GET['primary']; ?></p>
                            </div>
                        <?php } ?>
                        <div class="col-sm-12">
                            <label for="username"><b>Mật khẩu cũ</b></label>
                            <input type="password" name="old_pw" required="" oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu cũ')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <label for="psw"><b>Mật khẩu mới</b></label>
                            <input type="password" placeholder="" name="new_pw" required="" oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu mới')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <label for="psw"><b>Nhập lại mật khẩu mới</b></label>
                            <input type="password" placeholder="" name="new_pw1" id="psw" required="" oninvalid="this.setCustomValidity('Chưa nhập lại mật khẩu mới')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Xác nhận</b></button>
                        </div>

                        <div class="col-sm-12">
                            <a href="account.php" class="logoutbtn">
                                <b>Hủy</b>
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>