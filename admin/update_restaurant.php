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

$_SESSION["res_upd"] = $_GET['res_upd'];

if (isset($_POST['submit'])) {
    $res_name = ($_POST['res_name']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);
    $url = ($_POST['url']);
    $o_hr = ($_POST['o_hr']);
    $c_hr = ($_POST['c_hr']);
    $o_days = ($_POST['o_days']);
    $address = ($_POST['address']);

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header("Location: update_restaurant.php?error=Email không hợp lệ&res_upd=" . $_SESSION["res_upd"]);
    } elseif (strlen($_POST['phone']) < 10) {
        header("Location: update_restaurant.php?error=Số điện thoại không hợp lệ&res_upd=" . $_SESSION["res_upd"]);
    } else
        // Kiểm tra nếu có tệp ảnh mới được tải lên
        if ($_FILES['image']['name'] != '') {
            $image = basename($_FILES['image']['name']);
            $target_dir = "../images/res/";
            $target_file = $target_dir . $image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            // Cập nhật cơ sở dữ liệu với ảnh mới
            $mql1 = "update restaurants set res_name='$res_name', email='$email', phone='$phone', url='$url', o_hr='$o_hr', c_hr='$c_hr', o_days='$o_days',
                address='$address', image='$image' where rs_id='" . $_GET['res_upd'] . "' ";

            header("Location: update_restaurant.php?registed=Cập nhật thông tin thành công&res_upd=" . $_SESSION["res_upd"]);

            unset($_SESSION["res_upd"]);
        } else {
            // Chỉ cập nhật cơ sở dữ liệu mà không thay đổi ảnh
            $mql1 = "update restaurants set res_name='$res_name', email='$email', phone='$phone', url='$url', o_hr='$o_hr', c_hr='$c_hr', o_days='$o_days',
                address='$address' where rs_id='" . $_GET['res_upd'] . "' ";

            header("Location: update_restaurant.php?registed=Cập nhật thông tin thành công&res_upd=" . $_SESSION["res_upd"]);

            unset($_SESSION["res_upd"]);
        }

    mysqli_query($db, $mql1);
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
            <a href="add_restaurants.php" class="card-btn">Thêm nhà hàng</a>
        </div>

        <div class="container">
            <form class="fill-form" action="" method="post" enctype="multipart/form-data">
                <?php $ssql = "select * from restaurants where rs_id='$_GET[res_upd]'";
                $res = mysqli_query($db, $ssql);
                $row = mysqli_fetch_array($res); ?>

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

                <h6 style="text-align: center;">Thông tin nhà hàng</h6>
                <div class="row">
                    <div class="col-6">
                        <label for="fname">Tên nhà hàng</label>
                        <input type="text" id="" name="res_name" value="<?php echo $row['res_name'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Tên nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="text" id="" name="email" value="<?php echo $row['email'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Email')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="phone">Số diện thoại</label>
                        <input type="text" id="" name="phone" value="<?php echo $row['phone'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Số diện thoại')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="url">Website nhà hàng</label>
                        <input type="text" id="" name="url" value="<?php echo $row['url'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Website nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="o_hr">Giờ mở cửa</label>
                        <input type="text" id="" name="o_hr" value="<?php echo $row['o_hr'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Giờ mở cửa')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="c_hr">Giờ đóng cửa</label>
                        <input type="text" id="" name="c_hr" value="<?php echo $row['c_hr'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Giờ đóng cửa')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="o_days">Ngày hoạt động</label>
                        <input type="text" id="" name="o_days" value="<?php echo $row['o_days'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Ngày hoạt động')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="image">Ảnh đại diện</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="col-12">
                        <label for="address">Địa chỉ nhà hàng</label>
                        <input type="text" id="" name="address" value="<?php echo $row['address'];  ?>"required=""  
                            oninvalid="this.setCustomValidity('Chưa nhập Địa chỉ nhà hàng')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Lưu">
                        <a href="all_restaurants.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>