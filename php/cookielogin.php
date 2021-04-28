<?php
if(!isset($_SESSION['loggedin']) && isset($_COOKIE['stat']))
	if(isset($_COOKIE['_ui']) && isset($_COOKIE['_prh']))
	{
		require_once("connect.php");
		$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE user_id = '$_COOKIE[_ui]'"));
		if($_COOKIE['_prh'] == md5("$row[password]$row[rollno]"))
		{
			$_SESSION['loggedin']="yes";
			$_SESSION['user_id']=$row['user_id'];
			$_SESSION['name']=$row['name'];
			$_SESSION['email']=$row['email'];
			$_SESSION['rollno']=$row['rollno'];
			$_SESSION['hostel']=$row['hostel'];
			$_SESSION['mobile']=$row['mobile'];
			mysql_query("UPDATE users SET loggedin = loggedin+1, lastlogin = now() WHERE user_id = '$row[user_id]'");
		}
	}
?>
