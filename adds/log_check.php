<?php
    if(empty($_SESSION['myemail']) || empty($_SESSION['mypassword'])){
        header('Location: /root/PS/index.php');
    }
?>