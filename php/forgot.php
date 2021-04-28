<?php
ini_set("display_errors", 0);
include("connect.php");
include("formvalidation.php");
$username = $_GET['username'];
$record = mysql_query("SELECT email, rollno FROM users WHERE email = '$username' OR rollno = '$username'");
$row = mysql_fetch_array($record);
if($row['email']) {
	$code = md5($row[email].date("Y-m-d"));
	$link = "www.hungershala.com/resetpassword.php?email=$row[email]&code=$code";
	$webmail = $row[rollno]."@nitt.edu";
	$subject = "Password Reset Link";
	$message = "Hi,\n\t Here is the password reset link you requested. \n\t".$link." \n\tLink will expire today after 11:59 pm.";
	$headers = "From: corp@hungershala.com";
	mail($row[email],$subject,$message, $headers);
	mail($webmail, $subject, $message, $headers);
	echo "Check your Email/NITT webmail for the password reset link.";
}
else
	echo "User not found in our database.";
?>