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
    $_SESSION['oldr_username'] = $_POST['username'];
    $_SESSION['oldr_password'] = $_POST['password'];
    $_SESSION['oldr_res_name'] = $_POST['res_name'];
    $_SESSION['oldr_email'] = $_POST['email'];
    $_SESSION['oldr_phone'] = $_POST['phone'];
    $_SESSION['oldr_url'] = $_POST['url'];
    $_SESSION['oldr_o_hr'] = $_POST['o_hr'];
    $_SESSION['oldr_c_hr'] = $_POST['c_hr'];
    $_SESSION['oldr_o_days'] = $_POST['o_days'];
    $_SESSION['oldr_image'] = $_POST['image'];
    $_SESSION['oldr_address'] = $_POST['address'];


    $username = ($_POST['username']);
    $password = (md5($_POST['password']));
    $res_name = ($_POST['res_name']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);
    $url = ($_POST['url']);
    $o_hr = ($_POST['o_hr']);
    $c_hr = ($_POST['c_hr']);
    $o_days = ($_POST['o_days']);
    $address = ($_POST['address']);
    $image = basename($_FILES['image']['name']);

    $check_username = mysqli_query($db, "SELECT username FROM restaurants where username = '" . $_POST['username'] . "'");

    if (strlen($_POST['password']) < 6) {
        header("Location: add_restaurants.php?error=Mật khẩu phải hơn 5 kí tự");
    } elseif (strlen($_POST['phone']) < 10) {
        header("Location: add_restaurants.php?error=Số điện thoại chưa hợp lệ");
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header("Location: add_restaurants.php?error=Email chưa hợp lệ");
    } elseif (mysqli_num_rows($check_username) > 0) {
        header("Location: add_restaurants.php?error=Tên đăng nhập đã tồn tại");
    } else {

        $target_dir = "../images/res/";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $mql1 = "INSERT INTO restaurants (username, password, res_name, email, phone, url, o_hr, c_hr, o_days, address, image)
    VALUES ('$username', '$password', '$res_name', '$email', '$phone', '$url', '$o_hr', '$c_hr', '$o_days', '$address', '$image');";
        header("Location: add_restaurants.php?registed=Thêm nhà hàng thành công! Hãy gửi email đến nhà hàng thông tin để đăng nhập tài khoản Quản lí nhà hàng");

        mysqli_query($db, $mql1);

        unset($_SESSION["oldr_username"]); 
        unset($_SESSION["oldr_password"]); 
        unset($_SESSION["oldr_res_name"]); 
        unset($_SESSION["oldr_email"]); 
        unset($_SESSION["oldr_phone"]); 
        unset($_SESSION["oldr_url"]); 
        unset($_SESSION["oldr_o_hr"]); 
        unset($_SESSION["oldr_c_hr"]); 
        unset($_SESSION["oldr_o_days"]); 
        unset($_SESSION["oldr_image"]); 
        unset($_SESSION["oldr_address"]); 
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
            <li><a class="nav-link current" href="all_restaurants.php"><i style="padding-right: 7px;" class="fa fa-building"></i>Nhà hàng</a></li>
            <li><a class="nav-link" href="orders.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Đơn hàng</a></li>
            <li><a class="nav-link" href="pre_order_check.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món đợi shipper đến</a></li>
            <li><a class="nav-link" href="voucher.php"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a></li>
        </ul>

    </div>

    <div class="card card-form">
        <div class="wrapper-btn">
            <a href="add_restaurants.php" class="card-btn current">Thêm nhà hàng</a>
        </div>

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

        <div class="container">
            <form class="fill-form" action="" method="post" enctype="multipart/form-data">
                <h6 style="text-align: center;">Thông tin nhà hàng</h6>

                <div class="row">
                    <div class="col-6">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username"required=""  
                            value="<?php echo isset($_SESSION['oldr_username']) ? $_SESSION['oldr_username'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Tên đăng nhập')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="password">Mật khẩu</label>
                        <input type="text" id="password" name="password"required=""  
                        value="<?php echo isset($_SESSION['oldr_password']) ? $_SESSION['oldr_password'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Mật khẩu')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="fname">Tên nhà hàng</label>
                        <input type="text" id="" name="res_name"required=""  
                            value="<?php echo isset($_SESSION['oldr_res_name']) ? $_SESSION['oldr_res_name'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Tên nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="text" id="" name="email"required=""  
                            value="<?php echo isset($_SESSION['oldr_email']) ? $_SESSION['oldr_email'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Email')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="" name="phone"required=""  
                            value="<?php echo isset($_SESSION['oldr_phone']) ? $_SESSION['oldr_phone'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Số điện Thoại')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="url">Website nhà hàng</label>
                        <input type="text" id="" name="url"required=""  
                            value="<?php echo isset($_SESSION['oldr_url']) ? $_SESSION['oldr_url'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Website nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="o_hr">Giờ mở cửa</label>
                        <input type="text" id="" name="o_hr"required=""  
                            value="<?php echo isset($_SESSION['oldr_o_hr']) ? $_SESSION['oldr_o_hr'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Giờ mở cửa')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="c_hr">Giờ đóng cửa</label>
                        <input type="text" id="" name="c_hr"required=""  
                            value="<?php echo isset($_SESSION['oldr_c_hr']) ? $_SESSION['oldr_c_hr'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Giờ đóng cửa')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="o_days">Ngày hoạt động</label>
                        <input type="text" id="" name="o_days"required=""  
                            value="<?php echo isset($_SESSION['oldr_o_days']) ? $_SESSION['oldr_o_days'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Ngày hoạt động')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="image">Ảnh đại diện</label>
                        <input type="file" id="" name="image"required=""  
                            value="<?php echo isset($_SESSION['oldr_image']) ? $_SESSION['oldr_image'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Ảnh đại diện')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-12">
                        <label for="address">Địa chỉ nhà hàng</label>
                        <input type="text" id="" name="address"required=""  
                            value="<?php echo isset($_SESSION['oldr_address']) ? $_SESSION['oldr_address'] : ''; ?>"
                            oninvalid="this.setCustomValidity('Chưa nhập Địa chỉ nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Thêm">
                        <a href="all_restaurants.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>