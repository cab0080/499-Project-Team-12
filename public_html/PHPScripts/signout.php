<?php
    session_start();
    $_SESSION['username'] = "";
    $_SESSION['loggedin'] = false;
    header("Location: ../index.php");
?>