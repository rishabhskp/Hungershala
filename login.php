<?php
require_once("php/connect.php");
//login section
$err = array();
if(isset($_POST['signin'])) {
	include("php/formvalidation.php");
	$field = username();
	password();
	if(empty($err)) {
		$username=$_POST['username'];
		$record = mysql_query("SELECT * FROM users WHERE $field = '$username'");
		$row = mysql_fetch_array($record);
		if($row['email']) {
				$tryhash = md5($_POST['password']);
				$realhash = $row['password'];
				if ($realhash == $tryhash) {
					$_SESSION['loggedin']="yes";
					$_SESSION['user_id']=$row['user_id'];
					$_SESSION['name']=$row['name'];
					$_SESSION['email']=$row['email'];
					$_SESSION['rollno']=$row['rollno'];
					$_SESSION['hostel']=$row['hostel'];
					$_SESSION['mobile']=$row['mobile'];
					$_SESSION['cookietime'] = time()+(3*365*24*60*60); //3 years time
					setcookie("stat", "khb7843bFB478BDSdgb73", $_SESSION['cookietime']);
					setcookie("_ui", $row['user_id'], $_SESSION['cookietime']);
					setcookie("_prh", md5($row['password'].$row['rollno']), $_SESSION['cookietime']);
					mysql_query("UPDATE users SET loggedin = loggedin+1, lastlogin = now() WHERE user_id = '$row[user_id]'");
					echo "<meta http-equiv=\"refresh\" content=\"0\">";
				}
				else
					$err['login'] = "Username and Password do not match. Forgot password?";
		}
		else
			$err['login'] = "Username invalid. Are u trying to register?";
	}
}
?>
<style>
.pointer {
cursor: pointer;
color: #2e92cf;
}
.pointer:hover {
color: rgba(45, 173, 237, 0.8);
}
</style>
<script src="js/formvalidation.js" ></script>
<script>
function forgot() {
	var usernameval = document.getElementById("username").value;
	if (!usernameval)
		alert("Enter your email-id or roll number");
	else if(!username())
		alert("Invalid entry in the field: Email / Rollno");
	else {
		var xmlhttp;
		if(window.XMLHttpRequest)// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		else	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			alert(xmlhttp.responseText);
		}
		xmlhttp.open("GET","php/forgot.php?username="+usernameval,true);
		xmlhttp.send();
	}
}
</script>
<form name="form"  action="<?php echo $PHP_SELF; ?>" method="post" onsubmit="return jslogin()" >
<fieldset>
<legend>
Sign In
</legend>
<div>
	<div class="input-control text span3">
	<input id="username" type="text" name="username" title="Enter Email or Roll Number" placeholder="Email / Rollno" value="<?php echo $_POST['username']?>" onchange="jsusername()" pattern="([a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)*|\d{9})" required autofocus/> 
	</div>
	<span class="fg-color-redLight" id="err-username"><?php echo $err['username']; ?></span>
</div>
<div>
	<div class="input-control password span3">
	<input id="password" type="password" name="password" title="Password - Minimum 5 char" placeholder="Password" value="<?php echo $_POST['password']?>" maxlength="20" pattern="^.{5,20}$"  required/>
	</div>
</div>
<div class="fg-color-redLight" id="err-login"><?php echo $err['login']; ?></div>
<input type="submit" name="signin" value="Log In"/>
<span class="pointer" id="forgot" onclick="forgot()">Forgot Password?</span>
</fieldset>
</form>