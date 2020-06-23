<?php
    setcookie('id', "", time() - 3600, "/");
    setcookie('nama', "", time() - 3600, "/");
    setcookie('username', "", time() - 3600, "/");
    setcookie('email', "", time() - 3600, "/");
    header("Location: ../login.php");
?>