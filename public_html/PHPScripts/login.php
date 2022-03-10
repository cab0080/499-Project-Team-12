<?php
    include 'connect.php'; //include the script that opens the database connection
    $connection = OpenCon();
    $form_username = $_POST['username']; //this is the username that is entered by the site visitor
    
    if($result = $connection->query("SELECT * FROM `Agent` WHERE `username` LIKE $form_username")){
        echo "We got something! the email for this user is: " . $result->fetch_assoc()["email"];
    }
    else{
        echo "Can't find this user";
    }
    /*echo "The name is: ";
    echo $_POST['username'];*/
?>