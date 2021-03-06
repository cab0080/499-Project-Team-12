<?php
    include 'connect.php';
    

    function returnListing($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function returnUnsoldListing($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `UnsoldListing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function returnAgency($listingNumber){
        $agency = returnAgent($listingNumber)['agencyID'];
        $sql = "SELECT * FROM `Agency` WHERE agencyID = '$agency'";
        $connection = OpenCon();
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function returnAgent($listingNumber){
        $agent = returnListing($listingNumber)['listingAgentUsername'];
        $sql = "SELECT * FROM  Agent WHERE username = '$agent'";
        $connection = OpenCon();
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function getBathrooms($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bathroomCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bathroom'");
        $row = $result->fetch_assoc();
        return $row['bathroomCount'];
        CloseCon($connection);
    }

    function getBedrooms($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT type, COUNT(*) AS bedCount FROM Room WHERE MLSNumber = '$listingNumber' AND type='Bedroom'");
        $row = $result->fetch_assoc();
        return $row['bedCount'];
        CloseCon($connection);
    }

    function getPrice($listingNumber){ //This function should echo the most recent price that has been added for this property
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `ListingPrice` WHERE MLSNumber = '$listingNumber' ORDER BY changedDatetime DESC");
        $row = $result->fetch_assoc();
        return number_format($row['price']);
        CloseCon($connection);
    }

    function getArea($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT area FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return number_format($row['area']);
        CloseCon($connection);
    }

    function getLotsize($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT lotSize FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['lotSize'];
        CloseCon($connection);
    }

    function getAddress($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT * FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['street'] . ", " . $row['city'] . ", " . $row['state'] . " " . $row['zip'];
        CloseCon($connection);
    }

    function getStreet($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT street FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['street'];
        CloseCon($connection);
    }

    function getCity($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT city FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['city'];
        CloseCon($connection);
    }

    function getState($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT state FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['state'];
        CloseCon($connection);
    }

    function getZip($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT zip FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['zip'];
        CloseCon($connection);
    }

    function getOccupied($listingNumber){
        $connection = OpenCon();
        $result = $connection->query("SELECT occupied FROM `UnsoldListing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        return $row['occupied'];
        CloseCon($connection);
    }

    function getPropertyType($listingNumber){
        $row = returnListing($listingNumber);
        return $row['dwellingType'];
    }

    function getFenced($listingNumber){
        $row = returnListing($listingNumber);
        if($row['fencing'] == 0){
            return "No";
        }
        else{
            return "Yes";
        }
    }

    function getGarage($listingNumber){
        $row = returnListing($listingNumber);
        if($row['detachedGarage'] == 0){
            return "No";
        }
        else{
            return "Yes";
        }
    }

    function getPropertyDescription($listingNumber){
        $row = returnListing($listingNumber);
        return $row['description'];
    }

    function getSubdivision($listingNumber){
        $row = returnListing($listingNumber);
        return $row['subdivision'];
    }

    function getElementary($listingNumber){
        $row = returnListing($listingNumber);
        return $row['elemSchoolDisctrict'];//typo on the database column LOL
    }

    function getMiddle($listingNumber){
        $row = returnListing($listingNumber);
        return $row['midSchoolDistrict'];
    }

    function getHigh($listingNumber){
        $row = returnListing($listingNumber);
        return $row['highSchoolDistrict'];
    }

    function getArmCode($listingNumber){
        $row = returnUnsoldListing($listingNumber);
        return $row['armCode'];
    }

    function getDisarmCode($listingNumber){
        $row = returnUnsoldListing($listingNumber);
        return $row['disarmCode'];
    }

    function getPassCode($listingNumber){
        $row = returnUnsoldListing($listingNumber);
        return $row['passcode'];
    }

    function getAlarmNotes($listingNumber){
        $row = returnUnsoldListing($listingNumber);
        return $row['alarmNotes'];
    }

    function getLockCode($listingNumber){
        $row = returnUnsoldListing($listingNumber);
        return $row['lockboxCode'];
    }

    function getAgency($listingNumber){
        $agency = returnAgency($listingNumber);
        return $agency['name'];
    }

    function getAgencyAddress($listingNumber){
        $agency = returnAgency($listingNumber);
        return $agency['street'] . ", " . $agency['city'] . ", " . $agency['state'] . " " .$agency['zip'];
    }

    function getAgencyPhone($listingNumber){
        $agency = returnAgency($listingNumber);
        $first3 = substr($agency['phoneNum'], 0, 3);
        $next3 = substr($agency['phoneNum'], 3, 3);
        $last4 = substr($agency['phoneNum'], 6, 4);
        return "(" . $first3 . ") " . $next3 . "-" . $last4;
    }
    
    function getAgentName($listingNumber){
        $agent = returnAgent($listingNumber);
        echo $agent['firstName'] . " " . $agent['lastName'];
    }

    function getAgentPhone($listingNumber){
        $agent = returnAgent($listingNumber);
        $first3 = substr($agent['phoneNum'], 0, 3);
        $next3 = substr($agent['phoneNum'], 3, 3);
        $last4 = substr($agent['phoneNum'], 6, 4);
        echo "(" . $first3 . ") " . $next3 . "-" . $last4;
    }

    function getAgentEmail($listingNumber){
        $agent = returnAgent($listingNumber);
        echo $agent['email'];
    }

    function returnAgentEmail($listingNumber){
        $agent = returnAgent($listingNumber);
        return $agent['email'];
    }

    function getAgentUsername($listingNumber){
        $agent = returnAgent($listingNumber);
        return $agent['username'];
    }

    function getPriceDateTime($listingNumber){
        $connection = OpenCon();
        $sql = "SELECT * FROM `ListingPrice` WHERE MLSNumber = '$listingNumber' ORDER BY `changedDatetime` DESC";
        $result = $connection->query($sql);
        $price = $result->fetch_assoc();
        $time = date_parse($price['changedDatetime']);
        echo $time['month'] . "/" . $time['day'] . "/" . $time['year'];
    }

    function listingIsAvailable($listingNumber){
        $listing = returnListing($listingNumber);
        if($listing['status'] == 'available'){
            return true;
        }
        else{
            return false;
        }
    }

    function echoListingAvailable($listingNumber){
        $listing = returnListing($listingNumber);
        if($listing['status'] == 'available'){
            echo "<p style='color: #10B629; font-weight: bold;'>" . 'This listing is still available.' . "</p>";
        }
        else{
            echo "<p style='color: #F11D1D; font-weight: bold;'>" . 'This listing has been sold. ' . "</p>";
        }
    }

    function updateHitCount($listingNumber, $viewType) {
        $connection = OpenCon();
        $result = $connection->query("SELECT `agentHitCount`, `visitorHitCount` FROM `Listing` WHERE MLSNumber = '$listingNumber'");
        $row = $result->fetch_assoc();
        if($viewType == "agent") {
            $row['agentHitCount'] += 1;
            $newCount = $row['agentHitCount'];
            $connection->query("UPDATE `Listing` SET `agentHitCount` = '$newCount' WHERE `MLSNumber` = '$listingNumber'");
        } else if ($viewType == "visitor") {
            $row['visitorHitCount'] += 1;
            $newCount = $row['visitorHitCount'];
            $connection->query("UPDATE `Listing` SET `visitorHitCount` = '$newCount' WHERE `MLSNumber` = '$listingNumber'");
        }
        CloseCon($connection);
    }
?>