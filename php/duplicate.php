<?php
require_once("connect.php");
$query = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE $_POST[field]='$_POST[value]'"));
if(!empty($query)){
	$err["$_POST[field]"] = "$_POST[field] already registered";
	echo $err["$_POST[field]"];
}
if($_POST["field"]=="rollno"){
	$query = mysql_fetch_array(mysql_query("SELECT * FROM roll_valid WHERE rollno='$_POST[value]'"));
	if(empty($query)){
		$err["rollno"] = "Invalid Rollno";
		echo $err["rollno"];
	}
}
?>
