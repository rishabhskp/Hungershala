<?php
ini_set("display_errors", 0);
session_start();
$_SESSION['dishcount'] = 0;
$_SESSION['totalqty'] = 0;
$_SESSION['total']=0;
unset($_SESSION['dishes']);
include("cart.php");
?>