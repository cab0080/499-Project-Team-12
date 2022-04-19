<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/feedback-page.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php
        $_SESSION['number'] = $_GET['number'];
        $_SESSION['time'] = $_GET['time'];
    ?>
</head>

<body style="margin: 0; background: #f5f5f5">
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <div class="feedback">Submit Feedback</div>
    </header>
        <form style="margin-top: 250px;padding: 20px;" enctype="multipart/form-data" method="post" action="PHPScripts/submitFeedback.php">
            <div class="row">
                <div class="col-xxl-4">
                    <label class="form-label">Rate the customer's interest in the property:</label>
                </div>
                <div class="col">
                    <select class="form-select" name="customerInterest" type="text" list="value" style="width: 300px;">
                        <option value="Interested">Interested</option>
                        <option value="Somewhat Interested">Somewhat interested</option>
                        <option value="Neutral">Neutral</option>
                        <option value="Somewhat Disinterested">Somewhat disinterested</option>
                        <option value="Not Interested">Not interested</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-4">
                    <label class="form-label">Please rate your overall experience at this showing:</label>
                </div>
                <div class="col">
                    <select class="form-select" name="overallExperience" type="text" style="width: 100px;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-4">
                    <label class="form-label">What is your and the customer's opinion of the price?</label>
                </div>
                <div class="col">
                    <select class="form-select" name="priceOpinion" type="text" style="width: 300px;">
                        <option value="Way too high">Way too high</option>
                        <option value="A little high">A little high</option>
                        <option value="Fair">Fair</option>
                        <option value="Good deal">Good deal</option>
                        <option value="A steal!">A steal!</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-4">
                    <label class="form-label">Please enter any general additional feedback here:</label>
                </div>
                <div class="col">
                    <textarea name="generalFeedback" class="form-control" style="height: 100px;width: 300px;" placeholder="General Feedback here..."></textarea>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
</body>
</html>