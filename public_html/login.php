<?php
    $servername = "avgmzvmy_WPQDF";
    $SQLusername = "admin";
    $SQLpassword = "preston";

    $username = $_POST['username']; //The username entered by the user
    $password = $_POST['password']; //The password entered by the user
    $connection = new mysqli($servername, $SQLusername, $SQLpassword);

    if($connection->connect_error){
        echo "Connection failed";
        die();
    }

    echo "Connection successful";
?>