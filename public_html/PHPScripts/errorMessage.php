<?php
    session_start();

    function setMessage($s){
        $_SESSION['errorMessage'] = $s;
    }

    function printMessage(){
        echo $_SESSION['errorMessage'];
        setMessage("");
    }
?>