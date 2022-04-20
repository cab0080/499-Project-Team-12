<?php session_start();$_SESSION['number']=$_GET['number']; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <?php include 'PHPScripts/getListingSummary.php' ?>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="stylesheets/detailed-listing-page.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    </head>

<body style="margin: 0; background: #f5f5f5" >
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <a href="index.php" id="homeButton" class="btn btn-primary pull-right" type="button">Home</a>
    </header>
    <div class="container" style="margin-top: 115px;width: 1000px;">
        <div class="carousel slide" data-bs-ride="carousel" id="photo_carousel" style="height: 460px;">
            <div class="carousel-inner" id="photo-container">
                <div class="carousel-item active" v-for='(photo, key) in photos' v-if="key === 0"><img class="w-100 d-block" v-bind:src="photo.photoPath" alt="Slide Image"></div>
                <div class="carousel-item" v-for='(photo, key) in photos' v-if="key !== 0"><img class="w-100 d-block" v-bind:src="photo.photoPath" alt="Slide Image"></div>
                <!--<div class="carousel-item active"><img class="w-100 d-block" src="img/placeholder.png" alt="Slide Image"></div>
                <div class="carousel-item"><img class="w-100 d-block" src="img/placeholder.png" alt="Slide Image"></div>
                <div class="carousel-item"><img class="w-100 d-block" src="img/placeholder.png" alt="Slide Image"></div>
                <div class="carousel-item"><img class="w-100 d-block" src="img/placeholder.png" alt="Slide Image"></div>
                <div class="carousel-item"><img class="w-100 d-block" src="img/placeholder.png" alt="Slide Image"></div>-->
            </div>
            <script src="js/vuePhotos.js"></script>
            <div><a class="carousel-control-prev" href="#photo_carousel" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#photo_carousel" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
            <ol class="carousel-indicators">
                <li data-bs-target="#photo_carousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#photo_carousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#photo_carousel" data-bs-slide-to="2"></li>
                <li data-bs-target="#photo_carousel" data-bs-slide-to="3"></li>
                <li data-bs-target="#photo_carousel" data-bs-slide-to="4"></li>
            </ol>
        </div>
        <div id="listing-summary">
            <div class="row">
                <div class="col">
                    <h1 id="price" style="font-weight: bold;">$<?php echo getPrice($_GET['number']) ?></h1>
                    <p>Last updated <?php echo getPriceDatetime($_GET['number']) ?></p>
                </div>
                <div class="col">
                    <p style="color: #10B629; font-weight: bold;"><?php echoListingAvailable($_GET['number']) ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-inline" style="padding: 0px;">
                        <li class="list-inline-item"><span id="numBed"><?php echo getBedrooms($_GET['number']) ?></span>&nbsp;bed&nbsp;</li>
                        <li class="list-inline-item"><span id="numBath"><?php echo getBathrooms($_GET['number']) ?></span>&nbsp;bath&nbsp;</li>
                        <li class="list-inline-item"><span id="area"><?php echo getArea($_GET['number']) ?></span>&nbsp;sqft&nbsp;</li>
                        <li class="list-inline-item"><span id="lotSize"><?php echo getLotsize($_GET['number']) ?></span>&nbsp;acres</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2 id="address"><?php echo getAddress($_GET['number']) ?></h2>
                </div>
            </div>
            <div class="row">
                <?php if($_SESSION['loggedin'] == false) : ?>
                    <?php if($_GET['request'] == false) : ?>
                        <div class="col"><button class="btn btn-primary" type="button" data-bs-target="#contact-agent" data-bs-toggle="modal">Request Showing</button></div>
                    <?php else : ?>
                    <div class="col"><p>Showing Requested</p></div>
                    <?php endif ?>
                <?php else : ?>
                    <div class="col"><a class="btn btn-primary" type="button" href="showing_schedule.php" target="blank">Schedule Showing</a></div>
                <?php endif ?>
                <?php if($_SESSION['username'] == getAgentUsername($_GET['number'])) : ?>
                    <div class="col">
                        <?php echo "<a class='btn btn-primary' type='button' href='edit_listing.php?number={$_GET['number']}' target='blank'>Edit Listing</a>"; ?>
                    </div>
                    <div class="col"><a onclick="return confirm('Are you sure you want to delete this listing from tucasana? This cannot be undone');" href="PHPScripts/deleteListing.php" class="btn btn-primary" type="button">Delete listing</a></div>
                    <?php if(listingIsAvailable($_GET['number'])) : ?>
                        <div class="col"><a onclick="return confirm('Mark this listing as sold?');" href="PHPScripts/sellListing.php" class="btn btn-primary" type="button">Mark as sold</a></div>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
        <div id="listing-details" style="margin-top: 20px;">
            <div class="accordion" role="tablist" id="listing-details">
                <div class="accordion-item" id="propDescription">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-1" aria-expanded="false" aria-controls="listing-details .item-1">Property Description</button></h2>
                    <div class="accordion-collapse collapse item-1" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="dwellingType">Property Type:&nbsp;</span><?php echo getPropertyType($_GET['number']) ?></li>
                                <li><span id="fencing">Fenced:&nbsp;</span><?php echo getFenced($_GET['number']) ?></li>
                                <li><span id="detachedGarage">Detached Garage:&nbsp;</span><?php echo getGarage($_GET['number']) ?></li>
                            </ul>
                            <p id="description" class="mb-0"><?php echo getPropertyDescription($_GET['number']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="featuresRooms">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-2" aria-expanded="false" aria-controls="listing-details .item-2">Features and Rooms</button></h2>
                    <div class="accordion-collapse collapse item-2" role="tabpanel">
                        <div class="accordion-body" id="room-list">
                            <div id="room" v-for="room in rooms">
                                <h3 id="roomType">{{room.type}}</h3>
                                <ul>
                                    <li><span>Features:&nbsp;</span>{{room.features}}</li>
                                    <li><span>Area:&nbsp;</span>{{room.area}}</li>
                                    <li><span>Length:&nbsp;</span>{{room.length}}</li>
                                </ul>
                            </div>
                        </div>
                        <script src="js/getRooms.js"></script>
                    </div>
                </div>
                <div class="accordion-item" id="subSchools">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-3" aria-expanded="false" aria-controls="listing-details .item-3">Subdivision and Schools</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="subdivision">Subdivision:&nbsp;</span><?php echo getSubdivision($_GET['number'])?></li>
                                <li><span id="elemSchoolDistrict">Elementary School:&nbsp;</span><?php echo getElementary($_GET['number'])?></li>
                                <li><span id="midSchoolDistrict">Middle School:&nbsp;</span><?php echo getMiddle($_GET['number'])?></li>
                                <li><span id="highSchoolDistrict">High School:&nbsp;</span><?php echo getHigh($_GET['number'])?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="agencyInfo">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-4" aria-expanded="false" aria-controls="listing-details .item-4">Agency Information</button></h2>
                    <div class="accordion-collapse collapse item-4" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="agencyName">Listing Agency:&nbsp;</span><?php echo getAgency($_GET['number']) ?></li>
                                <li><span id="agencyAddress">Agency Address:&nbsp;</span><?php echo getAgencyAddress($_GET['number']) ?></li>
                                <li><span id="agenyPhoneNum">Agency Phone Number:&nbsp;</span><?php echo getAgencyPhone($_GET['number']) ?></li>
                                <li><span id="agentName">Listing Agent:&nbsp;</span><?php echo getAgentName($_GET['number']) ?></li>
                                <li><span id="agentPhoneNum">Agent Phone Number:&nbsp;</span><?php echo getAgentPhone($_GET['number']) ?><br></li>
                                <li><span id="agentEmail">Agent Email:&nbsp;</span><?php echo getAgentEmail($_GET['number']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact-agent" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Contact Agent</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="PHPScripts/sendRequest.php">
                        <div class="mb-3"><input class="form-control" type="text" name="buyerName" placeholder="Full Name" required /></div>
                        <div class="mb-3"><input class="form-control" type="tel" name="buyerPhoneNumber" placeholder="Phone" required /></div>
                        <div class="mb-3"><input class="form-control" type="email" name="buyerEmail" placeholder="Email" required /></div>
                        <div class="mb-3"><textarea class="form-control" name="message" placeholder="Message" rows="14" required></textarea></div>
                        <div class="mb-3"><button class="btn btn-primary" type="submit">Send </button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_SESSION['username'])) {
            updateHitCount($_GET['number'], "agent");
        } else {
            updateHitCount($_GET['number'], "visitor");
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>