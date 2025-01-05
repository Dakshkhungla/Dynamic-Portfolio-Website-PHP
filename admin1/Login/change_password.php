<?php
session_start();
include "../../include/DAO.php";

$query = getdata("SELECT * FROM basic_setup");
$data = mysqli_fetch_assoc($query);

if (!isset($_SESSION['otp'])) {
    echo "<script>window.location.href = 'index.php';</script>";
}

if (isset($_POST['sub'])) {
    $pass = $_POST['upass'];
    $cpass = $_POST['cpass'];
    if ($pass == $cpass) {
        session_destroy();
        getdata("update login set upass='" . $pass . "' where uname='admin' ");
        echo "<script>window.alert('Password Updated.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>window.alert('Password do not match.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../assets/img/<?= $data['icon'] ?>" rel="icon">
    <link href="assets/img/<?= $data['icon'] ?>" rel="apple-touch-icon">
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form " action="<?php $_SERVER['PHP_SELF']; ?> " method="POST">
                <h2>Enter New Password</h2>
                <input oninput="return formvalid()" type="password" name="upass" required placeholder="Password" id="pass" autocomplete="off" />
                <input type="text" name="cpass" placeholder="Conform password" autocomplete="off" required />
                <input type="submit" name="sub" value="Submit" />
            </form>
        </div>
    </div>
</body>

</html>