
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/feedback-page.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php include 'PHPScripts/getFeedback.php' ?>
    <?php
        $number = $_GET['number'];
        $time = $_GET['time']; 
    ?>
</head>
<body style="margin: 0; background: #f5f5f5">
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <div class="feedback">Feedback</div>
    </header>
    <div class="row" style="margin-top: 225px;">
        <div class="col">
            <ul>
                <li><span>Customer's interest level:&nbsp;</span><?php echo getCustomerInterestFeedback($number, $time); ?></li>
                <li><span>Overall experience rating:&nbsp;</span><?php echo getOverallExpRating($number, $time); ?></li>
                <li><span>Opinions about the price:&nbsp;</span><?php echo getPriceFeedback($number, $time); ?></li>
                <li><span>Additional Feedback:&nbsp;</span><?php echo getAdditionalFeedback($number, $time); ?></li>
            </ul>
            <a class="btn btn-primary" href="showing_schedule.php">Go back to the schedule page</a>
        </div>
    </div>
</body>
</html>