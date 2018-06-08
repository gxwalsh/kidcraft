<?php 
$name = htmlspecialchars($_GET["name"]);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Connect Audio</title>
</head>
<body>
<h1>Audio</h1>
<p>Click the button below to launch the audio. If you get any pop ups, just click "OK".
<p><a href = "mumble://<? echo $name; ?>:kidsteam@kidsteamonline.com/"><img src = "chat.png" border=0></a>
<p>After it is working and you can hear and we can hear you, click Next.
<p><a href="menu.php?name=<? echo $name; ?>">Next</a>
</body>
</html>
