<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
include_once 'product-action.php';
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
                    <li class="col-12 col-sm-4 link-item"><span>1</span><a href="#">Chọn nhà hàng</a></li>
                    <li class="col-12 col-sm-4 link-item active"><span>2</span><a href="#">Chọn món ăn</a></li>
                    <li class="col-12 col-sm-4 link-item"><span>3</span><a href="checkout.php">Thanh toán</a></li>
                </ul>
            </div>
        </div>
    </section>


    <section class="profile res hero hero-image bgh">
        <?php $ress = mysqli_query($db, "select * from restaurants where rs_id='$_GET[res_id]'");
        $rows = mysqli_fetch_array($ress); ?>
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                        <div class="image-wrap">
                            <figure><?php echo '<img src="./images/res/' . $rows['image'] . '" alt="Restaurant logo">'; ?></figure>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                        <div class="pull-left right-text">
                            <h6><a href="#"><?php echo $rows['res_name']; ?></a></h6>
                            <p><?php echo $rows['address']; ?></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <section class="dishes">
        <div class="container">
            <div class="row dishes-form">

                <div class="foodi col-7 ">
                    <h3 style="text-align:center; font-weight:bold; text-decoration: underline; margin-bottom:30px;">Menu</h3>

                    <?php
                    $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                    $stmt->execute();
                    $products = $stmt->get_result();
                    if (!empty($products)) {
                        foreach ($products as $product) {
                    ?>

                            <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                <div class="food-item1">
                                    <div class="row">
                                        <div class="food-image col-3">
                                            <a class="" href="#"><?php echo '<img src="images/dishes/' . $product['image'] . '" alt="Food logo">'; ?></a>
                                        </div>

                                        <div class="food-des col-6">
                                            <h6><a href="#"><?php echo $product['d_name']; ?></a></h6>
                                            <p> <?php echo $product['d_des']; ?></p>
                                        </div>

                                        <div class="cart-info col-3">
                                            <span class="">Giá: <?php echo number_format($product['price']); ?> đ</span>
                                            <div>Số lượng: <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" ></div>

                                            <input type="submit" class="" value="Thêm" />
                                        </div>
                                    </div>
                                </div>
                            </form>

                    <?php
                        }
                    }
                    ?>
                </div>


                <div class="your-cart col-4 pull-right">
                    <h3 style="text-align:center; font-weight:bold; text-decoration: underline; margin-bottom:30px;">Giỏ hàng</h3>
                    <div>
                        <div class="">
                            <?php
                            $item_total = 0;
                            foreach ($_SESSION["cart_item"] as $item) {
                            ?>

                                <div class="title-row">
                                    <?php echo $item["d_name"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutters">
                                    <div class="col-8">
                                        <input type="text" class="form-control b-r-0" value=<?php echo number_format($item["price"]) . "đ"; ?> readonly id="exampleSelect1">
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>
                                </div>

                            <?php
                                $item_total += ($item["price"] * $item["quantity"]);
                            }
                            ?>
                        </div>

                        <div class="">
                            <div class="text-center">
                                <p>Tổng cộng:</p>
                                <h3 class="value"><strong><?php echo number_format($item_total) . " đ" ?></strong></h3>
                                <?php
                                if ($item_total == 0) {
                                ?>
                                    <a href="checkout.php?res_id=<?php echo number_format($_GET['res_id']); ?>&action=check" class="btn btn-danger btn-lg disabled">Thanh toán</a>

                                <?php
                                } else {
                                ?>
                                    <a href="checkout.php?res_id=<?php echo number_format($_GET['res_id']); ?>&action=check" class="btn btn-success btn-lg active">Thanh toán</a>
                                <?php
                                }
                                ?>
                            </div>
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