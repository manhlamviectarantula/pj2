<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
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
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="step-links">
        <div class="top-links">
            <div class="container">
                <ul class="row slink">
                    <li class="col-12 col-sm-4 link-item active"><span>1</span><a href="#">Chọn nhà hàng</a></li>
                    <li class="col-12 col-sm-4 link-item"><span>2</span><a href="#">Chọn món ăn</a></li>
                    <li class="col-12 col-sm-4 link-item"><span>3</span><a href="#">Thanh toán</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="restaurants-option">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-gray restaurant-entry">
                        <div class="row">
                            <?php $ress = mysqli_query($db, "select * from restaurants");
                            while ($rows = mysqli_fetch_array($ress)) {
                                echo ' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">

															<div class="entry-logo">
																<a href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="./images/res/' . $rows['image'] . '" alt="Food logo"></a>
															</div>

															<div class="entry-dscr">
																<h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['res_name'] . '</a></h5>
                                                                <span>' . $rows['address'] . '</span>
															</div>

										</div>
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">

																<div class="right-content bg-white">
																	<div class="right-review">
																		<a href="dishes.php?res_id=' . $rows['rs_id'] . '" class="btn-view-res">Xem menu</a> 
                                                                    </div>
																</div>

										</div> ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('footer.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>