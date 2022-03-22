<?php
include "connect.php";

$conn = OpenCon();

$query = "SELECT MLSNumber, thumbnailPath, street, city, state, zip, area, listingAgentUsername, listingAgencyID, detailPath, status FROM Listing LIMIT 25";
$result = $conn->query($query);

$listing_results = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)){
   $listing_results[] = $row;
}

echo json_encode($listing_results);
exit;