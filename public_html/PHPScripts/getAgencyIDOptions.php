<?php
    include 'connect.php';
    $connection = OpenCon();

    $sql = "SELECT * FROM `Agency`";

    $result = $connection->query($sql);

    while($agency = $result->fetch_assoc()){
        //add an option to the dropdown list
        echo "<option value='" . $agency['agencyID'] . "' >" . $agency['name'] . "</option>";
    }
?>