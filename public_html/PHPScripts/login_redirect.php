<?php

    /*
        This file is currently not used for anything
    */
    if($_SESSION['loggedin'])
    {
        header("Location: ../index.php");
    }
    else
    {
        header("Location: ../login_page.php");
    }
?>