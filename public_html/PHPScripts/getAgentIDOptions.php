<?php
    //include 'connect.php';
    $connection = OpenCon();

    $sql = "SELECT * FROM Agent";

    $result = $connection->query($sql);

    while($agent = $result->fetch_assoc()){
        echo "<option value='" . $agent['username'] . "' >" . $agent['firstName'] . " " . $agent['lastName'] . "</option>";
    }

    CloseCon($connection);
?>