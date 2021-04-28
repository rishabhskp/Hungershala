<?php
require_once("php/connect.php");
session_start();
require_once("php/cookielogin.php");
$logged=1;
?>
<!DOCTYPE html>
<html lang="en-Us">
<head>
<title>Hungershala -- Relieving NITT of Hunger</title>
<link rel="stylesheet" type="text/css" href="css/modern.css" />
<style>
.page {
width: 1020px  !important;
margin: auto !important;
}
fieldset {
	width: 460px;
	float: left;
}
</style>
</head>
<body class="metrouicss">
<div class="page">
<?php
include("php/navbar.php");
?>
<div>
	<label>Name:</label>
	<span>
	<?php echo $_SESSION["name"]?>
	</span>
</div>
<div>	
	<label>E-mail:</label>
	<span>
	<?php echo $_SESSION["email"]?>
	</span>
</div>
<div>
	<label>Roll No:</label>
	<span>
	<?php echo $_SESSION["rollno"]?>
	</span>
</div>
<div>
	<label>Hostel:</label>
	<span>
	<?php echo $_SESSION["hostel"]?>
	</span>
</div>
<div>	
	<label>Mobile No:</label>
	<span>
	<?php echo $_SESSION["mobile"]?>
	</span>
</div>
</div>
</body>
</html>
