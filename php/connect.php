<?php
date_default_timezone_set('Asia/Calcutta');
ini_set("display_errors", 0);
$db = mysql_connect("localhost", "lifewafb_main", "thisisit4") or die("Error: Could not connect to the database.");
mysql_select_db("lifewafb_hungrynitt", $db);
?>
