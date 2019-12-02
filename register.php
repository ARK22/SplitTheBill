<?php

$username = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";
$errors = array();

session_start();

require 'connect.php';


if (isset($_POST['register'])) {
	//get values from user submitted form
	//TODO: check values for errors, length, etc before insertion
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$firstname= mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$userid = uniqid('1');
	
	echo $username;
	
	
	//check if username exists
	$sqlFindUsername = "SELECT * FROM users WHERE username =?";
	$stmtFindUsername = $conn->prepare($sqlFindUsername);
	$stmtFindUsername->bind_param('s', $username);
	$stmtFindUsername->execute();
	
	//TODO: Redirect back to signup page if username already exists
	if (!$stmtFindUsername->execute()) {
		die("That username already exists, please pick a new username.");
	}
	$stmtFindUsername->close();
	$passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
	
	$sqlInsertUser = "INSERT INTO Users (Username, LastName, FirstName, Email, PasswordHash) VALUES (?,?,?,?,?)";
	$stmtInsert = $conn->prepare($sqlInsertUser);
	$stmtInsert->bind_param('sssss', $username, $lastname, $firstname, $email, $passwordHash);
	$result = $stmtInsert->execute();
	
	
	if ($result) {
		echo "You have registered successfully";
	}
	else {
		array_push($errors, "error");
	}

	
	
}
?>