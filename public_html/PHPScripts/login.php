<?php
    include 'connect.php'; //include the script that opens the database connection
    //include 'login_redirect.php';
    $connection = OpenCon();
    $form_username = $_POST['username']; //this is the username that is entered by the site visitor
    $form_password = $_POST['password']; //This is the password that the user entered
     
    //Now, let's run an SQL query and save those results in a variable
    $result = $connection->query("SELECT * FROM `Agent` WHERE `username` LIKE '$form_username'");

    //First, make sure something has been entered before we check things
    if($form_username != '')
    {
        //Find out if there is exactly one result, otherwise we have a problem
        if($result->num_rows == 0){
            echo "Error: username not found";
        }
        else if($result->num_rows == 1){
            $passhash = $result->fetch_assoc()["passHash"];
            //echo "username found in database!<br />Checking password...";
            if(password_verify($form_password, $passhash)){
                //If the login is successful, set the session username and the session logged in status
                $_SESSION['username'] = $form_username;
                $_SESSION['loggedin'] = true;
                echo "Login successful! <br /><a href='../index.php'>Click here to go back home</a>";
            }
            else{
                echo "Error: incorrect password.";
            }
        }
        else{
            echo "Error: There are more than one users with this username";
        }
    }
?>