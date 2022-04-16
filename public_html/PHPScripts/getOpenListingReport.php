<?php
    //This contains the methods necessary to populate the tables in the open listing report
    //include 'connect.php';


    //Method to return all the appropriate open listings
    function getAllListings($agency){
        $connection = OpenCon();
        $sql = "SELECT * FROM Listing WHERE status='available' AND (listingAgentUsername = 'all'"; //query - need to add the agents from the company onto the end
        
        $sql1 = "SELECT * FROM Agent WHERE agencyID='$agency'"; //Use this to get the agents, then add them to the end of the original query
        $result = $connection->query($sql1);
        while($row = $result->fetch_assoc()){
            $sql .= "OR listingAgentUsername='" . $row['username'] . "'";
        }
        $sql .= ")";
        //echo $sql;
        //Now we have fully prepared our query - even though this is probably bad practice.
        $result = $connection->query($sql);
        CloseCon($connection);
        return $result; //return all the listings we retrieved
    }


    function getDateDiff($row){
        $d1 = date_create($row['postedDatetime']);
        //We will subtract the current date from this day
        $diff = date_diff($d1, date_create("now"));
        return $diff->format("%d days");
    }

    function getPrice($row){
        $connection = OpenCon();
        $mls = $row['MLSNumber'];
        $sql = "SELECT * FROM ListingPrice WHERE MLSNumber='$mls' ORDER BY changedDatetime DESC";
        $result = $connection->query($sql);
        $price = $result->fetch_assoc()['price'];
        CloseCon($connection);
        return $price;
    }

    function getNumShowings($row){
        $mls = $row['MLSNumber'];
        $connection = OpenCon();
        $sql = "SELECT COUNT(*) FROM Showing WHERE MLSNumber = '$mls'";
        $result = $connection->query($sql);
        CloseCon($connection);
        return $result->fetch_assoc()['COUNT(*)'];
    }

    function getPageViews($row){
        return $row['agentHitCount'] + $row['visitorHitCount'];
    }
?>