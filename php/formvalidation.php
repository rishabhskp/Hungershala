<?php
//name
function name($fieldname) {
	global $err;
	$x = $_POST[$fieldname];
	$regex="/^[A-Za-z][A-Za-z. ]+$/";
	if(!preg_match($regex, $x)) {
		$err["$fieldname"]= "Give proper value";
		return false;
	}
	else
		return true;
}
//email 
function email($tablename) {
	global $err, $mode;
	$x=$_POST['email'];
	if(!filter_var($x, FILTER_VALIDATE_EMAIL)) {
		$err['email'] = "Enter a valid E-mail address.";
		return false;
	}
	else if($mode){
		$check = mysql_fetch_array(mysql_query("SELECT email FROM $tablename WHERE email = '$x'"));
		if($check['email']) {
			$err['email']="A registration with the given e-mail address has already been made.";
			return false;
		}
	}
	return true;
}
//password
function password() {
	global $err;
	$regex="/^.{5,20}$/";
	$x=$_POST['password'];
	if (!preg_match($regex,$x)) {
		$err['password']= "Password should be 5-20 characters long.";
		return false;
	}
	return true;
}
//rollno
function rollno() {
	global $err, $mode;
	$x=$_POST['rollno'];
	$regex="/^\d{9}$/";
	if(!preg_match($regex, $x)) {
		$err['rollno']="Enter your college roll number.";
		return false;
	}
	else if($mode){
		$check = mysql_fetch_array(mysql_query("SELECT rollno FROM users WHERE rollno = '$x'"));
		if($check['rollno']) {
			$err['rollno']="A registration with the given rollno has already been made.";
			return false;
		}
	}
	return true;
}
//hostel
function hostel() {
	global $err;
	$x=$_POST['hostel'];
	$regex="/^(Agate|Amber-A|Amber-B|Aquamarine-A|Aquamarine-B|Aquamarine-C|Coral|Diamond|Jade|Garnet-A|Garnet-B|Garnet-C|Emerald|Lapis|Pearl|Ruby|Sapphire|Topaz|Opal-A|Opal-B|Opal-C|Opal-D|Opal-E|Zircon-A|Zircon-B|Zircon-C)$/";
	if($x && !preg_match($regex, $x)) {
		$err['hostel']="Hostel name not found in our records. Check for capitalization.";
		return false;
	}
	return true;
}
//Mobile No
function mobile() {
	global $err;
	$x=$_POST['mobile'];
	$regex = "/^[789]\d{9}$/";
	if($x && !preg_match($regex,$x)) {
		$err['mobile']= "Enter a valid 10-digit mobile number.";
		return false;
	}
	return true;
}
//pincode
function pincode() {
	global $err;
	$x=$_POST['pincode'];
	$regex = "/^\d{6}$/";
	if(!preg_match($regex,$x)) {
		$err['pincode']= "Pincode entered is invalid.";
		return false;
	}
	return true;
}
//required field
function required($fieldname) {
	global $err;
	$x=$_POST[$fieldname];
	if(!$x)
		$err["$fieldname"]= "Enter value for field: ".$fieldname;
}
//username
function username() {
	global $err;
	$x=$_POST['username'];
	if(filter_var($x, FILTER_VALIDATE_EMAIL))
		return 'email';
	$regex="/^\d{9}$/";
	if(preg_match($regex, $x))
		return 'rollno';
	$err['username']="Enter either your email id or rollno to login";
	return false;
}
function signup() {
	global $mode;
	name('name');
	email('users');
	if($mode)
		password();
	rollno();
	hostel();
	mobile();
}
function college() {
	name('name');
	email('request_college');
	mobile();
	required('mobile');
	name('colname');
	name('district');
	name('state');
	pincode();
}
function restaurant() {
	name('name');
	name('designation');
	mobile();
	required('mobile');
	name('resname');
	name('district');
	name('state');
	pincode();
}
?>
