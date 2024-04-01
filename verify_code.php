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
    $_SESSION['cofirm_code'] = $_POST['code'];

    $userInputCode = $_POST['code'];

    if ($userInputCode != $_SESSION['code']) {
        header("Location: verify_code.php?error=Mã xác thực chưa đúng");
    } else {
        header("Location: reset_pw.php?registed=Đúng mã xác thực! Vui lòng tạo mật khẩu mới.");
        unset($_SESSION["cofirm_code"]);
        exit();
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'resend') {

    $email = $_SESSION['mail'];
    $code = substr(rand(0, 999999), 0, 6);
    $_SESSION['code'] = $code;

    $title = "Gửi lại mã xác thực";
    $content = "Mã xác thực mới của bạn là: <span style='color:green'>" . $code . "</span>";
    $addressMail = $email;
    $mail->sendMail($title, $content, $addressMail);

    header("Location: verify_code.php?primary=Đã gửi lại mã xác thực");
    exit();
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
                            <label for="username"><b>Nhập mã xác thực nhận được qua Email:</b></label>
                            <input type="text" placeholder="" name="code" id="username" required="" value="<?php echo isset($_SESSION['cofirm_code']) ? $_SESSION['cofirm_code'] : ''; ?>" oninvalid="this.setCustomValidity('Vui lòng nhập Mã xác thực')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Xác nhận</b></button>
                        </div>

                        <div>Chưa nhận được mã?<a class="fop" name="resend" href="verify_code.php?action=resend"> Gửi lại. </a></div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>