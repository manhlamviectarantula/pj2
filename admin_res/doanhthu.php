<!DOCTYPE html>
<html lang="en">

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
            <li><a class="nav-link" href="info_res.php"><i style="padding-right: 7px;" class="fa fa-folder-open"></i>Thông tin nhà hàng</a></li>
            <li><a class="nav-link" href="pre_order.php"><i style="padding-right: 7px;" class="fa fa-file-text-o"></i>Món cần làm</a></li>
            <li><a class="nav-link current" href="doanhthu.php"><i style="padding-right: 7px;" class="fa fa-usd"></i>Doanh thu</a></li>
        </ul>

    </div>

    <div class="card card-form">
        Tính năng chưa được phát triển
    </div>

</body>

</html>