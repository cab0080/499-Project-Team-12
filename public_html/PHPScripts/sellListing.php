<?php
    session_start();
    include 'connect.php';
    include 'errorMessage.php';
    $connection = OpenCon();
    $number = $_SESSION['number'];

    // Mark listing as sold in the database.
    $sql = "UPDATE `Listing` SET `status` = 'sold' WHERE `Listing`.`MLSNumber` = '$number'";
    $connection->query($sql);

    $closeDate = $_POST['closingDate'];
    $sellPrice = $_POST['soldPrice'];
    $sellAgent = $_POST['sellingAgentID'];
    $sellFee = $_POST['sellingAgentFee'];
    $buyAgent = $_POST['buyingAgentID'];
    $buyFee = $_POST['buyingAgentFee'];

    // Insert sold listing into the database.
    $statement = $connection->prepare("INSERT INTO `SoldListing` (`closingDate`, `soldPrice`, `sellingAgentUsername`, `sellingAgentFee`, `buyingAgentUsername`, `buyingAgentFee`, `MLSNumber`) 
                                        VALUES (
                                            '$closeDate', 
                                            '$sellPrice', 
                                            ?, 
                                            '$sellFee', 
                                            ?, 
                                            '$buyFee', 
                                            ?)");

    $statement->bind_param("sss", $sellAgent, $buyAgent, $number);
    $statement->execute();

    setMessage($connection->error);
    CloseCon($connection);

    $url = "../detailed_listing.php?number=" . $number;
    //echo "Listing sold.";
    header("Location: " . $url);
?>