<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    header("location:index-2.html");
}

function getdata($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    return $result;
}

function close($conn)
{
    global $conn;
    mysqli_close($conn);
}

function sendmail($email, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'passreset481@gmail.com';
        $mail->Password   = 'rrcoxxrxdkguckps';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('passreset481@gmail.com');
        $mail->addAddress($email);
        $mail->addReplyTo('passreset481@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "
            <script>
            alert('Message was sent successfully. Thank your for reaching us!');
            </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
