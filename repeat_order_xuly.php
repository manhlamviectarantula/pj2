<?php
include("./connection/connect.php");
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