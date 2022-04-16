<?php
    session_start();
    include 'connect.php';
    $connection = OpenCon();
    $showingNumber = $_SESSION['number'];
    $time = $_SESSION['time'];

    $sql = "UPDATE Showing SET customerInterestFeedback=?, 
                                overallExpRating=?, 
                                priceFeedback=?, 
                                additionalFeedback=? 
                                WHERE MLSNumber='$showingNumber' AND startDatetime='$time'";
    
    $statement = $connection->prepare($sql);
    $statement->bind_param("siss", $_POST['customerInterest'], $_POST['overallExperience'], $_POST['priceOpinion'], $_POST['generalFeedback']);
    $statement->execute();
    
    header("Location: ../view_feedback.php?number=" . $showingNumber . "&time=" . $time);
?>