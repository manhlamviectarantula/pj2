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

    $_SESSION['oldr_username'] = $_POST['username'];
    $_SESSION['oldr_fname'] = $_POST['firstname'];
    $_SESSION['oldr_lname'] = $_POST['lastname'];
    $_SESSION['oldr_email'] = $_POST['email'];
    $_SESSION['oldr_phone'] = $_POST['phone'];
    $_SESSION['oldr_password'] = $_POST['password'];
    $_SESSION['oldr_cpassword'] = $_POST['cpassword'];
    $_SESSION['oldr_address'] = $_POST['address'];


    $uname = validate($_POST['username']);
    $fname = validate($_POST['firstname']);
    $lname = validate($_POST['lastname']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $pass = validate($_POST['password']);
    $cpass = validate($_POST['cpassword']);
    $addr = validate($_POST['address']);

    $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
    $check_email = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

    if ($_POST['password'] != $_POST['cpassword']) {
        header("Location: registration.php?error=Nhập lại mật khẩu chưa chính xác");
    } elseif (strlen($_POST['password']) < 6) {
        header("Location: registration.php?error=Mật khẩu phải hơn 5 kí tự");
    } elseif (strlen($_POST['phone']) < 10) {
        header("Location: registration.php?error=Số điện thoại chưa hợp lệ");
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header("Location: registration.php?error=Email chưa hợp lệ");
    } elseif (mysqli_num_rows($check_username) > 0) {
        header("Location: registration.php?error=Tên tài khoản đã tồn tại");
    } elseif (mysqli_num_rows($check_email) > 0) {
        header("Location: registration.php?error=Email đã tồn tại");
    } else {
        $pass = md5($pass);
        $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('" . $_POST['username'] . "',
        '" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "','" . $_POST['address'] . "')";
        mysqli_query($db, $mql);

        header("Location: login.php?registed=Đăng ký thành công! Vui lòng đăng nhập.");

        unset($_SESSION["oldr_username"]); 
        unset($_SESSION["oldr_fname"]); 
        unset($_SESSION["oldr_lname"]); 
        unset($_SESSION["oldr_email"]); 
        unset($_SESSION["oldr_phone"]); 
        unset($_SESSION["oldr_password"]); 
        unset($_SESSION["oldr_cpassword"]); 
        unset($_SESSION["oldr_address"]); 

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
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="registration.php">Đăng ký</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="your_orders.php">Lịch sử</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="account.php">Tài khoản</a></li>';
                        }
                        ?>
                        </li>
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
                            <label for="username"><b>Tên tài khoản</b></label>
                            <input type="text" name="username" id="username" required=""  
                            value="<?php echo isset($_SESSION['oldr_username']) ? $_SESSION['oldr_username'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Tên tài khoản')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="fname"><b>Họ</b></label>
                            <input type="text" name="firstname" id="fname" required=""  
                            value="<?php echo isset($_SESSION['oldr_fname']) ? $_SESSION['oldr_fname'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Họ')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="lname"><b>Tên</b></label>
                            <input type="text" name="lastname" id="lname" required=""  
                            value="<?php echo isset($_SESSION['oldr_lname']) ? $_SESSION['oldr_lname'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Tên')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="email"><b>Email</b></label>
                            <input type="text" name="email" id="email" required=""  
                            value="<?php echo isset($_SESSION['oldr_email']) ? $_SESSION['oldr_email'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Email')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="phone"><b>Số điện thoại</b></label>
                            <input type="text" name="phone" id="phone" required=""  
                            value="<?php echo isset($_SESSION['oldr_phone']) ? $_SESSION['oldr_phone'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Số điện thoại')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="psw"><b>Mật khẩu</b></label>
                            <input type="password" placeholder="" name="password" id="psw" required=""  
                            value="<?php echo isset($_SESSION['oldr_password']) ? $_SESSION['oldr_password'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-6">
                            <label for="psw-repeat"><b>Nhập lại mật khẩu</b></label>
                            <input type="password" placeholder="" name="cpassword" id="psw-repeat" required=""  
                            value="<?php echo isset($_SESSION['oldr_cpassword']) ? $_SESSION['oldr_cpassword'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập lại mật khẩu')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <label for="address"><b>Địa chỉ nhận hàng</b></label>
                            <input type="text" placeholder="" name="address" id="address" required=""  
                            value="<?php echo isset($_SESSION['oldr_address']) ? $_SESSION['oldr_address'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Địa chỉ nhận hàng')" oninput="setCustomValidity('')">
                        </div>

                        <div class="col-sm-12">
                            <button name="submit" id="submit" type="submit" class="registerbtn"><b>Đăng ký ngay</b></button>
                        </div>

                    </div>
                </div>

                <div class="container signin">
                    <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a>.</p>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>