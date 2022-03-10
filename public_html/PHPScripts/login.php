<?php
    include 'connect.php'; //include the script that opens the database connection
    $connection = OpenCon();
    $form_username = $_POST['username']; //this is the username that is entered by the site visitor
     
    //Now, let's run an SQL query and save those results in a variable
    $result = $connection->query("SELECT * FROM `Agent` WHERE `username` LIKE '$form_username'");

    
    //echo how many results actually showed up here
    $numberOfResults = $result->num_rows;
    if($numberOfResults == 0){
        echo "We did NOT get results";
        echo "<br />The username we searched for was " . $form_username;
        echo "<br />The query that we ran was " . "SELECT * FROM `Agent` WHERE `username` LIKE '$form_username'";
    }
    else if($numberOfResults == 1){
        echo "We got this many results: " . $numberOfResults;
        echo "<br />This person's email address is " . $result->fetch_assoc()["email"];
    }
    /*echo "The name is: ";
    echo $_POST['username'];*/
?>