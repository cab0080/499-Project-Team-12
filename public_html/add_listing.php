<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'PHPScripts/errorMessage.php'; ?>
    <?php include 'PHPScripts/connect.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/add-listing-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style="margin: 0; background: #f5f5f5" >
    <header><div class="banner"></div>
<div class="tucasanacom">tucasana.com</div>
<div class="addlisting">Add Listing</div></header>
    <form style="margin-top: 250px;padding: 20px;" enctype="multipart/form-data" method="post" action="PHPScripts/addListing.php">
        <div class="row" style="margin-bottom: 25px;">
            <div class="col"><label class="form-label">MLS Number</label><input required class="form-control" type="text" style="width: 800px;" name="MLSnumber"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Property Description</label><textarea class="form-control" style="height: 100px;width: 800px;" name="description"></textarea></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Property Type</label><select class="form-select" name="dwellingType" style="width: 500px;">
                    <option value="Single Family" selected="">Single Family</option>
                    <option value="Multi Family">Multi Family</option>
                    <option value="Duplex">Duplex</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Condo">Condo</option>
                </select></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Price</label><input required class="form-control" type="number" name="price" min="0" step="0.01" style="width: 500px;"></div>
        </div>
        <div id="rooms" class="container" style="margin-left: 0px;margin-right: 0px;padding: 0px;">
            <div class="row">
                <div class="col"><button class="btn btn-primary" id="add_room" type="button" onclick="createNewRoom();">Add Room</button></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-2">
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="fenced"><label class="form-check-label" for="formCheck-1">Fenced Backyard</label></div>
            </div>
            <div class="col">
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2" name="detachedGarage"><label class="form-check-label" for="formCheck-2">Detached Garage</label></div>
            </div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Lot Size</label><input class="form-control" type="number" name="lotSize" min="0" step="0.01" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Square Footage</label><input class="form-control" type="number" name="area" min="1" step="0.1" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Street</label><input required class="form-control" type="text" name="street" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">City</label><input required class="form-control" type="text" name="city" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col-xxl-1"><label class="form-label">State</label><select class="form-select" name="state">
                    <option value="AL" selected="">AL</option>
                    <option value="AK">AK</option>
                    <option value="AZ">AZ</option>
                    <option value="AR">AR</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="IA">IA</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="ME">ME</option>
                    <option value="MD">MD</option>
                    <option value="MA">MA</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MS">MS</option>
                    <option value="MO">MO</option>
                    <option value="MT">MT</option>
                    <option value="NE">NE</option>
                    <option value="NV">NV</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NY">NY</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VT">VT</option>
                    <option value="VA">VA</option>
                    <option value="WA">WA</option>
                    <option value="WV">WV</option>
                    <option value="WI">WI</option>
                    <option value="WY">WY</option>
                </select></div>
            <div class="col"><label class="form-label">Zip</label><input class="form-control" type="text" style="width: 205px;" name="zip"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Subdivision</label><input class="form-control" type="text" name="subdivision" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Elementary School District</label><input class="form-control" type="text" name="elemSchoolDistrict" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Middle School District</label><input class="form-control" type="text" name="midSchoolDistrict" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">High School District</label><input class="form-control" type="text" name="highSchoolDistrict" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Arm Code</label><input class="form-control" type="text" name="armCode" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Disarm Code</label><input class="form-control" type="text" name="disarmCode" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Alarm Passcode</label><input class="form-control" type="text" name="passCode" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Alarm Notes</label><input class="form-control" type="text" name="alarmNotes" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Lockbox Code</label><input class="form-control" type="text" name="lockCode" style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Currently Occupied</label><select class="form-select" name="occupied" style="width: 500px;">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Photos (Select all files at once.)</label><input class="form-control" type="file" accept="image/*" name="photoPath[]" multiple required style="width: 500px;"></div>
        </div>
        <div class="row">
            <div class="col">
                <p>Remember to verify.</p><p style="color: #c90000"><?php printMessage(); ?></p><button class="btn btn-primary" type="submit">Submit</button><a href="index.php" class="btn btn-primary" type="button" style="margin-left: 170px;">Cancel</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/JavaScript" src="js/add-listing.js"></script>
</body>

</html>