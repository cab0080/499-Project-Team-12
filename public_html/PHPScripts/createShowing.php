<?php
    session_start();
    include 'connect.php';
    include 'errorMessage.php';
    $connection = OpenCon();

    $mlsNum = $_POST['MLSNumber'];


    //first, verify that the user entered a valid MLS number
    $statement = $connection->prepare("SELECT * FROM Listing WHERE MLSNumber LIKE ?");
    $statement->bind_param("i", $mlsNum);

    $statement->execute();
    $result = $statement->get_result();
    
    if($result->num_rows < 1){
        setMessage("Error: MLS number not found in database");
        CloseCon($connection);
        header("Location: ../showing_schedule.php");
    }
    
    //If we get here, we know the MLSnumber is valid
    $startTime = $_POST['startDatetime'];
    //$startTime = $startTimedate->format('Y-m-d H:i:s');

    $endTime = $_POST['endDatetime'];

    $buyerName = $_POST['buyerName'];
    $buyerPhone = $_POST['buyerPhone'];
    $buyerEmail = $_POST['buyerEmail'];
    $showingAgent = $_POST['showingAgentID'];
    //$showingAgency = $_POST['showingAgencyID'];

    //Now let's insert this thing into the database
    $statement = $connection->prepare("INSERT INTO `Showing` (`MLSNumber`, `startDatetime`, `endDatetime`, `showingAgentUsername`, `customerInterestFeedback`, `overallExpRating`, `priceFeedback`, `additionalFeedback`, `buyerName`, `buyerPhoneNumber`, `buyerEmail`) 
                                        VALUES (
                                            '$mlsNum', 
                                            '$startTime', 
                                            '$endTime', 
                                            '$showingAgent', 
                                            NULL, 
                                            NULL, 
                                            NULL, 
                                            NULL,
                                            ?,
                                            ?, 
                                            ?)");

    $statement->bind_param("sss", $buyerName, $buyerPhone, $buyerEmail);
    $statement->execute();
    //var_dump($startTime, $endTime);
    //$result = $statement->get_result()
    setMessage($connection->error);
    CloseCon($connection);
    header("Location: ../showing_schedule.php");
    
    //still debugging this...

    /*setMessage("showing added to database... check it out.");
    header("Location: ../showing_schedule.php");*/