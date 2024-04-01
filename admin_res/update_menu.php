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
$ssql = "select * from dishes where d_id='$_GET[dis_upd]'";
$res = mysqli_query($db, $ssql);
$row = mysqli_fetch_array($res);

$_SESSION["dis_upd"] = $_GET['dis_upd'];
if (isset($_POST['submit'])) {
    $d_name = ($_POST['d_name']);
    $d_des = ($_POST['d_des']);
    $price = str_replace(',', '', $_POST['price']);

    if ($_FILES['image']['name'] != '') {

        $image = basename($_FILES['image']['name']);
        $target_dir = "../images/dishes/";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $mql = "update dishes set d_name='$d_name', d_des='$d_des', price='$price', image='$image' where d_id='" . $_GET['dis_upd'] . "' ";

        header("Location: update_menu.php?registed=Cập nhật món ăn thành công&dis_upd=" . $_SESSION["dis_upd"]);
    } else {
        $mql = "update dishes set d_name='$d_name', d_des='$d_des', price='$price' where d_id='" . $_GET['dis_upd'] . "' ";
        header("Location: update_menu.php?registed=Cập nhật món ăn thành công&dis_upd=" . $_SESSION["dis_upd"]);
    }
    mysqli_query($db, $mql);
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
            <li><a class="nav-link current" href="menu.php"><i style="padding-right: 7px;" class="fa fa-cutlery"></i>Menu</a></li>
            <li><a class="nav-link" href="info_res.php"><i style="padding-right: 7px;" class="fa fa-folder-open"></i>Thông tin nhà hàng</a></li>
            <li><a class="nav-link" href="pre_order.php"><i style="padding-right: 7px;" class="fa fa-bell-o"></i>Món cần chuẩn bị</a></li>
        </ul>

    </div>

    <div class="card card-form">
        <div class="wrapper-btn">
            <a href="add_menu.php" class="card-btn">Thêm món ăn</a>
        </div>

        <div class="container">
            <form class="fill-form" action="" method="post" enctype="multipart/form-data">
                <?php $ssql = "select * from dishes where d_id='$_GET[dis_upd]'";
                $res = mysqli_query($db, $ssql);
                $row = mysqli_fetch_array($res); ?>
                <?php if (isset($_GET['registed'])) { ?>
                    <div class="col-sm-12">
                        <p class="registed"><?php echo $_GET['registed']; ?></p>
                    </div>
                <?php } ?>
                <h6 style="text-align: center;">Thông tin món ăn</h6>
                <div class="row">
                    <div class="col-6">
                        <label for="fname">Tên món ăn</label>
                        <input type="text" id="" name="d_name" value="<?php echo $row['d_name'];  ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Tên món ăn')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="email">Mô tả</label>
                        <input type="text" id="" name="d_des" value="<?php echo $row['d_des'];  ?>" required="" oninvalid="this.setCustomValidity('Chưa nhập Mô tả')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-6">
                        <label for="phone">Giá</label>
                        <input type="text" id="" name="price" oninput="formatCurrency(this)" value="<?php echo number_format($row['price']) . " đ" ?>">
                    </div>
                    <div class="col-6">
                        <label for="image">Ảnh món ăn</label>
                        <input type="file" id="" name="image">
                    </div>
                    <div class="form-buttons">
                        <input type="submit" name="submit" class="btn btn-save" value="Lưu">
                        <a href="menu.php" class="btn btn-cancel">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>