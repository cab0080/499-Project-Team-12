<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'PHPScripts/errorMessage.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheets/login-page.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/globals.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="margin: 0; background: #f5f5f5" >
  <input type="hidden" id="anPageName" name="page" value="login-page" />
  <div class="login-page screen">
    <div class="home-button">
      <form>
          <button formaction='index.php'  class="btn btn-primary pull-right">Click here to go back home</button>
      </form>
    </div>
    <div class="banner"></div>
    <div class="tucasanacom">tucasana.com</div>
    <div class="welcome-to-tucasana">Welcome to Tucasana</div>
    <div class="log-in-to-your-real">
        Log in to your real estate agent or manager account to manage <br />your listings, generate documents, check
        showing times, and more.
    </div>
    <div class="login-form">
      <form action="PHPScripts/login.php" method="post">
          <h2 class="text-center">Log in</h2>       
          <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" required="required">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
          <p>
             <?php printMessage();?>
          </p>     
      </form>
    </div>
  </div>
    
</body>