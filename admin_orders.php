<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>All orders for today</title>
<link rel="stylesheet" type="text/css" href="../css/modern.css" />
</head>
<body class="metrouicss">
<?php
include("php/connect.php");
$orders_var = mysql_query("SELECT order_id, user_id, restaurant, hostel, mobile, date, total from order_var WHERE DATE(date)=CURRENT_DATE");
while($order_var = mysql_fetch_array($orders_var)) {
	$name = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE user_id = '$order_var[user_id]'"));
	$orders = mysql_query("SELECT name, qty, cost FROM orders INNER JOIN menu_$order_var[restaurant] USING (dish_id) WHERE orders.order_id=$order_var[order_id]");
	echo "Order No. $order_var[user_id]$order_var[order_id]<br>Name: $name[name]<br>Hostel: $order_var[hostel]<br>Mobile: $order_var[mobile]<br>Time of Order: $order_var[date]<br>Restaurant: $order_var[restaurant]<br>Total Cost: $order_var[total]";
	echo "<table><tr><td>Dish</td><td>qty</td><td>rate</td><td>cost</td></tr>";
	while($order = mysql_fetch_array($orders)) {
		echo "<tr><td>$order[name]</td> <td>$order[qty]</td> <td>$order[cost]</td> <td>".($order['qty']*$order['cost'])."</td></tr>";
	}
	echo "</table><hr /><br/>";
}
?>
</body>
</html>
