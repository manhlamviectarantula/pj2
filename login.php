<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $_SESSION['old_username'] = $_POST['username'];
    $_SESSION['old_password'] = $_POST['password'];

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'";
    $result = mysqli_query($db, $loginquery);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $username && $row['password'] === md5($password)) {
            $_SESSION["user_id"] = $row['u_id'];
            header("refresh:1;url=index.php");

            unset($_SESSION['old_username']);
            unset($_SESSION['old_password']);
            exit();
        } else {
            header("Location: login.php?error=sai Tên tài khoản hoặc Mật Khẩu");
            exit();
        }
    } else {
        header("Location: login.php?error=sai Tên tài khoản hoặc Mật Khẩu");
        exit();
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
            <form action="" method="post" id="loginForm">
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
                            <label for="username"><b>Tên tài khoản</b></label>
                            <input type="text" placeholder="" name="username" id="username" value="<?php echo isset($_SESSION['old_username']) ? $_SESSION['old_username'] : ''; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Tên tài khoản')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <label for="psw"><b>Mật khẩu</b></label>
                            <input type="password" placeholder="" name="password" id="psw" value="<?php echo isset($_SESSION['old_password']) ? $_SESSION['old_password'] : ''; ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Đăng nhập</b></button>
                        </div>
                    </div>
                    <a class="fop" href="forgot_pw.php">Quên mật khẩu?</a>
                </div>

                <div class="container signin">
                    <p>Chưa có tài khoản? <a class="" href="registration.php">Đăng ký.</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>