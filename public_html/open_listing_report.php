<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/open-listing-report-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <?php include 'PHPScripts/fetchAgency.php' ?>
    <?php include 'PHPScripts/getOpenListingReport.php' ?>
    <?php $openListings = getAllListings(getAgencyID()) ?>
</head>

<body style="margin: 0; background: #f5f5f5" >
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <div class="openlisting">Open Listing Report for <?php echo getAgencyName() ?></div>
    </header>
    <div class="row" style="margin-top: 250px;">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Listing Link</th>
                            <th>Posting Date</th>
                            <th># Days on the Market</th>
                            <th>Asking Price</th>
                            <th>Number of Showings</th>
                            <th>Page Views</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $openListings->fetch_assoc()) : ?>
                        <tr>
                            <td><a href=<?php echo $row['detailPath'] ?>> <?php echo $row['street'] . ", " . $row['city'] . ", " . $row['state'] . " " . $row['zip'] ?></a></td>
                            <td><?php echo date("M d, Y", strtotime($row['postedDatetime'])) ?> </td>
                            <td><?php echo getDateDiff($row) ?><br /><br /></td>
                            <td><?php echo "$" . number_format(getPrice($row)) ?></td>
                            <td><?php echo getNumShowings($row) ?></td>
                            <td><?php echo getPageViews($row) ?></td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>