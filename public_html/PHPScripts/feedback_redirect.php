<?php
    session_start();
    include 'getListingSummary.php';
    include 'errorMessage.php';
    $showingNumber = $_GET['number'];
    $time = $_GET['time'];
    
    //We have to write an sql query to get the showing agent's username.
    $sql = "SELECT * FROM Showing WHERE MLSNumber='$showingNumber' AND startDatetime='$time'";
    $connection = OpenCon();
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $showingAgent = $row['showingAgentUsername'];
    $listingAgent = getAgentUsername($showingNumber);

    if($_SESSION['username'] == $showingAgent){ //if the current user is the showing agent - they are the ones who get to fill out the feedback form
        if($row['customerInterestFeedback'] === null){
            header("Location: ../submit_feedback.php?number=" . $showingNumber . "&time=" . $time); //If there is no feedback yet
        }
        else{ //if there is already feedback, just go view the feedback
            header("Location: ../view_feedback.php?number=" . $showingNumber . "&time=" . $time);
        }
    }
    else if($_SESSION['username'] == $listingAgent){ //if the current user is the listing agent - they get to see the feedback info
        header("Location: ../view_feedback.php?number=" . $showingNumber . "&time=" . $time);
    }

    else{
        setMessage("This is only viewable for the listing and showing agents.");
        header("Location: ../showing_schedule.php");
    }