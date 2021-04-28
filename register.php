<?php
require_once("php/connect.php");
session_start();
include("php/cookielogin.php");
if($_SESSION["loggedin"]=="yes")
	header("Location: index.php");
$err = array();
if(isset($_POST['submit'])) {
	include("php/formvalidation.php");
	signup();
	if(empty($err)) { //updating database
		$pass= md5($_POST[password]);
		$query = "INSERT INTO users (name, email, password, rollno, hostel, mobile) VALUES ('$_POST[name]', '$_POST[email]', '$pass', '$_POST[rollno]', '$_POST[hostel]', '$_POST[mobile]')";
		if(mysql_query($query)) {
			$user_id = mysql_insert_id();
			$_SESSION['loggedin']="yes";
			$_SESSION['user_id']=$user_id['user_id'];
			$_SESSION['name']=$_POST['name'];
			$_SESSION['email']=$_POST['email'];
			$_SESSION['rollno']=$_POST['rollno'];
			$_SESSION['hostel']=$_POST['hostel'];
			$_SESSION['mobile']=$_POST['mobile'];
			$_SESSION['cookietime'] = time()+(3*365*24*60*60); //3 years time
			setcookie("_ui", $user_id['user_id'], $_SESSION['cookietime']);
			setcookie("_prh", md5($pass.$_POST['rollno']), $_SESSION['cookietime']);
			mysql_query("UPDATE users SET loggedin = loggedin+1 WHERE user_id = '$user_id[user_id]'");
			$update = "New User: $_POST[name], $_POST[email], $_POST[password], $_POST[rollno], $_POST[hostel], $_POST[mobile]";
			mysql_query("INSERT INTO updates (priority, content) VALUES ('230', '$update')");
			header("Location: index.php");
		}
		else {
			echo "Sorry, something went terribly wrong. We are working on getting this fixed as soon as we can.";
			$update = "Critical Error: New record insertion for table users failed. Values were $_POST[name], $_POST[email], $_POST[password], $_POST[rollno], $_POST[hostel], $_POST[mobile]";
			mysql_query("INSERT INTO updates (priority, content) VALUES ('250', '$update')");
		}
	}
	else {
		$update = "New User regitration failed: $_POST[name], $_POST[email], $_POST[password], $_POST[rollno], $_POST[hostel], $_POST[mobile]";
		mysql_query("INSERT INTO updates (priority, content) VALUES ('240', '$update')");
	}
}
if(!isset($_POST['submit']) || !empty($err)) {
?>
<form name="registerform" action="<?php echo $PHP_SELF; ?>" method="post" onsubmit="return jssignup()">
<fieldset>
<legend>Hungry? Register Now!</legend>
<div>
	<div class="input-control text span3">
	<span class="fg-color-redLight" id="err-name"><?php echo $err['name']; ?></span>
	<input type="text" id="name" name="name" title="Enter your Full Name" placeholder="Full Name" value="<?php echo $val['name']?>" autofocus onchange="jsname()" style="text-transform:capitalize" pattern="^[A-Za-z][A-Za-z. ]+$" required/>
	</div>
</div>
<div>	
	<div class="input-control text span3">
	<span class="fg-color-redLight" id="err-email"><?php echo $err['email']; ?></span>
	<input id="email" type="email" name="email" title="Enter your email address" placeholder="Email Address" value="<?php echo $val['email']?>" onchange="jsemail()" required/>
	</div>
</div>
<div>
	<div class="input-control password span3">
	<span class="fg-color-redLight" id="err-password"><?php echo $err['password']; ?></span>
	<input id="password" type="password" name="password" title="Minimum 5 char long" placeholder="Password" value="<?php echo $val['password']?>" maxlength="20" onchange="jspassword()" pattern="^.{5,20}$" required />
	</div>
</div>
<div>
	<div class="input-control text span3">
	<span class="fg-color-redLight" id="err-rollno"><?php echo $err['rollno']; ?></span>
	<input type="text" id="rollno" name="rollno" title="Your 9 digit college roll number" placeholder="Roll Number" value="<?php echo $val['rollno']?>" maxlength="9" onchange="jsrollno()" pattern="^\d{9}$" required/>
	</div>
</div>
<div>
	<div class="input-control select span3">
	<span class="fg-color-redLight" id="err-hostel"><?php echo $err['hostel']; ?></span>
	<select id="hostel" name="hostel" title="Where do you want your food to be delivered?" onchange="jshostel()" required>
		<option id="Hostel" value="Hostel" disabled selected>Hostel</option>
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
</div>
<div>
	<div class="input-control text span3">
	<span class="fg-color-redLight" id="err-mobile"><?php echo $err['mobile']; ?></span>
	<input id="mobile" type="phone" name="mobile" maxlength="10" title="Enter your 10-digit mobile number" placeholder="Mobile Number" value="<?php echo $val['mobile']?>" onchange="jsmobile()" pattern="^[789]\d{9}$" required/>
	</div>
</div>
<input type="submit" value="Submit" name="submit"/>
</fieldset>
</form>
<?php
}
?>
</body>
</html>
