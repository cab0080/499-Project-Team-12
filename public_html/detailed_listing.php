<?php session_start();$_SESSION['number'] = $_GET['number'];?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" type="text/css" href="stylesheets/detailed-listing-page.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <?php include 'PHPScripts/getListingSummary.php' ?>
    </head>

<body style="margin: 0; background: #f5f5f5" >
    <header>
        <div class="banner"></div>
        <div class="tucasanacom">tucasana.com</div>
        <button id="homeButton" class="btn btn-primary pull-right" type="button">Home</button>
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
                    <h1 id="price" style="font-weight: bold;">$<?php getPrice() ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-inline" style="padding: 0px;">
                        <li class="list-inline-item"><span id="numBed"><?php getBathrooms() ?></span>&nbsp;bed&nbsp;</li>
                        <li class="list-inline-item"><span id="numBath"><?php getBedrooms() ?></span>&nbsp;bath&nbsp;</li>
                        <li class="list-inline-item"><span id="area">4,000</span>&nbsp;sqft&nbsp;</li>
                        <li class="list-inline-item"><span id="lotSize">1.5</span>&nbsp;lot size</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2 id="address">1234 Internet Street, Madison, AL 35758</h2>
                </div>
            </div>
            <div class="row">
                <div class="col"><button class="btn btn-primary" type="button">Request Showing</button></div>
            </div>
        </div>
        <script src="js/vueListingSummary.js">
        <div id="listing-details" style="margin-top: 20px;">
            <div class="accordion" role="tablist" id="listing-details">
                <div class="accordion-item" id="propDescription">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-1" aria-expanded="false" aria-controls="listing-details .item-1">Property Description</button></h2>
                    <div class="accordion-collapse collapse item-1" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="dwellingType">Property Type:&nbsp;</span>Single Family</li>
                                <li><span id="fencing">Fenced:&nbsp;</span>Yes</li>
                                <li><span id="detachedGarage">Detached Garage:&nbsp;</span>Yes</li>
                            </ul>
                            <p id="description" class="mb-0">Property description goes here.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="featuresRooms">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-2" aria-expanded="false" aria-controls="listing-details .item-2">Features and Rooms</button></h2>
                    <div class="accordion-collapse collapse item-2" role="tabpanel">
                        <div class="accordion-body">
                            <div id="room">
                                <h3 id="roomType">Bedroom</h3>
                                <ul>
                                    <li><span>Features:&nbsp;</span>features here</li>
                                    <li><span>Area:&nbsp;</span>100</li>
                                    <li><span>Length:&nbsp;</span>20</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="subSchools">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-3" aria-expanded="false" aria-controls="listing-details .item-3">Subdivision and Schools</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="subdivision">Subdivision:&nbsp;</span>Subdivision here.</li>
                                <li><span id="elemSchoolDistrict">Elementary School:&nbsp;</span>Elementary School here.</li>
                                <li><span id="midSchoolDistrict">Middle School:&nbsp;</span>Middle School here.</li>
                                <li><span id="highSchoolDistrict">High School:&nbsp;</span>High School here.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="agencyInfo">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#listing-details .item-4" aria-expanded="false" aria-controls="listing-details .item-4">Agency Information</button></h2>
                    <div class="accordion-collapse collapse item-4" role="tabpanel">
                        <div class="accordion-body">
                            <ul>
                                <li><span id="agencyName">Listing Agency:&nbsp;</span>Agency here.</li>
                                <li><span id="agencyAddress">Agency Address:&nbsp;</span>Agency Address here.</li>
                                <li><span id="agenyPhoneNum">Agency Phone Number:&nbsp;</span>123-456-7890</li>
                                <li><span id="agentName">Listing Agent:&nbsp;</span>Agent Name here.</li>
                                <li><span id="agentPhoneNum">Agent Phone Number:&nbsp;</span>123-456-7890<br></li>
                                <li><span id="agentEmail">Agent Email:&nbsp;</span>example@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>