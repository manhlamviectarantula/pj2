
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM voucher WHERE vou_id = '".$_GET['vou_del']."'");
header("location:voucher.php");  

?>