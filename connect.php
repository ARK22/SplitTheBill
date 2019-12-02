<?php
$servername = "localhost";
$usernameserver = "root";
$password = "";
$dbname = "splitthebilldata";


$username = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";


// Create connection
$conn = new mysqli($servername, $usernameserver, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>