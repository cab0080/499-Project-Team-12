<?php
    session_start();
    include 'connect.php';
    $mls = $_SESSION['number'];
    $price = $_POST['price'];
    $conn = OpenCon();
    $sql = "INSERT INTO `ListingPrice`(`MLSNumber`, `changedDatetime`, `price`) VALUES ( $mls, CURRENT_TIMESTAMP, $price )";
    $conn->query($sql);
    CloseCon($conn);
    $backURL = "../detailed_listing.php?number=" . $mls;
    header("Location: $backURL");
?>