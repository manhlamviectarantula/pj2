<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
include_once './PHPMailer/index.php';
error_reporting(0);
session_start();
ob_start();

$mail = new Mailer();

if (isset($_POST['submit'])) {

    $pass = $_POST['new_pw'];

    if(strlen($pass) < 6){
        header("Location: reset_pw.php?error=Mật khẩu mới phải hơn 5 kí tự");
    }elseif ($_POST['new_pw1'] != $_POST['new_pw']) {
        header("Location: reset_pw.php?error=Nhập lại mật khẩu mới chưa đúng");
    } else {
        $new_hashed_password =  md5($pass);
        $sql = "update users set password='$new_hashed_password' where email='" . $_SESSION['mail'] . "'";
        mysqli_query($db, $sql);

        header("Location: login.php?registed=Đổi mật khẩu mới thành công! Vui lòng đăng nhập.");
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
                            echo '<li class="nav-item"><a class="nav-link" href="#">Lịch sử</a></li>';
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

                        <div class="col-sm-12">
                            <label for="username"><b>Tạo mật khẩu mới:</b></label>
                            <input type="password" placeholder="" name="new_pw" 
                            required="" 
                            oninvalid="this.setCustomValidity('Chưa nhập mật khẩu mới')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <label for="username"><b>Nhập lại khẩu mới:</b></label>
                            <input type="password" placeholder="" name="new_pw1" 
                            required="" 
                            oninvalid="this.setCustomValidity('Chưa nhập lại mật khẩu mới')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Xác nhận</b></button>
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