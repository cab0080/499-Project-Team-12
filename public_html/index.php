<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tucasana!</title>
  <link rel="stylesheet" href="stylesheets/globals.css" />
  <link rel="stylesheet" href="stylesheets/homepage.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
  <header>
    <h1>tucasana</h1>
  </header>
  <div id="listing-container">
    <input type='button' @click='allRecords()' value='Select All Listings'>
    <br><br>
    <div class="listing-panel">
      <div class="listing" v-for='listing in listings'>
        <img v-bind:src="listing.thumbnailPath" alt="" width="100" height="75">
        <div class="listing-price">${{ listing.price }}</div>
        <address class="listing-address">{{ listing.street }}, {{ listing.city }}, {{ listing.state }} {{ listing.zip }}</address>
        <div class="listing-area">{{ listing.area }} sqft</div>
        <div class="listing-agent">listed by {{ listing.firstName }} {{ listing.lastName }} - {{ listing.name }}</div>
        <a v-bind:href="listing.detailPath">View Listing</a>
      </div>
    </div>
  </div>
  <script src="JS/vueTest.js"></script>
  <div class="login-info">
    <?php include 'PHPScripts/login-status.php' ?>
  </div>
</body>
</html>