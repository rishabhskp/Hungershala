<?php
session_start();
setcookie("stat", "", $_SESSION['cookietime']);
session_destroy();
unset($_SESSION);
header("Location: index.php");
?>