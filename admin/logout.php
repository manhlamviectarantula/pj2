<?php
session_start();
$_SESSION["adm_id"];
$url = 'index.php';
header('Location: ' . $url);

?>
