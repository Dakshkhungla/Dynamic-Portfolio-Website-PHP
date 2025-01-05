<?php
include 'DAO.php';

if (isset($_POST['name'])) {
    getdata("insert into contact(cname,csubject,cemail,cmessage) values('" . $_POST['name'] . "','" . $_POST['subject'] . "','" . $_POST['email'] . "','" . $_POST['message'] . "')");
    echo "<script>window.alert('Message Sent!!');
            window.location.href='index.php';
    </script>";
}
