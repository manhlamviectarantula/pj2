<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();

function function_alert()
{
    echo "<script>alert('Đặt hàng thành công!');</script>";
    echo "<script>window.location.replace('your_orders.php');</script>";
}

$search = array(',', 'đ');
$replace = array('', '');
$re_total = str_replace($search, $replace, $_POST['tongtien']);

$_SESSION['o_id'] = $_GET['order_repeat'];


if (isset($_POST['submit'])) {

    $sql_users_orders = "INSERT INTO users_orders (u_id, total, payment) VALUES ('" . $_SESSION["user_id"] . "', '" . $re_total . "', 'Tiền mặt')";

    if (mysqli_query($db, $sql_users_orders)) {

        $last_id = mysqli_insert_id($db);
        $sql1 = mysqli_query($db, "SELECT * FROM detail_orders INNER JOIN dishes ON detail_orders.d_id = dishes.d_id  WHERE o_id = '" . $_GET['order_repeat'] . "'");
        while ($item1 = mysqli_fetch_array($sql1)) {

            $d_id = $item1['d_id'];
            $quantity = $item1['quantity'];
            $price = $item1['price'];
            $vou_id = $item1['vou_id'];

            $sql_detail_orders = "INSERT INTO detail_orders (o_id, d_id, quantity, price,vou_id) VALUES ('" . $last_id . "', '$d_id',
                 '$quantity', '$price','$vou_id')";
            mysqli_query($db, $sql_detail_orders);
        }
    }

    function_alert();
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
                    <li class="col-12 col-sm-4 link-item"><span>2</span><a href="#">Chọn món ăn</a></li>
                    <li class="col-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Thanh toán</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="check-bill">
        <!-- <form action="" method="post"> -->
        <form action="" method="post">

            <h4>Hóa đơn</h4>
            <table class="table">
                <?php
                $item_total = 0;
                ?>

                <tbody>
                    <?php
                    $sql = mysqli_query($db, "SELECT * FROM detail_orders INNER JOIN dishes ON detail_orders.d_id = dishes.d_id  WHERE o_id = '" . $_GET['order_repeat'] . "'");
                    while ($item = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $item["d_name"]; ?></td>
                            <td><?php echo number_format($item["price"]) . "đ"; ?></td>
                            <td>Số lượng: <?php echo $item["quantity"]; ?></td>
                        </tr>
                    <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                    }
                    ?>
                    <tr>
                        <td style="font-weight: bold;">Tổng giá món ăn</td>
                        <td> <?php echo number_format($item_total) . " đ"; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Phí vận chuyển</td>
                        <td>Free</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Voucher</td>
                        <td>Không có</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Tổng cộng đơn hàng</td>
                        <td><input style="background-color: white; padding: 0; margin: 0; font-weight: bold;" type="text" name="total" value="<?php echo number_format($item_total) . " đ"; ?>"></atd>
                        <td></td>
                    </tr>
            </table>

        </form>

        <!-- <form action="repeat_order_xuly.php" method="post"> -->
        <form action="" method="post">
            <div style="margin-bottom: 10px;">
                <input type="hidden" name="tongtien" value="<?php echo $item_total ?>">
                <input name="submit" value="Thanh toán khi nhận hàng" onclick="return confirm('Bạn có chắc chắn muốn đặt hàng không?');" class="btn btn-primary" type="submit"></input>
            </div>
        </form>

        <!-- Form cho Thanh toán qua QR Momo -->
        <form action="xulythanhtoanmomo_qr.php" enctype="application/x-www-form-urlencoded" method="post">
            <div style="margin-bottom: 10px;">
                <input type="hidden" name="tongtien" value="<?php echo $item_total ?>">
                <button class="btn btn-primary" type="submit">Thanh toán qua QR Momo</button>
            </div>
        </form>

        <!-- Form cho Thanh toán qua Momo ATM -->
        <form action="xulythanhtoanmomo_repeat_atm.php" enctype="application/x-www-form-urlencoded" method="post">
            <div style="margin-bottom: 10px;">
                <input type="hidden" name="tongtien" value="<?php echo $item_total ?>">
                <button class="btn btn-primary" type="submit">Thanh toán qua Momo ATM</button>
            </div>
        </form>
        <!-- <div class="payment-option">
                    <ul class="list-unstyled">
                        <li>
                            <label class="custom-control custom-radio m-b-10">
                                <input name="mod" type="radio" value="bank_transfer" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Tài khoản ngân hàng <img src="images/paypal.jpg" alt="" width="90"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio m-b-10">
                                <input name="mod" type="radio" value="momo" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Momo<img src="images/paypal.jpg" alt="" width="90"></span>
                            </label>
                        </li>
                        <li>
                            <label for="radioStacked1" class="custom-control custom-radio m-b-20">
                                <input name="mod" id="radioStacked1" value="COD" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Thanh toán khi nhận hàng</span>
                            </label>
                        </li>
                    </ul>
                    <input type="submit" onclick="return confirm('Bạn có chắc chắn muốn đặt hàng không?');" name="submit" class="btn btn-success btn-block" value="Đặt hàng">
                </div> -->
        <!-- <div class="payment-option">
                <ul class=" list-unstyled">
                    <li>
                        <label class="custom-control custom-radio  m-b-20">
                            <input name="mod" id="radioStacked1" value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thanh toán khi nhận hàng</span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-control custom-radio  m-b-10">
                            <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Tài khoản ngân hàng <img src="images/paypal.jpg" alt="" width="90"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-control custom-radio  m-b-10">
                            <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Momo<img src="images/paypal.jpg" alt="" width="90"></span>
                        </label>
                    </li>
                </ul>
                <p class="text-xs-center"> <input type="submit" onclick="return confirm('Xác nhận đặt hàng?');" name="submit" class="btn btn-success btn-block" value="Đặt hàng"> </p>
            </div> -->
        <!-- </form> -->
    </section>

    <?php include('footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>