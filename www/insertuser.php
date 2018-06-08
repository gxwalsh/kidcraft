<?php
$name = $_GET["name"];

$key =  htmlspecialchars($_GET["key"]);



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

$sql = "INSERT INTO `kidcraft`.`userkey` (`id`, `name`, `key`) VALUES (NULL, '$name', '$key');";

if ($conn->query($sql) === TRUE) {
    echo $sql . " - New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>