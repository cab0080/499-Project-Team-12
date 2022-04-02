<?php
    session_start();
    include 'connect.php';
    $connection = OpenCon();
    $number = $_SESSION['number'];
    $sql = "UPDATE `Listing` SET `status` = 'sold' WHERE `Listing`.`MLSNumber` = '$number'";
    $connection->query($sql);
    $url = "../detailed_listing.php?number=" . $number;
    //echo "Listing sold.";
    header("Location: " . $url);
?>