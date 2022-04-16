<?php
    include 'connect.php';
    
    function getShowing($number, $time){
        $connection = OpenCon();
        $sql = "SELECT * FROM Showing WHERE MLSNumber = '$number' AND startDatetime='$time'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    function getCustomerInterestFeedback($number, $time){
        $showing = getShowing($number, $time);
        return $showing['customerInterestFeedback'];
    }

    function getOverallExpRating($number, $time){
        $showing = getShowing($number, $time);
        return $showing['overallExpRating'];
    }

    function getPriceFeedback($number, $time){
        $showing = getShowing($number, $time);
        return $showing['priceFeedback'];
    }

    function getAdditionalFeedback($number, $time){
        $showing = getShowing($number, $time);
        return $showing['additionalFeedback'];
    }
?>