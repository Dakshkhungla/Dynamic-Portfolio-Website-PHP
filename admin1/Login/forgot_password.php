<?php
session_start();
include "../../include/DAO.php";

$query = getdata("SELECT * FROM personal_setup,basic_setup");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    $_SESSION['otp'] = floor(rand(100000, 999999));
    $msg = "The otp for password reset is " . $_SESSION['otp'];
    sendmail($email, "Reset OTP", $msg);
    echo "<script>window.location.href = 'otp.php';</script>";
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
                <h2>Forget Password?</h2>
                <input type="email" required placeholder="Email" id="user" readonly name="email" value="<?= $data['emailid']; ?>" autocomplete="off" />
                <input type="submit" name="sub" value="GET OTP" />
            </form>
        </div>
    </div>
</body>

</html>