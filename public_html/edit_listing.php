<?php session_start();$_SESSION['number']=$_GET['number']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/edit-listing-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="JS/edit-listing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php include 'PHPScripts/errorMessage.php'; ?>
    <?php include 'PHPScripts/getListingSummary.php' ?>
</head>

<body style="margin: 0; background: #f5f5f5" onload="setSelected('dwellingType', '<?php echo getPropertyType($_GET['number']) ?>'); setSelected('state', '<?php echo getState($_GET['number']) ?>');setSelected('occupied', '<?php echo getOccupied($_GET['number']) ?>')">
    <header><div class="banner"></div>
<div class="tucasanacom">tucasana.com</div>
<div class="editlisting">Edit Listing</div></header>
    <form style="margin-top: 250px;padding: 20px;" enctype="multipart/form-data" method="post" action="PHPScripts/editListing.php">
        <input type="text" hidden name="oldMLS" value='<?php echo $_GET['number'] ?>'>
        <div class="row" style="margin-bottom: 25px;">
            <div class="col"><label class="form-label">MLS Number</label><input required class="form-control" type="text" style="width: 800px;" name="MLSnumber" value='<?php echo $_GET['number'] ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Property Description</label><textarea class="form-control" style="height: 100px;width: 800px;" name="description" ><?php echo getPropertyDescription($_GET['number']) ?></textarea></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Property Type</label><select class="form-select" name="dwellingType" style="width: 500px;">
                    <option value="Single Family">Single Family</option>
                    <option value="Multi Family">Multi Family</option>
                    <option value="Duplex">Duplex</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Condo">Condo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Price</label><input required class="form-control" type="number" name="price" min="0" step="0.01" style="width: 500px;" value='<?php echo str_replace(',', '', getPrice($_GET['number'])) ?>'></div>
        </div>
        <div id="rooms" class="container" style="margin-left: 0px;margin-right: 0px;padding: 0px;">
            <div class="row">
                <div class="col"><button class="btn btn-primary" id="add_room" type="button" onclick="createNewRoom();">Add Room</button></div>
            </div>
            <div id="room-list">
                <div class="row" v-for="room in rooms">
                    <div class="col"><label class="form-label">Room Type</label><input class="form-control" type="text" name="type[]" style="width: 400px;" v-bind:value="room.type"></div>
                    <div class="col"><label class="form-label">Room Features</label><textarea class="form-control" name="features[]" style="width: 400px;">{{room.features}}</textarea></div>
                    <div class="col"><label class="form-label">Area</label><input class="form-control" type="number" name="area1[]" min="0" style="width: 130px;" v-bind:value="room.area"></div>
                    <div class="col"><label class="form-label">Length</label><input class="form-control" type="number" name="length[]" min="0" style="width: 130px;" v-bind:value="room.length"></div>
                    <div class="col"><button class="btn btn-primary" id="delete_room" type="button" style="margin-top: 32px;" onclick="removeRoom(event);">Remove</button></div>
                </div>
                <script src="JS/getRooms.js"></script>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-2">
                <?php if (getFenced($_GET['number']) == "Yes") : ?>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="fenced" checked><label class="form-check-label" for="formCheck-1">Fenced Backyard</label></div>
                <?php else : ?>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="fenced"><label class="form-check-label" for="formCheck-1">Fenced Backyard</label></div>
                <?php endif ?>
            </div>
            <div class="col">
                <?php if (getGarage($_GET['number']) == "Yes") : ?>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2" name="detachedGarage" checked><label class="form-check-label" for="formCheck-2">Detached Garage</label></div>
                <?php else : ?>
                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2" name="detachedGarage"><label class="form-check-label" for="formCheck-2">Detached Garage</label></div>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Lot Size</label><input class="form-control" type="number" name="lotSize" min="0" step="0.01" style="width: 500px;" value='<?php echo getLotsize($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Square Footage</label><input class="form-control" type="number" name="area" min="1" step="0.1" style="width: 500px;" value='<?php echo str_replace(',', '', getArea($_GET['number'])) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Street</label><input required class="form-control" type="text" name="street" style="width: 500px;" value='<?php echo getStreet($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">City</label><input required class="form-control" type="text" name="city" style="width: 500px;" value='<?php echo getCity($_GET['number']) ?>'></div>
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
            <div class="col"><label class="form-label">Zip</label><input class="form-control" type="text" style="width: 205px;" name="zip" value='<?php echo getZip($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Subdivision</label><input class="form-control" type="text" name="subdivision" style="width: 500px;" value='<?php echo getSubdivision($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Elementary School District</label><input class="form-control" type="text" name="elemSchoolDistrict" style="width: 500px;" value='<?php echo getElementary($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Middle School District</label><input class="form-control" type="text" name="midSchoolDistrict" style="width: 500px;" value='<?php echo getMiddle($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">High School District</label><input class="form-control" type="text" name="highSchoolDistrict" style="width: 500px;" value='<?php echo getHigh($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Arm Code</label><input class="form-control" type="text" name="armCode" style="width: 500px;" value='<?php echo getArmCode($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Disarm Code</label><input class="form-control" type="text" name="disarmCode" style="width: 500px;" value='<?php echo getDisarmCode($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Alarm Passcode</label><input class="form-control" type="text" name="passCode" style="width: 500px;" value='<?php echo getPassCode($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Alarm Notes</label><input class="form-control" type="text" name="alarmNotes" style="width: 500px;" value='<?php echo getAlarmNotes($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Lockbox Code</label><input class="form-control" type="text" name="lockCode" style="width: 500px;" value='<?php echo getLockCode($_GET['number']) ?>'></div>
        </div>
        <div class="row">
            <div class="col"><label class="form-label">Currently Occupied</label><select class="form-select" name="occupied" style="width: 500px;">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="row" id="photo-container">
            <div class="col">
                <ul class="list-group" style="width: 500px;">
                    <li class="list-group-item remain" v-for='photo in photos'>
                        <img class="w-25 d-block" v-bind:src="photo.photoPath" alt="Current Image">
                        <button type="button" class="btn btn-danger mt-3" onclick="toggleRemovePhoto(event);">Remove Photo</button>
                        <input class="form-control" hidden type="text" name="removedPhotos[]" v-bind:value="photo.photoPath" disabled></input>
                    </li>
                    <li class="list-group-item"><label class="form-label">Add Photos</label><input class="form-control" type="file" multiple accept="image/*" name="photoPath[]" style="width: 400px;"></li>
                </ul>
            </div>
        </div>
        <script src="JS/vuePhotos.js"></script>
        <div class="row">
            <div class="col">
                <p>Remember to verify.</p><p style="color: #c90000"><?php printMessage(); ?></p><button class="btn btn-primary" type="submit">Submit</button><a href="index.php" class="btn btn-primary" type="button" style="margin-left: 170px;">Cancel</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>