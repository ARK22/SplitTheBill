<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "splitthebilldata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully <br>";

$sql = "SELECT * FROM Users;";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

if ($resultcheck > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo $row['Username'] . "<br>" ;
		
}
}
?>