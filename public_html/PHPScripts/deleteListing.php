<?php
    session_start();
    $mls = $_SESSION['number'];
    include 'connect.php';
    include 'errorMessage.php';
    //This script will delete a posting from the database.
    $connection = OpenCon();
    $sql = "DELETE FROM Listing WHERE `MLSNumber` = '$mls'";
    $result = $connection->query($sql);
    if($result == 1){
        header("Location: ../index.php");
    }
    else{
        setMessage("There was an error removing the post from the database<br>" . $connection->error);
        header("Location: ../index.php");
    }
?>