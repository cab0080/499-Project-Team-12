<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/closed-listing-report-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php include 'PHPScripts/errorMessage.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php include 'PHPScripts/fetchAgency.php' ?>
    <?php include 'PHPScripts/getClosedListingReport.php' ?>
    <?php $closedListings = getAllListings(getAgencyID()) ?>
</head>

<body style="margin: 0; background: #f5f5f5" >
    <div id="pdf-content">
        <header>
            <div class="banner"></div>
            <div class="tucasanacom">tucasana.com</div>
            <div class="closedlisting">Closed Listing Report for <?php echo getAgencyName() ?></div>
        </header>
        <div class="row" style="margin-top: 250px;">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Listing Link</th>
                                <th>Posting Date</th>
                                <th>Selling Date</th>
                                <th># Days on Market</th>
                                <th>Asking Price</th>
                                <th>Selling Price</th>
                                <th>Buying Realtor Fees</th>
                                <th>Selling Realtor Fees</th>
                            </tr>
                        </thead>
                        <tbody id="sold-listing-list">
                            <?php while($row = $closedListings->fetch_assoc()) : ?>
                            <tr>
                                <td><a href=<?php echo $row['detailPath'] ?>>Link</a></td>
                                <td><?php echo date("M d, Y", strtotime($row['postedDatetime'])) ?></td>
                                <td><?php echo date("M d, Y", strtotime(getClosedListing($row['MLSNumber'])['closingDate'])) ?><br /><br /></td>
                                <td><?php echo getDateDiff($row['postedDatetime'], getClosedListing($row['MLSNumber'])['closingDate']) ?></td>
                                <td><?php echo "$" . number_format(getPrice($row)) ?></td>
                                <td><?php echo "$" . number_format(getClosedListing($row['MLSNumber'])['soldPrice']) ?></td>
                                <td><?php echo "$" . number_format(getClosedListing($row['MLSNumber'])['sellingAgentFee']) ?></td>
                                <td><?php echo "$" . number_format(getClosedListing($row['MLSNumber'])['buyingAgentFee']) ?></td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>
                        <!--<script src="js/vueSoldListings.js"></script>  SCRIPT REPLACED BY PHP-->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>