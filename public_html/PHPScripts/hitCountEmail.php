<?php
include "connect.php";

$connection = OpenCon();
$result = $connection->query("SELECT `MLSNumber`, `agentHitCount`, `visitorHitCount`, `prevAgentHits`, `prevVisitorHits`, `street`, `city`, `state`, `zip`, `email`, `detailPath`
FROM `Listing` INNER JOIN `Agent` ON username = listingAgentUsername WHERE `status` = 'available'");

while($row = $result->fetch_array(MYSQLI_ASSOC)){
  $to = $row['email'];
  $subject = "Today's View Count for " . $row['street'];

  $agentCount = $row['agentHitCount'] - $row['prevAgentHits'];
  $visitorCount = $row['visitorHitCount'] - $row['prevVisitorHits'];

  $message = "
  <html>
  <head>
  <title>Daily View Count for {$row['street']}</title>
  </head>
  <body>
  <div>
    <p><b>MLS#: </b>{$row['MLSNumber']}</p>
    <b>Address: </b><address style='display: inline;'>{$row['street']}, {$row['city']}, {$row['state']} {$row['zip']}</address>
  </div>
  <br>
  <table style='border: 1px solid;border-collapse: collapse;'>
  <tr>
  <th style='border: 1px solid;'>Agent Hit Count</th>
  <th style='border: 1px solid;'>Visitor Hit Count</th>
  </tr>
  <tr>
  <td style='border: 1px solid;'>{$agentCount}</td>
  <td style='border: 1px solid;'>{$visitorCount}</td>
  </tr>
  </table>
  <br>
  <a href='https://www.tucasana.com/{$row['detailPath']}'>View Listing</a>
  </body>
  </html>
  ";

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <noreply@tucasana.com>' . "\r\n";

  mail($to, $subject, $message, $headers);

  $connection->query("UPDATE `Listing` SET `prevAgentHits` = {$row['agentHitCount']}, `prevVisitorHits` = {$row['visitorHitCount']}
  WHERE `MLSNumber` = {$row['MLSNumber']}");
}

CloseCon($connection);

?>