<?php
    include 'connect.php';
    

    function returnListing($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function getBathrooms($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bathroomCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bathroom'");
        $row = $result->fetch_assoc();
        echo $row['bathroomCount'];
        CloseCon($connection);
    }

    function getBedrooms($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bedCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bedroom'");
        $row = $result->fetch_assoc();
        echo $row['bedCount'];
        CloseCon($connection);
    }

    function getPrice($listingNumber){ //This function should echo the most recent price that has been added for this property
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `ListingPrice` WHERE MLSNumber = '$listingNumber' ORDER BY changedDatetime DESC");
        $row = $result->fetch_assoc();
        echo $row['price'];
        CloseCon($connection);
    }

    function getArea($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT area FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        echo $row['area'];
        CloseCon($connection);
    }

    function getLotsize($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT lotSize FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        echo $row['lotSize'];
        CloseCon($connection);
    }

    function getAddress($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        echo $row['street'] . ", " . $row['city'] . ", " . $row['state'] . " " . $row['zip'];
        CloseCon($connection);
    }

    function getPropertyType($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['dwellingType'];
    }

    function getFenced($listingNumber){
        $row = returnListing($listingNumber);
        if($row['fencing'] == 0){
            echo "No";
        }
        else{
            echo "Yes";
        }
    }

    function getGarage($listingNumber){
        $row = returnListing($listingNumber);
        if($row['detachedGarage'] == 0){
            echo "No";
        }
        else{
            echo "Yes";
        }
    }

    function getPropertyDescription($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['description'];
    }

    function getSubdivision($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['subdivision'];
    }

    function getElementary($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['elemSchoolDisctrict'];//typo on the database column LOL
    }

    function getMiddle($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['midSchoolDistrict'];
    }

    function getHigh($listingNumber){
        $row = returnListing($listingNumber);
        echo $row['highSchoolDistrict'];
    }


    
?>