<?php
session_start();
unset($_SESSION["admres_id"]); 
$url = 'index.php';
header('Location: ' . $url);

?>
