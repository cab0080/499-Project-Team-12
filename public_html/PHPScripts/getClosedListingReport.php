<?php
    //This contains all the functions necessary to populate the closed listing report
    
    function getAllListings($agency){
        $connection = OpenCon();
        $sql = "SELECT * FROM Listing WHERE status='sold' AND (listingAgentUsername = 'all'"; //query - need to add the agents from the company onto the end
        
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

    function getClosedListing($mls){
        $connection = OpenCon();
        $sql = "SELECT * FROM SoldListing WHERE MLSNumber='$mls'";

        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        CloseCon($connection);
        return $row;
    }

    function getDateDiff($d1, $d2){
        $d1 = date_create($d1);
        $d2 = date_create($d2);
        //We will subtract the current date from this day
        $diff = date_diff($d1, $d2);
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
    
?>