<?php
    session_start();
    include 'connect.php'; //include the script that opens the database connection
    include 'errorMessage.php';
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
            //printMessage();
            setMessage("Error: username not found");
            CloseCon($connection);
            header("Location: ../login_page.php");
        }
        else if($result->num_rows == 1){
            $passhash = $result->fetch_assoc()["passHash"];
            //echo "username found in database!<br />Checking password...";
            if(password_verify($form_password, $passhash)){
                //If the login is successful, set the session username and the session logged in status
                $_SESSION['username'] = $form_username;
                $_SESSION['loggedin'] = true;
                //echo "Login successful! <br /><a href='../index.php'>Click here to go back home</a>";
                CloseCon($connection);
                header("Location: ../index.php");
            }
            else{
                setMessage("Error: incorrect password");
                CloseCon($connection);
                header("Location: ../login_page.php");
            }
        }
        else{
            setMessage("Error: There are more than one users with this username");
            CloseCon($connection);
            header("Location: ../login_page.php");
        }
    }
?>