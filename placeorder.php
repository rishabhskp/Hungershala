<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
require_once("php/forcelogin.php");
if(empty($_SESSION['dishes']))
	header("Location: index.php");
else {
	mysql_query("INSERT INTO order_var (user_id, restaurant, hostel, mobile, total) VALUES('$_SESSION[user_id]', '$_SESSION[restaurant]', '$_POST[hostel]', '$_POST[mobile]', '$_SESSION[total]')");
	$order_id = mysql_insert_id();
	foreach($_SESSION['dishes'] as $dish => $val)
		mysql_query("INSERT INTO orders (order_id, dish_id, qty) VALUES ('$order_id', '$dish', '$val[qty]')");
	mysql_query("UPDATE users SET ordered = ordered+1, total=total+$_SESSION[total] WHERE user_id = '$_SESSION[user_id]'");
	mysql_query("UPDATE list_restaurants SET sales=sales+$_SESSION[total] WHERE name = '$_SESSION[restaurant]'");
	$update = "New Order by $_SESSION[name], $_SESSION[rollno], $_POST[hostel], $_POST[mobile]. Hotel: $_SESSION[restaurant] total qty: $_SESSION[totalqty] total amt: $_SESSION[total]";
	mysql_query("INSERT INTO updates (priority, content) VALUES ('235', '$update')");
	if($_SESSION['coupon']=="yes") {
		mysql_query("UPDATE coupons SET left = left-1 WHERE restaurant = '$_SESSION[restaurant]'");
		$_SESSION['discount']=10;
	}
	$_SESSION['dishcount'] = 0;
	$_SESSION['totalqty'] = 0;
	$_SESSION['total']=0;
	$_SESSION["coupon"]="no";
	unset($_SESSION['dishes']);
}
$logged=1;
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Order Variables -- Hungershala.com</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
</head>
<body class="metrouicss">
<div class="page">
<?php
include("php/navbar.php");
?>
<h2> Order #<?php echo $_SESSION["user_id"].$order_id; ?> Placed Successfully</h2>
<h3>Just Sit Back and Wait....</h3>
</div>
</body>
</html>