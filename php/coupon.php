<?php
require_once("connect.php");
if($_POST["code"]=="FESTEMBER13"){
	$limit = mysql_query("SELECT left FROM coupons WHERE restaurant='$_SESSION[restaurant]'");
	if($limit["left"]>0) {
		echo "Coupon Activated";
		$_SESSION["coupon"]="yes";
	}
	else {
		echo "Coupon Maxed out for this Restaurant";
		$_SESSION["coupon"]="no";
	}
}
else {
	echo "Invalid Coupon Code";
	$_SESSION["coupon"]="no";
}
?>