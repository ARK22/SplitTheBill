<?php

$username = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";

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
	
	
	//check if username exists
	$sqlFindUsername = "SELECT COUNT(Username) AS num FROM Users WHERE Username = $username";
	$stmtFindUsername = $pdo->prepare($sqlFindUsername);
	$stmtFindUsername->bindValue(':username', $username);
	$stmtFindUsername->execute();
	$row = $stmtFindUsername->fetch(PDO::FETCH_ASSOC);
	
	//TODO: Redirect back to signup page if username already exists
	if ($row['num'] > 0) {
		die("That username already exists, please pick a new username.");
	}
	
	$passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
	
	$sqlInsertUser = "INSERT INTO Users (Username, LastName, FirstName, Email, PasswordHash, UserID) VALUES ('$username', '$lastname', '$firstname', '$email', '$password', '$userid')";
	$stmtInsert = $pdo->prepare($sqlInsertUser);
	
	$stmt->bindValue('username', $username);
	$stmt->bindValue('lastname', $lastname);
	$stmt->bindValue('firstname', $firstname);
	$stmt->bindValue('email', $email);
	$stmt->bindValue('password', $passwordHash);
	
	$result = $stmtInsert->execute();
	
	
	if ($result) {
		echo "You have registered successfully";
	}
	else {
		echo "error";
	}

	
	
}
?>