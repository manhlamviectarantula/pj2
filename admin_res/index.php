<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = "SELECT * FROM restaurants WHERE username='$username' && password='" . md5($password) . "'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
        $_SESSION["admres_id"] = $row['rs_id'];
        header("refresh:1;url=menu.php");
    } else {
        echo "<script>alert('Invalid Username or Password!');</script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <div class="info">
            <h1>Restaurant Manager</h1>
        </div>
    </div>
    <div class="form">
        <div class="thumbnail" style="font-size: 70px;">
            <div class="fa fa-building"> </div>
        </div>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form class="login-form" action="index.php" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='js/index.js'></script>
</body>

</html>