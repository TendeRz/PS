<?php
    if(empty($_SESSION['myemail']) || empty($_SESSION['mypassword'])){
        header('Location: /root/PS/access_denied.php');
    }
?>