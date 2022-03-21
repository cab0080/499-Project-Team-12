<?php
    function loginAndRedirect($username){
        //This function sets login variables and redirects back to the home page
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        echo "You have successfully logged in!<br />
        Click the button to go back home <br />
        Maybe one day I will redirect you by myself...";
    }
?>