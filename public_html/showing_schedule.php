<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/showing-schedule-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <?php include 'PHPScripts/errorMessage.php' ?>
    <?php include 'PHPScripts/connect.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body style="margin: 0; background: #f5f5f5" >
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <div class="showingschedule">Showing Schedule</div>
    </header>
    <div class="row" style="margin-top: 250px;padding: 10px;">
        <div class="col"><button class="btn btn-primary" type="button" data-bs-target="#add-showing" data-bs-toggle="modal">+ Add New Showing</button></div>
        <div class="col"><p style="color:#db0909;"><?php printMessage(); ?></p></div>
    </div>
    <div class="table-responsive">
        <table id="showing-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>MLS #</th>
                    <th>Property Address</th>
                    <th>Showing Start Time</th>
                    <th>Showing End Time</th>
                    <th>Buyer Name</th>
                    <th>Buyer Phone</th>
                    <th>Buyer Email</th>
                    <th>Listing Agent</th>
                    <th>Listing Company</th>
                    <th>Showing Agent</th>
                    <th>Showing Company</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>
            <tbody id="showing-list">
                <tr v-for="showing in showings">
                    <td>{{ showing.MLSNumber }}</td>
                    <td>{{ showing.street }}, {{ showing.city }}, {{ showing.state }} {{showing.zip}}</td>
                    <td>{{ showing.startDatetime }}<br /><br /></td>
                    <td>{{ showing.endDatetime }}<br /></td>
                    <td>{{ showing.buyerName }}</td>
                    <td>{{ showing.buyerPhoneNumber }}</td>
                    <td>{{ showing.buyerEmail }}</td>
                    <td>{{ showing.listingFirstName }} {{ showing.listingLastName }}</td>
                    <td>{{ showing.listingAgencyName }}</td>
                    <td>{{ showing.showingFirstName }} {{ showing.showingLastName }}</td>
                    <td>{{ showing.showingAgencyName }}</td>
                    <td>
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a v-bind:href="'PHPScripts/feedback_redirect.php?number=' + showing.MLSNumber + '&time=' + showing.startDatetime" target="blank" class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Feedback"><span class="bi bi-pencil-square"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Delete" id="deleteButton" onclick="return confirm('Are you sure you want to delete this showing?');" v-bind:href="'PHPScripts/deleteShowing.php?MLS=' + showing.MLSNumber + '&time=' + showing.startDatetime"><span class="bi bi-trash-fill"></span></a>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
            <script src="js/vueShowings.js"></script>
        </table>
    </div>
    <div id="add-showing" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Scheduled Showing</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="PHPScripts/createShowing.php">
                        <div class="mb-3"><input value="<?php echo $_GET['sentBy'] ?>" class="form-control" type="number" name="MLSNumber" placeholder="MLS #" /></div>
                        <div class="mb-3"><label class="form-label">Showing Start Time</label><input class="form-control" type="datetime-local" name="startDatetime"  /></div>
                        <div class="mb-3"><label class="form-label">Showing End Time</label><input class="form-control" type="datetime-local" name="endDatetime" /></div>
                        <div class="mb-3"><input class="form-control" required type="text" name="buyerName" placeholder="Buyer Name"  /></div>
                        <div class="mb-3"><input class="form-control" required type="tel" name="buyerPhone" placeholder="Buyer Phone"  /></div>
                        <div class="mb-3"><input class="form-control" required type="email" name="buyerEmail" placeholder="Buyer Email"  /></div>
                        <div class="mb-3"><label class="form-label">Showing Agent</label><select required class="form-select" name="showingAgentID">
                                <?php include 'PHPScripts/getAgentIDOptions.php' ?>
                            </select></div>
                        <div class="mb-3"><button class="btn btn-primary" type="submit">Add</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/JavaScript" src="js/showing-schedule.js"></script>
</body>

</html>