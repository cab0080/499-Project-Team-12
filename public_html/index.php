<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tucasana!</title>
	<link rel="stylesheet" href="stylesheets/homepage.css">
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<header>

</header>
<h1 class="center">Welcome to tucasana.com!</h1>
<div class="abbrev-listing">
</div>
<div id="myapp">
	<!-- Select All product records -->
	<input type='button' @click='allRecords()' value='Select All Listings'>
 	<br><br>
	<table width='80%' style='border-collapse: collapse;'>
		<tr>
		<th>MLS Number</th>
		<th>Street</th>
		<th>State</th>
		</tr>

		<tr v-for='listing in listings'>
		<td>{{ listing.MLSNumber }}</td>
		<td>{{ listing.street }}</td>
		<td>{{ listing.state }}</td>
		</tr>
	</table>
</div>
<script src="JS/vueTest.js"></script>
<div class="login-info">
	<?php include 'PHPScripts/login-status.php' ?>
</div>
</body>
</html>