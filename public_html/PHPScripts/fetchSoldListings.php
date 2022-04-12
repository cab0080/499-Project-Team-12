<?php
    include 'connect.php';

    $connection = OpenCon();
    $sql = "SELECT sl.closingDate, sl.soldPrice, sl.sellingAgentUsername, sl.sellingAgentFee, sl.buyingAgentUsername, sl.buyingAgentFee, sl.MLSNumber FROM SoldListing sl";

    $result = $connection->query($sql);
    $soldListingList = array();

    while($row = $result->fetch_assoc()){
        $soldListingList[] = $row;
    }

    echo json_encode($soldListingList);
    
?>