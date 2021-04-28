<?php
session_start();
include("php/connect.php");
include("php/cookielogin.php");
if($_SESSION["loggedin"]=="yes")
	header("Location: index.php");
if(isset($_POST['reset'])){
	if($_POST['password'] == $_POST['repassword']) {
		$pass = md5($_POST['password']);
		if(mysql_query("UPDATE users SET password = '$pass' WHERE email = '$_SESSION[email]'"))
			echo "Password rest Successfully!!!";
		else 
			echo "Something is fucked up!!!";
	}
	else
		echo "Passwords Dont match!!!";
}
else {
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Forgot Password -- Hungershala.com</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
<script src="js/formvalidation.js"></script>
</head>
<body class="metrouicss">
<?php
if(!isset($_GET['email']) || !isset($_GET['code']))
	echo "Link is invalid.";
else
{
	$row = mysql_query("SELECT email FROM users WHERE email = '$_GET[email]'");
	$row = mysql_fetch_array($row);
	if(!$row['email'])
		echo "Invalid Request. Check the link.";
	else if ($_GET['code'] == md5($row['email'].date("Y-m-d"))) {
		$_SESSION["email"] = $row['email'];
?>
<form name="form"  action="resetpassword.php" method="post">
<fieldset>
<legend>
Reset Password
</legend>
<div>
	<label id="label-password" for="password" title="Enter new Password" >New Password:<span class="fg-color-redLight">*</span></label>
	<input id="password" type="password" name="password" title="Enter new Password" value="<?php echo $_POST['password']?>" maxlength="20" pattern="^.{5,20}$" required />
	<span class="fg-color-redLight" id="err-password"><?php echo $err['password']; ?></span>
</div>
<div>
	<label id="label-repassword" for="repassword" title="Retype Password" >Retype Password:<span class="fg-color-redLight">*</span></label>
	<input id="repassword" type="password" name="repassword" title="Retype Password" value="<?php echo $_POST['repassword']?>" maxlength="20" pattern="^.{5,20}$" required />
	<span class="fg-color-redLight" id="err-repassword"><?php echo $err['repassword']; ?></span>
</div>
<input type="submit" name="reset" value="Reset"/>
</fieldset>
</form>
<?php
	}
	else
		echo "Your Password reset link seems to have expired. Request a new one!";
}
?>
</body>
<?php
}
?>