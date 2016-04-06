<?php
    if(empty($_SESSION['myusername']) || empty($_SESSION['mypassword'])){
        header('Location: /root/PS/access_denied.php');
    }
?>