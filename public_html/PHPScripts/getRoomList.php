<?php
    session_start();
    include 'connect.php';

    $connection = OpenCon();
    $listingNumber = $_SESSION['number'];
    $sql = "SELECT * FROM `Room` WHERE `MLSNumber` = '$listingNumber'";
    $result = $connection->query($sql);
    $rooms = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rooms[] = $row;
    }

    echo json_encode($rooms);

    CloseCon($connection);
    die;
?>