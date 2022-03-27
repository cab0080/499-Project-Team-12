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
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">tucasana</a>
      <ul class="navbar-nav">
        <?php  if ($_SESSION['loggedin']) : ?>
          <li class="nav-item">
            Logged in as <?php echo $_SESSION['username']; ?>
            <a class="nav-link" href="PHPScripts/signout.php">Click here to log out</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="btn btn-primary" href="login_page.php" role="button">Log In</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </nav>
  <div id="listing-container">
    <div class="listing-panel">
      <div class="row row-cols-3">
        <div class="col" v-for='listing in listings'>
          <div class="card h-100 listing" style="width: 18rem;">
            <img v-bind:src="listing.thumbnailPath" v-bind:alt="'MLS# ' + listing.MLSNumber + ' thumbnail'" width="100" height="75" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title listing-price">{{ listing.price | usPrice }}</h4>
              <h6 class="card-subtitle text-muted listing-area">{{ listing.area | usInteger }} sqft</h6>
              <address class="card-text listing-address">{{ listing.street }}, {{ listing.city }}, {{ listing.state }} {{ listing.zip }}</address>
              <a v-bind:href="listing.detailPath" class="btn btn-primary">View Listing</a>
              <p class="card-text text-muted listing-agent">listed by {{ listing.firstName }} {{ listing.lastName }} | {{ listing.name }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="JS/vueTest.js"></script>
  <div class="login-info">
    <?php include 'PHPScripts/login-status.php' ?>
  </div>
</body>
</html>