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
	$username = strip_tags(trim(mysqli_real_escape_string($conn, $_POST['username'])));
	$firstname= strip_tags(trim(mysqli_real_escape_string($conn, $_POST['firstname'])));
	$lastname = strip_tags(trim(mysqli_real_escape_string($conn, $_POST['lastname'])));
	$email = strip_tags(trim(mysqli_real_escape_string($conn, $_POST['email'])));
	
	//check that email is valid, if invalid, return to signup
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			header ("location:signup.html");
			exit();
		}
	
	$password =strip_tags(trim(mysqli_real_escape_string($conn, $_POST['password'])));
	
	//check if username exists
	$sqlFindUsername = "SELECT Username FROM users WHERE username =?";
	$stmtFindUsername = $conn->prepare($sqlFindUsername);
	$stmtFindUsername->bind_param('s', $username);
	$stmtFindUsername->execute();
	
	if ($stmtFindUsername->execute())
	{
		mysqli_stmt_store_result($stmtFindUsername);
		
	if (mysqli_stmt_num_rows($stmtFindUsername) == 1)
	{
		header("location:signup.html");
		exit();
	}
	
	//check if email exists
	$sqlFindEmail = "SELECT Email FROM users WHERE Email =?";
	$stmtFindEmail= $conn->prepare($sqlFindEmail);
	$stmtFindEmail->bind_param('s', $email);
	$stmtFindEmail->execute();
	
	if ($stmtFindEmail->execute())
	{
		mysqli_stmt_store_result($stmtFindEmail);
		
	if (mysqli_stmt_num_rows($stmtFindEmail) == 1)
	{
		header("location:signup.html");
		exit();
	}
	
	$stmtFindUsername->close();
	$passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
	
	$sqlInsertUser = "INSERT INTO Users (Username, LastName, FirstName, Email, PasswordHash) VALUES (?,?,?,?,?)";
	$stmtInsert = $conn->prepare($sqlInsertUser);
	$stmtInsert->bind_param('sssss', $username, $lastname, $firstname, $email, $passwordHash);
	$result = $stmtInsert->execute();
	
	
	if ($result) {
		header("location: login.html");
	}
	else {
		array_push($errors, "error");
	}

	
	
}
}
}
?>