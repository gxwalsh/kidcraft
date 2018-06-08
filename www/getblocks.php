{"blocks":[
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "kidcraft";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `pos`,`val` FROM `blocks`";
$result = $conn->query($sql);
//{"pos":"20,2,-32","val":"3"},
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "{\"pos\": \"" . $row["pos"]. "\",\"val\":\"" . $row["val"]. "\"},\n";
    }
} 
$conn->close();
?> 
{"pos": "-20,-20,-2","val":"1"}
]}