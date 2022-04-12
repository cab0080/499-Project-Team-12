
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHPScripts/getFeedback.php' ?>
    <?php
        $number = $_GET['number'];
        $time = $_GET['time']; 
    ?>
</head>
<body>
    <p>
        Feedback:<br>
        Customer's interest level: <?php echo getCustomerInterestFeedback($number, $time); ?> <br>
        Overall experience rating: <?php echo getOverallExpRating($number, $time); ?> <br>
        Opinions about the price: <?php echo getPriceFeedback($number, $time); ?> <br>
        Additional Feedback: <?php echo getAdditionalFeedback($number, $time); ?> <br>
        <a href="showing_schedule.php">Go back to the schedule page</a>
    </p>
</body>
</html>