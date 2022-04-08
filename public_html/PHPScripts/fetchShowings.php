<?php
    include 'connect.php';

    $connection = OpenCon();
    $sql = "SELECT sh.MLSNumber, ls.street, ls.city, ls.state, ls.zip, sh.startDatetime, sh.endDatetime, sh.buyerName, sh.buyerPhoneNumber, sh.buyerEmail, lag.firstName AS listingFirstName, lag.lastName AS listingLastName, sag.firstName AS showingFirstName, sag.lastName AS showingLastName, lc.name AS listingAgencyName, sc.name AS showingAgencyName FROM Showing sh
    NATURAL JOIN Listing ls
    INNER JOIN Agent lag ON lag.username = ls.listingAgentUsername
    INNER JOIN Agent sag ON sag.username = sh.showingAgentUsername
    INNER JOIN Agency lc ON lc.agencyID = lag.agencyID
    INNER JOIN Agency sc ON sc.agencyID = sag.agencyID
    ORDER BY sh.startDateTime";

    $result = $connection->query($sql);
    $showingList = array();

    while($row = $result->fetch_assoc()){
        $showingList[] = $row;
    }

    echo json_encode($showingList);
    
?>