<?php
session_start();
include "../../include/DAO.php";

$query = getdata("SELECT * FROM basic_setup");
$data = mysqli_fetch_assoc($query);
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
<?php
if (isset($_POST['sub'])) {
    $uname = $_POST['uname'];
    $upass = $_POST['upass'];

    $sql = "select * from login where uname='" . $uname . "' and upass='" . $upass . "'";
    $result = getdata($sql);

    if (mysqli_num_rows($result)) {
        header("Location: ../index.php");
        $_SESSION['uname'] = $uname;
    } else {
        echo "<script>window.alert('Invalid Username or Password');</script>";
    }
}
?>

<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form " action="<?php $_SERVER['PHP_SELF']; ?> " method="POST">
                <h2>SIGN IN TO YOUR ACCOUNT</h2>
                <input type="text" required placeholder="Username" id="user" name="uname" autocomplete="off" />
                <input oninput="return formvalid()" type="password" name="upass" required placeholder="Password" id="pass" autocomplete="off" />
                <img src="https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png" onclick="show()" id="showimg">
                <span id="vaild-pass"></span>
                <input type="submit" name="sub" value="Log In" />
                <p class="message"><a href="forgot_password.php">Forgot your password?</a></p>
            </form>
        </div>
    </div>
</body>

</html>