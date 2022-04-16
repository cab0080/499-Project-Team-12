<?php
    session_start();
    //include 'connect.php';
    include 'errorMessage.php';
    include 'getListingSummary.php';
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

    //SEND AN EMAIL TO THE LISTING AGENT WHEN IT IS SCHEDULED
    //First, we need the listing agent's email
    $listingAgentEmail = returnAgentEmail($mlsNum);

    //We must find the name of the showing agent next, so we can tell the listing agent who is showing their property
    $sql = "SELECT firstName, lastName FROM Agent WHERE username = '$showingAgent'";
    $result = $connection->query($sql);
    $name = $result->fetch_assoc();
    $showingAgentFirstname = $name['firstName'];
    $showingAgentLastname = $name['lastName'];
    
    //Write and send the message.
    $message = "You have a showing scheduled for property " . $mlsNum;
    $message .= "\nShowing time: " . $startTime;
    $message .= "\nShowing agent: " . $showingAgentFirstname . " " . $showingAgentLastname;
    $message .= "\nThis message was sent automatically from tucasana.com. Please email the showing agent if you have any further questions.";

    mail($listingAgentEmail, 'Tucasana: Showing Scheduled', $message);

    setMessage($connection->error);

    CloseCon($connection);
    header("Location: ../showing_schedule.php");
    
    //still debugging this...

    /*setMessage("showing added to database... check it out.");
    header("Location: ../showing_schedule.php");*/