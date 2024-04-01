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

    <section class="hero hero-image">
        <div class="hero-text">
            <div class="">
                <h1 style="font-size:4.3rem; font-weight:700;">Đặt món ngay với 3 bước</h1>
                <div class="steps">
                    <div class="step-item step1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                            <g fill="#fff">
                                <path d="M0 32C0 14.3 14.3 0 32 0H480c17.7 0 32 14.3 32 32s-14.3 32-32 32V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H304V464c0-26.5-21.5-48-48-48s-48 21.5-48 48v48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64C14.3 64 0 49.7 0 32zm96 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16zM240 96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H240zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H368c-8.8 0-16 7.2-16 16zM112 192c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H112zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H240c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H368zM328 384c13.3 0 24.3-10.9 21-23.8c-10.6-41.5-48.2-72.2-93-72.2s-82.5 30.7-93 72.2c-3.3 12.8 7.8 23.8 21 23.8H328z" />
                            </g>
                        </svg>
                        <h4><span style="color:white;">1. </span>Chọn nhà hàng</h4>
                    </div>
                    <div class="step-item step2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 448 512">
                            <g fill="#fff">
                                <path d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z" />
                            </g>
                        </svg>
                        <h4><span style="color:white;">2. </span>Chọn món ăn</h4>
                    </div>
                    <div class="step-item step3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                            <g fill="#fff">
                                <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </g>
                        </svg>
                        <h4><span style="color:white;">3. </span>Thanh toán</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular">
        <div class="container">
            <div class="text-center mb-4">
                <h1>Món ăn nổi bật trong tháng!</h1>
                <p class="lead">Top món ăn được đặt nhiều nhất trong tháng</p>
            </div>
            <div class="row">
                <?php
                $query_res = mysqli_query($db, "select * from dishes LIMIT 6");
                while ($r = mysqli_fetch_array($query_res)) {
                    echo '  <div class="col-12 col-sm-6 col-md-4">
                                            <div class="food-item">
                                                <div class="top-food-img"><img src="images/dishes/' . $r['image'] . '"></div>
                                                
                                                <div class="content">
                                                
                                                    <h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['d_name'] . '</a></h5>

                                                    <div class="foodes">' . $r['d_des'] . '</div>

                                                    <div class="price-btn-block"> 
                                                        <span class="price">' . number_format($r['price']) . '<span style="padding: 2px;">đ</span></span> 
                                                        <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right">Đặt ngay</a> 
                                                    </div>
                                                </div> 
                                            </div>
                                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="easyord">
        <div class="container">
            <div class="text-center">
                <h1 style="font-family: 'Dancing Script', cursive;">Dễ dàng đặt hàng</h1>
                <div class="row easyord-step">
                    <div class="stepe col-md-4">
                        <div class="icon" data-step="1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                                <g fill="#fff">
                                    <path d="M0 32C0 14.3 14.3 0 32 0H480c17.7 0 32 14.3 32 32s-14.3 32-32 32V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H304V464c0-26.5-21.5-48-48-48s-48 21.5-48 48v48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64C14.3 64 0 49.7 0 32zm96 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16zM240 96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H240zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H368c-8.8 0-16 7.2-16 16zM112 192c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H112zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H240c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H368zM328 384c13.3 0 24.3-10.9 21-23.8c-10.6-41.5-48.2-72.2-93-72.2s-82.5 30.7-93 72.2c-3.3 12.8 7.8 23.8 21 23.8H328z" />
                                </g>
                            </svg>
                        </div>
                        <h3>Chọn nhà hàng</h3>
                        <p>Chúng tôi cung cấp các nhà hàng theo nhiều phong cách từ các quốc gia khác nhau</p>
                    </div>
                    <div class="stepe col-md-4">
                        <div class="icon" data-step="2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 448 512">
                                <g fill="#fff">
                                    <path d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z" />
                                </g>
                            </svg>
                        </div>
                        <h3>Chọn món ăn</h3>
                        <p>Dễ dàng đặt món ăn ưa thích theo nhiều phong cách chế biến của mỗi nền văn hóa</p>
                    </div>
                    <div class="stepe col-md-4">
                        <div class="icon" data-step="3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                                <g fill="#fff">
                                    <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </g>
                            </svg>
                        </div>
                        <h3>Thanh toán</h3>
                        <p>Đa dạng phương thức thanh toán cùng những khuyến mãi hấp dẫn trong và ngoài hệ thống</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="enjoy" style="font-family: 'Dancing Script', cursive;">Chúc ngon miệng!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="popular">
        <div class="container">
            <div class="text-center mb-4">
                <h1>Nhà hàng nổi bật trong tháng!</h1>
                <p class="lead">Top nhà hàng được đặt nhiều nhất trong tháng</p>
            </div>
            <div class="row">
                <?php
                $query_res = mysqli_query($db, "select * from restaurants LIMIT 3");
                while ($r = mysqli_fetch_array($query_res)) {
                    echo '  <div class="col-12 col-sm-6 col-md-4">
                                            <div class="food-item">
                                                <div class="top-food-img"><img src="images/res/' . $r['image'] . '"></div>
                                                
                                                <div class="content">
                                                
                                                    <h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['res_name'] . '</a></h5>

                                                    <div class="foodes">' . $r['address'] . '</div>

                                                    <div class="price-btn-block"> 
                                                        <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right" style="margin-bottom: 20px;">Xem chi tiết</a> 
                                                    </div>
                                                </div> 
                                            </div>
                                    </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>