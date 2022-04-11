<?php
    include 'connect.php';
    include 'errorMessage.php';
    $connection = OpenCon();
    $number = $_GET['MLS'];
    $time = $_GET['time'];
    $sql = "DELETE from Showing WHERE MLSNumber='$number' AND startDatetime='$time'";
    $result = $connection->query($sql);
    if($result != 1){
        setMessage("There was an error deleting the showing <br> " . $connection->error);
    }
    header("Location: ../showing_schedule.php");
?>