<?php
    session_start();
    include 'connect.php';

    
    $listingNumber = $_SESSION['number'];
    
    function getBathrooms(){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bathroomCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bathroom'");
        $row = $result->fetch_assoc();
        echo $row['bathroomCount'];
    }

    function getBedrooms(){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bedCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bedroom'");
        $row = $result->fetch_assoc();
        echo $row['bedCount'];
    }

    function getPrice(){ //This function should echo the most recent price that has been added for this property
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `ListingPrice` WHERE MLSNumber = '$listingNumber' ORDER BY changedDatetime DESC");
        $row = $result->fetch_assoc();
        echo $row['price'];
    }

    function getArea(){
        $connection = OpenCon();
        $result = $connection->query("SELECT area FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        echo $result; //THIS IS FOR TESTING
    }

    function getLotsize(){
        $connection = OpenCon();
        $result = $connection->query("SELECT lotSize FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        echo $row['lotSize'];
    }
    
?>