<?php
include "connect.php";

$connection = OpenCon();
$result = $connection->query("SELECT `MLSNumber`, `agentHitCount`, `visitorHitCount`, `prevAgentHits`, `prevVisitorHits`, `street`, `city`, `state`, `zip`, `email`, `detailPath`
FROM `Listing` INNER JOIN `Agent` ON username = listingAgentUsername WHERE `status` = 'available'");

while($row = $result->fetch_array(MYSQLI_ASSOC)){
  $to = $row['email'];
  $subject = "Today's view count for your listing at " . $row['street'];

  $agentCount = $row['agentHitCount'] - $row['prevAgentHits'];
  $visitorCount = $row['visitorHitCount'] - $row['prevVisitorHits'];

  $message = "
  <html>
  <head>
  <title>Daily View Count for {$row['street']}</title>
  </head>
  <body>
  <div>
    <p>MLS Number: {$row['MLSNumber']}</p>
    <address>{$row['street']}, {$row['city']}, {$row['state']} {$row['zip']}</address>
    <a href='https://www.tucasana.com{$row['detailPath']}'>View Listing</a>
  </div>
  <table>
  <tr>
  <th>Agent Hit Count</th>
  <th>Visitor Hit Count</th>
  </tr>
  <tr>
  <td>{$agentCount}</td>
  <td>{$visitorCount}</td>
  </tr>
  </table>
  </body>
  </html>
  ";

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <noreply@tucasana.com>' . "\r\n";

  //mail($to, $subject, $message, $headers);

  $connection->query("UPDATE `Listing` SET `agentHitCount` = 0, `visitorHitCount` = 0, `prevAgentHits` = {$row['agentHitCount']}, `prevVisitorHits` = {$row['visitorHitCount']}
  WHERE `MLSNumber` = {$row['MLSNumber']}");
}

CloseCon($connection);

?>