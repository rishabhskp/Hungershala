<?php
if($_SESSION["loggedin"]!="yes") {
?>
<script>
if (confirm("You Need to Login First!"))
	location.href = "index.php";
else
	location.href = "index.php";
</script>
<?php
}
?>