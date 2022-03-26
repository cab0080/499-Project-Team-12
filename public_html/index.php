<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tucasana!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheets/globals.css" />
  <link rel="stylesheet" href="stylesheets/homepage.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <header>
    <h1>tucasana</h1>
  </header>
  <div id="listing-container">
    <input type='button' @click='allRecords()' value='Select All Listings'>
    <br><br>
    <div class="listing-panel">
      <div class="card listing" style="width: 18rem;" v-for='listing in listings'>
        <img v-bind:src="listing.thumbnailPath" v-bind:alt="'MLS# ' + listing.MLSNumber + ' thumbnail'" width="100" height="75" class="card-img-top">
        <div class="card-body">
          <h4 class="card-title listing-price">{{ listing.price | usPrice }}</h4>
          <address class="card-text listing-address">{{ listing.street }}, {{ listing.city }}, {{ listing.state }} {{ listing.zip }}</address>
          <div class="card-text listing-area">{{ listing.area }} sqft</div>
          <div class="listing-agent">listed by {{ listing.firstName }} {{ listing.lastName }} - {{ listing.name }}</div>
          <a v-bind:href="listing.detailPath" class="btn btn-primary">View Listing</a>
        </div>
      </div>
    </div>
  </div>
  <script src="js/vueTest.js"></script>
  <div class="login-info">
    <?php include 'PHPScripts/login-status.php' ?>
  </div>
</body>
</html>