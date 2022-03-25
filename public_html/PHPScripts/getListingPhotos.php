<?php 
    session_start();
    include 'connect.php';
    
    $connection = OpenCon();
    $listingNumber = $_SESSION['number'];
    $sql = "SELECT * FROM `ListingPhoto` WHERE `MLSNumber` = '$listingNumber'";
    $result = $connection->query($sql);
    $photos = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $photos[] = $row;
    }

    echo json_encode($photos);

    CloseCon($connection);
    die;
?>