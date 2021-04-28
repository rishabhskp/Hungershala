<div class="page-header">
<a href="index.php"><img src="images/logo.png"/></a>
<h2 style="float:right; margin:20px">Need Help? Call 9655322051</h2>
<div class="nav-bar" id="navbar">
<div class="nav-bar-inner">
<span class="element"><?php if($logged) echo $_SESSION["name"]; else echo "Hungershala";?></span>
<span class="divider"></span>
<ul class="menu">
<?php
$res = mysql_query("SELECT name, code from list_restaurants");
while($rest = mysql_fetch_array($res))
	echo "<li><a href=\"$rest[code]\">$rest[name]</a></li>";
?>
<!-- <li class="divider"></li>
 <li><a href="breadbasket.php">Bread Basket Bakery</a></li>
 -->
<li class="divider"></li>
<li><?php if($logged) echo"<a href=\"logout.php\">Logout</a>"; else echo"<a href=\"forms/college.php\"> Not from NITT?</a>" ?>
</li>
</ul>
</div>
</div>
</div>