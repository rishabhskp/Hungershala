<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
$logged=0;
if($_SESSION["loggedin"]=="yes")
	$logged=1;
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Hungershala -- Relieving NITT of Hunger</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
<style>
.page {
width: 1020px  !important;
margin: auto !important;
}
fieldset {
	width: 460px;
	float: left;
}
</style>
<?php
if(!$logged) {
?>
<script src="js/jquery.js" ></script>
<script src="js/input-control.js" ></script>
<script src="js/formvalidation.js"></script>
<?php
}
?>
</head>
<body class="metrouicss">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=118979441590454";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="page">
<?php
include("php/navbar.php");
if(!$logged) {
include("login.php");
include("register.php");
}
else {
?>
<div class="tables">
<div class="restaurants">
<h1> Restaurants </h1>
<table class="striped bordered hovered">
	<tr>
		<td>Name</td>
		<td>Min. Order</td>
		<td>Order Time</td>
		<td>Delivery</td>
	</tr>
	<tr>
		<td><a href="arabian.php">Arabian</a></td>
		<td>Rs. 100</td>
		<td>5pm - 8pm</td>
		<td>8:30pm - 9:00pm</td>
	</tr>
	<tr>
		<td><a href="chickpunch.php">Chick Punch</a></td>
		<td>Rs. 400</td>
		<td>5pm - 8pm</td>
		<td>8:30pm - 9:00pm</td>
	</tr>
</table>
<!--
<?php
/*
ini_set('date.timezone', 'Asia/Kolkata');
$time = date('H:i:s');
$open_res = mysql_query("SELECT * FROM list_restaurants WHERE closetime>'$time'");
if(mysql_num_rows($open_res)>0) {
	echo "<h2>Open Now!!!</h2>";
	?>
	<table class="striped bordered hovered">
	<tr>
		<td>Name</td>
		<td>Cuisine</td>
		<td>Order Timing</td>
		<td>Delivery Between</td>
	</tr>
	<?php
	while($restaurant = mysql_fetch_array($open_res)) {
		echo "<tr><td><a href=\"$restaurant[code].php\">$restaurant[name]</a></td><td>$restaurant[cuisine]</td><td>$restaurant[opentime] - $restaurant[closetime]</td><td>$restaurant[deliverytime]</td></tr>";
	}
	echo "</table>";
}
else
	$disp_closed=1;
$closed_res = mysql_query("SELECT * FROM list_restaurants WHERE closetime<'$time'");
if(mysql_num_rows($closed_res)>0) {
	echo "<h2> Closed: Order for tomorrow! </h2>";
	?>
	<table class="striped bordered hovered">
	<tr>
		<td>Name</td>
		<td>Cuisine</td>
		<td>Order Timing</td>
		<td>Delivery Between</td>
	</tr>
	<?php
	while($restaurant = mysql_fetch_array($closed_res)){
		echo "<tr><td><a href=\"$restaurant[code].php\"> $restaurant[name]</a></td><td>$restaurant[cuisine]</td><td>$restaurant[opentime] - $restaurant[closetime]</td><td>$restaurant[deliverytime]</td></tr>";
	}
	echo "</table>";
}
*/
?>
-->
</div>
<!--
<div class="bakery">
<h1> Coming Soon </h1>
<table class="striped bordered hovered">
	<tr>
		<td>Name</td>
		<td>Min. Order</td>
		<td>Order</td>
		<td>Delivery</td>
	</tr>
	<tr>
		<td><a>Bread Basket</a></td>
		<td>1 Cake</td>
		<td>1 day in advance</td>
		<td>8:30pm-9:00pm</td>
	</tr>
	<tr>
		<td><a>Karaikudi</a></td>
		<td>Rs. 300</td>
		<td>5pm - 7:30pm</td>
		<td>8:30pm-9:00pm</td>
	</tr>
</table>
</div>
</div>
-->
<?php
}
?>
</div>
<?php
if(isset($disp_closed))
	echo "<script> alert(\"Sorry, we are closed for today. Working hours: 5pm to 8pm, 7 days a week. But, feel free to place an order for tomorrow.\"); </script>";
?>
<br/>
<center>Developed and Maintained by Rishi Poddar, NIT Trichy. All rights reserved.</center>
</body>
</html>
