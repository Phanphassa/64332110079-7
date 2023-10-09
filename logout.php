<?php

session_start();

if (isset($_SESSION['username'])) {

    session_unset(); 
    session_destroy(); 

    echo '<script>alert("ออกจากระบบแล้ว");</script>';
}


header('Location: login.php');
exit;
?>