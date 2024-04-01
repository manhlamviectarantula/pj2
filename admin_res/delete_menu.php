
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM dishes WHERE d_id = '".$_GET['dis_del']."'");
header("location:menu.php");  

?>
