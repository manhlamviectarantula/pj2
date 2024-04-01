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
    unset($_SESSION["cofirm_code"]);
    
    $_SESSION['old_resetpw_email'] = $_POST['email'];
    $email = $_POST['email'];

    // if ($email == '') {
    //     $error1[] = 'Vui lòng nhập email';
    // } else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Email tồn tại, tiếp tục xử lý

        $code = substr(rand(0, 999999), 0, 6);
        $title = "Quên mật khẩu";
        $content = "Mã xác thực của bạn là: <span style='color:green'>" . $code . "</span>";
        $addressMail = $email; // Địa chỉ email của người nhận
        $mail->sendMail($title, $content, $addressMail);

        $_SESSION['mail'] = $email;
        $_SESSION['code'] = $code;
        header('Location: verify_code.php');
        unset($_SESSION["old_resetpw_email"]);

    } else {
        // echo 'Email không tồn tại';
        header("Location: forgot_pw.php?error=Email không tồn tại");
    }
    // }
}

// if (isset($error1)) {
//     foreach ($error1 as $error1) {
//         echo '<script>alert("' . $error1 . '")</script>';
//     }
// }

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

                        <div class="col-sm-12">
                            <label for="username"><b>Vui lòng nhập Email của tài khoản:</b></label>
                            <input type="text" placeholder="" name="email" id="username" required="" value="<?php echo isset($_SESSION['old_resetpw_email']) ? $_SESSION['old_resetpw_email'] : ''; ?>" oninvalid="this.setCustomValidity('Vui lòng nhập Email')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Gửi mã xác thực</b></button>
                        </div>
                    </div>
                </div>

                <div class="container signin">
                    <p>Quên email? Gọi ngay <a class="" href="https://vtc.edu.vn/">0818 799 299</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>