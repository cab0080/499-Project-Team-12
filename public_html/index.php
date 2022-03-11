<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tucasana!</title>
	<link rel="stylesheet" href="stylesheets/homepage.css">
</head>
<body>
<h1 class="center">Welcome to tucasana.com!</h1>
<p class="center">This is where the list of posts will be displayed</p>
<div class="login-info">
	<?php include'PHPScripts/login-status.php' ?>
</div>
</body>
</html>