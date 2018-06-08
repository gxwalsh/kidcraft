<?php
$pos = $_GET["pos"];

$val =  htmlspecialchars($_GET["val"]);
$userid = htmlspecialchars($_GET["userid"]);


$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";

$sql = "INSERT INTO `kidcraft`.`blocks` (`id`, `pos`, `val`, `userid`, `time`) VALUES (NULL, '$pos', '$val', '$userid', CURRENT_TIMESTAMP);";

if ($conn->query($sql) === TRUE) {
    echo $sql . " - New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>