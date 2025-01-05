<?php
session_start();
include "../../include/DAO.php";

$query = getdata("SELECT * FROM basic_setup");
$data = mysqli_fetch_assoc($query);

if (!isset($_SESSION['otp'])) {
    echo "<script>window.location.href = 'index.php';</script>";
}

if (isset($_POST['sub'])) {
    $otp = $_POST['otp'];
    if ($otp == $_SESSION['otp']) {

        // Using JavaScript for redirection
        echo "<script>window.location.href = 'change_password.php';</script>";
    } else {
        echo "<script>window.alert('Invalid OTP,Please Enter Correct OTP.');</script>";
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
                <h2>Enter OTP</h2>
                <input type="number" required placeholder="OTP" id="user" name="otp" autocomplete="off" />
                <input type="submit" name="sub" value="Submit" />
            </form>
        </div>
    </div>
</body>

</html>