<?php
    include 'connect.php'; //include the script that opens the database connection
    $connection = OpenCon();
    $form_username = $_POST['username']; //this is the username that is entered by the site visitor
    $form_password = $_POST['password']; //This is the password that the user entered
     
    //Now, let's run an SQL query and save those results in a variable
    $result = $connection->query("SELECT * FROM `Agent` WHERE `username` LIKE '$form_username'");

    
    //Find out if there is exactly one result, otherwise we have a problem
    if($result->num_rows == 0){
        echo "This username was not found.";
    }
    else if($result->num_rows == 1){
        $passhash = $result->fetch_assoc()["passHash"];
        echo "username found in database!<br />Checking password...";
        if(password_verify($form_password, $passhash)){
            echo "You have successfully logged in!";
            //If the login is successful, set the session username and the session logged in status
            $_SESSION['username'] = $form_username;
            $_SESSION['loggedin'] = true;
        }
        else{
            echo "You entered the wrong password!";
        }
    }
    else{
        echo "Error: There are more than one users with this username";
    }
?>