<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
require_once("php/forcelogin.php");
if($_SESSION['restaurant']!="chickpunch")
	unset($_SESSION['dishes']);
$_SESSION['restaurant']="chickpunch";
$logged=1;
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Chick Punch -- Order Online @ Hungershala.com</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
<style>
li {
list-style-type: none;
}
#categories {
float:left;
position:fixed;
top:80pt;
left:5.3%;
}
.menu {
float: left;
margin-left: 3%;
padding-top:10pt;
}
#order {
position:absolute;
right:-100pt;
}
h3 {
text-decoration: underline;
text-transform: uppercase;
}
.pointer {
cursor: pointer;
color: #2e92cf;
}
.pointer:hover {
color: rgba(45, 173, 237, 0.8);
}
</style>
<script src="js/jquery.js" ></script>
<script src="js/input-control.js" ></script>
<script src="js/formvalidation.js"></script>
<script>
function cart(dishId, operation) {
var xmlhttp;
if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
else // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		document.getElementById("cart").innerHTML=xmlhttp.responseText;
}
if(operation!=0)
	xmlhttp.open("POST","php/cart.php",true);
else
	xmlhttp.open("POST","php/clearcart.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("dishid="+dishId+"&operation="+operation);
}
</script>
</head>
<body class="metrouicss">
<div class="page">
<?php
include("php/navbar.php");
?>
<div id="categories">
<h2>Chick Punch</h2>
<h2>Categories</h2>
<?php
$categories = mysql_query("SELECT DISTINCT category FROM menu_chickpunch");
echo "<ul>";
while($category = mysql_fetch_array($categories))
	echo "<li><a href=\"#$category[category]\" value=\"$category[category]\">$category[category]</a></li>";
echo "</ul>";
?>
</div>
<div class="menu">
<?php
$categories = mysql_query("SELECT DISTINCT category FROM menu_chickpunch");
while($category = mysql_fetch_array($categories)) {
	echo "<div class=\"category\" id=\"$category[category]\"><h3>$category[category]</h3><table>";
	$dishes = mysql_query("SELECT * FROM menu_chickpunch WHERE category='$category[category]'");
	while($dish = mysql_fetch_array($dishes)) {
		if($dish[veg]=="veg")
			$mark="images/veg_mark.png";
		else
			$mark="images/nonveg_mark.png";
		echo"<tr class=\"dish\">
				<td><img src=\"$mark\" width=\"18px\" height=\"18px\" style=\"vertical-align:text-bottom\"/> <span class=\"dishname\">$dish[name]</span>
				<div class=\"dishdescription\">$dish[description]</div></td>
				<td>Rs.$dish[cost]</td><td><span class=\"pointer\" onclick=\"cart($dish[dish_id], 1)\">Add</span></td>
			</tr>\n\n";
	}
	echo "</table></div>\n\n";
}
?>
</div>
<div id="order">
	<div id="cart">
	<?php
	if(empty($_SESSION['dishes'])) {
		$_SESSION['dishes'] = array();
		$_SESSION['dishcount'] = 0;
		$_SESSION['totalqty'] = 0;
		$_SESSION['total']=0;
		$_SESSION["coupon"]="no";
	}
	include("php/cart.php");
	?>
	</div>
	<form name="registerform" action="placeorder.php" method="post" onsubmit="return jsorder()">
	<div class="input-control select span2">
	<span class="fg-color-redLight" id="err-hostel"><?php echo $err['hostel']; ?></span>
	<select id="hostel" name="hostel" title="Where do you want your food to be delivered?" onchange="jshostel()" required>
		<option id="Hostel" value="Hostel" disabled>Hostel</option>
		<option id="default" value="<?php echo $_SESSION['hostel'] ?>" selected><?php echo $_SESSION['hostel'] ?></option>
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
	</select>
	</div>
	<div class="input-control text span2">
	<span class="fg-color-redLight" id="err-mobile"><?php echo $err['mobile']; ?></span>
	<input id="mobile" type="phone" name="mobile" maxlength="10" title="Enter your 10-digit mobile number" placeholder="Mobile Number" value="<?php echo $_SESSION['mobile']?>" onchange="jsmobile()" pattern="^[789]\d{9}$" required/>
	</div>
	<div class="input-control text span2">
	<span class="fg-color-redLight" id="err-coupon"><?php echo $err['coupon']; ?></span>
	<input id="coupon" type="text" name="coupon" title="Have a Coupon?" placeholder="Coupon Code?" onchange="jscoupon()"/>
	</div>
	<input type="submit" value="Place Order" name="placeorder"/>
	</form>
</div>
</div>
</body>
</html>