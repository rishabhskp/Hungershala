function duplicate(field, value)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		if(xmlhttp.responseText!="") {
			document.getElementById("err-"+field).innerHTML=xmlhttp.responseText;
			return false;
		}
		else
			return true;
    }
  }
xmlhttp.open("POST","php/duplicate.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("field="+field+"&value="+value);
 }

function jscoupon()
{
var x=document.forms["registerform"]["coupon"].value;
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			document.getElementById("err-coupon").innerHTML=xmlhttp.responseText;
  }
xmlhttp.open("POST","php/coupon.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("code="+x);
}

//name
function jsname() {
	var x=document.forms["registerform"]["name"].value;
	var regex = /^[A-Za-z][A-Za-z. ]+$/;
	if(!regex.test(x)) {
		document.getElementById("err-name").innerHTML="Name Invalid";
		return false;
	}
	else {
		document.getElementById("err-name").innerHTML="";
		return true;
	}
}

//e-mail
function jsemail() {
	var x=document.forms["registerform"]["email"].value;
	duplicate("email", x);
	var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)*$/;
	if(!regex.test(x)) {
		document.getElementById("err-email").innerHTML="Invalid Email";
		return false;
	}
	else {
		document.getElementById("err-email").innerHTML="";
		return true;
	}
}

//password
function jspassword() {
	var x=document.forms["registerform"]["password"].value;
	var regex = /^.{5,20}$/;
	if(!regex.test(x)) {
		document.getElementById("err-password").innerHTML="Password too short";
		return false;
	}
	else {
		document.getElementById("err-password").innerHTML="";
		return true;
	}
}

//roll number
function jsrollno() {
	var x=document.forms["registerform"]["rollno"].value;
	//duplicate("rollno", x);
	var regex = /^\d{9}$/;
	if(!regex.test(x)) {
		document.getElementById("err-rollno").innerHTML="Invalid Rollno";
		return false;
	}
	else {
		document.getElementById("err-rollno").innerHTML="";
		return true;
	}
}

//hostel
function jshostel() {
	var x=document.forms["registerform"]["hostel"].value;
	var regex= /^(Agate|Amber-A|Amber-B|Aquamarine-A|Aquamarine-B|Aquamarine-C|Coral|Diamond|Jade|Garnet-A|Garnet-B|Garnet-C|Emerald|Lapis|Pearl|Ruby|Sapphire|Topaz|Opal-A|Opal-B|Opal-C|Opal-D|Opal-E|Zircon-A|Zircon-B|Zircon-C)$/;
	if(!regex.test(x) && x) {
		document.getElementById("err-hostel").innerHTML="Invalid Hostel";
		return false;
	}
	else {
		document.getElementById("err-hostel").innerHTML="";
		return true;
	}
}

//mobile number
function jsmobile() {
	var x=document.forms["registerform"]["mobile"].value;
	var regex = /^[789]\d{9}$/;
	if(!regex.test(x) && x) {
		document.getElementById("err-mobile").innerHTML="Invalid Mobile Number";
		return false;
	}
	else {
		document.getElementById("err-mobile").innerHTML="";
		return true;
	}
}

//pincode
function jspincode() {
	var x=document.forms["form"]["pincode"].value;
	var regex = /^\d{6}$/;
	if(!regex.test(x)) {
		document.getElementById("err-pincode").innerHTML="Invalid Pincode";
		return false;
	}
	else {
		document.getElementById("err-pincode").innerHTML="";
		return true;
	}
}

//username
function jsusername() {
	var x=document.forms["form"]["username"].value;
	var regex = /^([a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)*|\d{9})$/;
	if(!regex.test(x)) {
		document.getElementById("err-username").innerHTML="Enter Email or Rollno";
		return false;
	}
	else {
		document.getElementById("err-username").innerHTML="";
		return true;
	}
}

//restaurant owner mobile
function jsresmobile() {
	var x=document.forms["form"]["mobile"].value;
	var regex = /^[789]\d{9}$/;
	if(!regex.test(x)) {
		document.getElementById("err-mobile").innerHTML="Invalid Mobile Number";
		return false;
	}
	else {
		document.getElementById("err-mobile").innerHTML="";
		return true;
	}
}

//validation of signupform on submit
function jssignup() {
	var b = jsemail();
	var c = jspassword();
	var d = jsrollno();
	var e = jshostel();
	var f = jsmobile();
	var check = (b && c && d && e && f );
	return check;
}

//validation of login form on submit
function jslogin() {
	var h = jsusername();
	return h;
}

function jsorder() {
	var e = jshostel();
	var f = jsmobile();
	var check = (e && f);
	if(confirm("Are You Sure?"))
		return check;
	else
		return false;
}
//validation of collegeform on submit
function jscollege() {
	var a = jsname();
	var b = jsemail();
	var f = jsmobile();
	var g = jspincode();
	var check = (a && b && f && g);
	return check;
}

//validation of restaurantform on submit
function jsrestaurant() {
	var a = jsname();
	var f = jsresmobile();
	var g = jspincode();
	var check = (a && f && g);
	return check;
}