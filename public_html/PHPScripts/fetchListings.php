<?php
include "connect.php";

$conn = OpenCon();

$query = "SELECT ls.MLSNumber, thumbnailPath, street, city, state, zip, area, listingAgentUsername, listingAgencyID, detailPath, price, status, firstName, lastName, agency.name FROM Listing ls
INNER JOIN (SELECT MLSNumber, price FROM ListingPrice GROUP BY MLSNumber ORDER BY changedDatetime DESC) AS pr ON ls.MLSNumber = pr.MLSNumber
INNER JOIN (SELECT agencyID, name FROM Agency) as agency ON ls.listingAgencyID = agency.agencyID 
INNER JOIN (SELECT username, firstName, lastName FROM Agent) as agent ON ls.listingAgentUsername = agent.username LIMIT 25";
$result = $conn->query($query);

$listing_results = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)){
   $listing_results[] = $row;
}

echo json_encode($listing_results);
exit;