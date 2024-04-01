<?php
include("../connection/connect.php"); //connection to db
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM momo WHERE o_id = '".$_GET['order_del']."'"); 

mysqli_query($db,"DELETE FROM detail_orders WHERE o_id = '".$_GET['order_del']."'"); 

// sending query
mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'"); 
header("location:orders.php"); 

?>
