<?php
session_start();
require_once("connect.php");
$dish_id = $_POST['dishid'];
$operation = $_POST['operation'];
if(isset($dish_id) && $dish_id) {
	if(isset($_SESSION['dishes'][$dish_id])) {
		$_SESSION['dishes'][$dish_id]['qty']+=$operation;
		$_SESSION['total']+=$operation*$_SESSION['dishes'][$dish_id]['cost'];
		if($_SESSION['dishes'][$dish_id]['qty']<1) {
			unset($_SESSION['dishes'][$dish_id]);
			$_SESSION['dishcount']--;
		}
		
	}
	else {
		$_SESSION['dishes'][$dish_id] = array();
		$_SESSION['dishes'][$dish_id]['qty'] = 1;
		$dish_details = mysql_fetch_array(mysql_query("SELECT name, cost FROM menu_$_SESSION[restaurant] where dish_id = $dish_id"));
		$_SESSION['dishes'][$dish_id]['name'] = $dish_details['name'];
		$_SESSION['dishes'][$dish_id]['cost'] = $dish_details['cost'];
		$_SESSION['dishcount']++;
		$_SESSION['total']+=$dish_details['cost'];
	}
	$_SESSION['totalqty']+=$operation;
}
?>
<table>
<h2>My Cart</h2>
<tr><td>Dish Name</td><td>Price</td><td>Qty</td><td>Cost</td></tr>
<?php
	foreach($_SESSION['dishes'] as $dish => $val)
		echo "<tr><td>$val[name]</td><td>$val[cost]</td><td><span class=\"pointer\" onclick=cart($dish,-1)> - </span>$val[qty]<span class=\"pointer\" onclick=cart($dish,1)> + </span></td><td>Rs.".($val['qty']*$val['cost'])."</td></tr>";
	if(!$_SESSION['dishcount'])
		echo "<tr><td colspan=\"4\">Your Cart is Empty</td></tr>";
	echo "<tr><td>Total</td><td>-</td><td>$_SESSION[totalqty]</td><td>Rs.$_SESSION[total]</td></tr></table>";
?>
<span class="pointer" onclick="cart(0, 0)"> Clear Cart </span>
