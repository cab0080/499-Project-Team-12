<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tucasana!</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="stylesheets/globals.css" />
  <link rel="stylesheet" href="stylesheets/homepage.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">tucasana.com</a>
      <ul class="navbar-nav">
        <?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
          <li class="nav-item">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="margin: 10px 20px 0 0;">Document Templates </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="doc_templates/closing_cost_estimate_template.pdf" target="_blank">Estimated Closing Cost Statement</a>
                <a class="dropdown-item" href="doc_templates/sales_contract_template.pdf" target="_blank">Sales Contract</a>
                <a class="dropdown-item" href="doc_templates/maintenance_request_template.pdf" target="_blank">Request For Repairs Statement</a>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary add-listing" href="add_listing.php" role="button">New Listing <b>+</b></a>
          </li>
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
      <div class="dropdown">
        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"  data-bs-auto-close="outside">
          Filter
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <form class="px-4 py-3" method="get" id="filter">
            <div class="rangeFilter">
              <div class="mb-3">
                <label for="areaStartFilter" class="form-label">Min sqft</label>
                <input type="number" class="form-control" id="areaStartFilter" name="areaStart" placeholder="min" min="0">
              </div>
              <div class="mb-3">
                <label for="areaEndFilter" class="form-label">Max sqft</label>
                <input type="number" class="form-control" id="areaEndFilter" name="areaEnd" placeholder="max">
              </div>
            </div>
            <div class="rangeFilter">
              <div class="mb-3">
                <label for="priceStartFilter" class="form-label">Min price</label>
                <input type="number" class="form-control" id="priceStartFilter" name="priceStart" placeholder="min" min="0">
              </div>
              <div class="mb-3">
                <label for="priceEndFilter" class="form-label">Max price</label>
                <input type="number" class="form-control" id="priceEndFilter" name="priceEnd" placeholder="max">
              </div>
            </div>
            <div class="mb-3">
              <label for="zipFilter" class="form-label">Zip code</label>
              <input type="number" class="form-control" id="zipFilter" name="zip" placeholder="enter zip">
            </div>
            <div class="mb-1">
              <input type="checkbox" id="showSold" name="showSold">
              <label for="showSold" class="form-label">Show sold listings</label>
            </div>
            <?php  if ($_SESSION['loggedin']) : ?>
            <div class="mb-1">
              <input type="checkbox" id="myList" name="myList">
              <label for="myList" class="form-label">Show only my listings</label>
            </div>
            <?php endif ?>
            <button class="btn btn-primary" form="filter">Apply</button>
          </form>
        </div>
      </div>
      <div class="row row-cols-xs-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 ">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="js/vueTest.js"></script>
</body>
</html>