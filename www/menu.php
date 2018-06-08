<?php 
$name = htmlspecialchars($_GET["name"]);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
</head>
<body>
<h1>Menu</h1>
<p>Select a Kidsteam area by clicking below.</p>
<p><a href="http://kidsteamonline.com:9966/?name=<? echo $name; ?>"><img src="kidsteam_menu.png" border="0"></a><br>
Kidcraft</p>
</body>
</html>
