<?php
include "connect.php";

$conn = OpenCon();

$areaA = (isset($_GET['areaStart']) && $_GET['areaStart'] != "") ? $_GET['areaStart'] : 0;
$areaB = (isset($_GET['areaEnd']) && $_GET['areaEnd'] != "") ? $_GET['areaEnd'] : PHP_INT_MAX;

$priceA = (isset($_GET['priceStart']) && $_GET['priceStart'] != "") ? $_GET['priceStart'] : 0;
$priceB = (isset($_GET['priceEnd']) && $_GET['priceEnd'] != "") ? $_GET['priceEnd'] : PHP_INT_MAX;

$sold = (isset($_GET['showSold']) && $_GET['showSold'] == "on") ? 'sold' : 'available';

if(isset($_GET['zip']) && $_GET['zip'] != "") {
   $zip = $_GET['zip'];
   $query = $conn->prepare("SELECT ls.MLSNumber, thumbnailPath, street, city, state, zip, area, listingAgentUsername, listingAgencyID, detailPath, price, status, firstName, lastName, agency.name FROM Listing ls
   INNER JOIN (SELECT MLSNumber, price FROM ListingPrice GROUP BY MLSNumber ORDER BY changedDatetime DESC) AS pr ON ls.MLSNumber = pr.MLSNumber
   INNER JOIN (SELECT agencyID, name FROM Agency) AS agency ON ls.listingAgencyID = agency.agencyID 
   INNER JOIN (SELECT username, firstName, lastName FROM Agent) AS agent ON ls.listingAgentUsername = agent.username
   WHERE zip=? AND (area BETWEEN ? AND ?) AND (price BETWEEN ? AND ?) AND status IN ('available', ?) LIMIT 25");
   $query->bind_param("siiiis", $zip, $areaA, $areaB, $priceA, $priceB, $sold);
} else {
   $query = $conn->prepare("SELECT ls.MLSNumber, thumbnailPath, street, city, state, zip, area, listingAgentUsername, listingAgencyID, detailPath, price, status, firstName, lastName, agency.name FROM Listing ls
   INNER JOIN (SELECT MLSNumber, price FROM ListingPrice GROUP BY MLSNumber ORDER BY changedDatetime DESC) AS pr ON ls.MLSNumber = pr.MLSNumber
   INNER JOIN (SELECT agencyID, name FROM Agency) AS agency ON ls.listingAgencyID = agency.agencyID 
   INNER JOIN (SELECT username, firstName, lastName FROM Agent) AS agent ON ls.listingAgentUsername = agent.username 
   WHERE (area BETWEEN ? AND ?) AND (price BETWEEN ? AND ?) AND status IN ('available', ?) LIMIT 25");
   $query->bind_param("iiiis", $areaA, $areaB, $priceA, $priceB, $sold);
}
$query->execute();
$result = $query->get_result();

$listing_results = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)){
   $listing_results[] = $row;
}

echo json_encode($listing_results);
exit;