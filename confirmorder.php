<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
require_once("php/forcelogin.php");
$res=$_SESSION['restaurant'];
if(empty($_SESSION['dishes']))
	header("Location: index.php");
else {
	mysql_query("INSERT INTO order_var_$res (user_id, total) VALUES ($_SESSION[user_id], $_SESSION[total])");
	$order_id = mysql_insert_id();
	foreach($_SESSION['dishes'] as $dish => $val)
		mysql_query("INSERT INTO orders_$res (order_id, dish_id, qty) VALUES ($order_id, $dish, $val[qty])");
	mysql_query("UPDATE users SET ordered = ordered+1, total=total+$_SESSION[total] WHERE user_id = $_SESSION[user_id]");
	mysql_query("UPDATE list_restaurants SET sales=sales+$_SESSION[total] WHERE name = '$res'");
}
$logged=1;
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Order Variables -- Hungershala.com</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
<style>
.page {
width: 1020px  !important;
margin: auto !important;
}
#order {
position:fixed;
top:30pt;
right:1pt;
}
</style>
<script>
function update(field) {
var xmlhttp;
var val=document.getElementById(field).value;
if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
else // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		document.getElementById("cart").innerHTML=field+" Updated";
}
xmlhttp.open("POST","php/update.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("field="+field+"&val="+val);
}
</script>
</head>
<body class="metrouicss">
<div class="page">
<?php
include("php/navbar.php");
?>
<h1>Your food is on the way, meanwhile...</h1>
<p>These are your order variables, change the ones you don't like and they will be updated automatically!!!</p>
<div class="input-control select span3">
	<input list="hostels" style="text-transform:capitalize" id="hostel" name="hostel" title="Where do you want your food to be delivered?" onchange="update('hostel')" autocomplete="off" value="<?php echo $_SESSION['hostel'];?>"/>
	<datalist id="hostels">
		<option id="Agate" value="Agate">Agate</option>
		<option id="Amber-A" value="Amber-A">Amber-A</option>
		<option id="Amber-B" value="Amber-B">Amber-B</option>
		<option id="Aquamarine-A" value="Aquamarine-A">Aquamarine-A</option>
		<option id="Aquamarine-B" value="Aquamarine-B">Aquamarine-B</option>
		<option id="Aquamarine-C" value="Aquamarine-C">Aquamarine-C</option>
		<option id="Coral" value="Coral">Coral</option>
		<option id="Diamond" value="Diamond">Diamond</option>
		<option id="Jade" value="Jade">Jade</option>
		<option id="Garnet-A" value="Garnet-A">Garnet-A</option>
		<option id="Garnet-B" value="Garnet-B">Garnet-B</option>
		<option id="Garnet-C" value="Garnet-C">Garnet-C</option>
		<option id="Emerald" value="Emerald">Emerald</option>
		<option id="Lapis" value="Lapis">Lapis</option>
		<option id="Pearl" value="Pearl">Pearl</option>
		<option id="Ruby" value="Ruby">Ruby</option>
		<option id="Sapphire" value="Sapphire">Sapphire</option>
		<option id="Topaz" value="Topaz">Topaz</option>
		<option id="Opal-A" value="Opal-A">Opal-A</option>
		<option id="Opal-B" value="Opal-B">Opal-B</option>
		<option id="Opal-C" value="Opal-C">Opal-C</option>
		<option id="Opal-D" value="Opal-D">Opal-D</option>
		<option id="Opal-E" value="Opal-E">Opal-E</option>
		<option id="Zircon-A" value="Zircon-A">Zircon-A</option>
		<option id="Zircon-B" value="Zircon-B">Zircon-B</option>
		<option id="Zircon-C" value="Zircon-C">Zircon-C</option>
	</datalist>
</div>
<div class="input-control text span3">
	<input id="mobile" type="phone" name="mobile" maxlength="10" pattern="^[789]\d{9}$" title="Enter your 10-digit mobile number" placeholder="Mobile number"onchange="update('mobile')" value="<?php echo $_SESSION['mobile'];?>" />
	<button class="btn-clear" > </button>
</div>
<p class="fg-color-redLight">Note: Invalid phone number, no response from the customer may lead to cancellation of order.</p>
</div>
</body>
</html>
