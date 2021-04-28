<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
require_once("php/forcelogin.php");
$history = mysql_query("SELECT * FROM order_var WHERE user_id=$_SESSION[user_id]");
while($order = mysql_fetch_array($history)) {
	echo "<h2>Order #$order[user_id]$order[order_id]</h2>";
	echo "<h3>Ordered on $order[date]</h3>";
	$dishes = mysql_query("SELECT * FROM orders, menu_$order[restaurant] WHERE order_id = '$order[order_id]' INNER JOIN using(dish_id)");
	echo "<table><tr><td>Dish</td><td>Quantity</td></tr>";
	while($dish = mysql_fetch_array($dishes))
		echo "<tr><td>$dish[name]</td><td>$dish[qty]</td></tr>";
	echo "</table>";
}
?>