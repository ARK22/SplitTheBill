<?php
$username = "";
$password = "";
$errors = array();
$errorflag = false;

session_start();

require 'connect.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = strip_tags(trim(mysqli_real_escape_string($conn, $_POST["username"])));
	$password = strip_tags(trim(mysqli_real_escape_string($conn, $_POST["password"])));
	if($errorflag) {
		$_SESSION['ERRORS'] = $errors;
		session_write_close();
		header("location: login.html");
		exit();
	}
	
	$sqlFindUsername = "SELECT UserID, Username, PasswordHash FROM Users WHERE username = ?";
	$stmtFindUsername = $conn->prepare($sqlFindUsername);
	$stmtFindUsername->bind_param('s', $username);
	$stmtFindUsername->execute();
	
	if ($stmtFindUsername->execute())
	{
		mysqli_stmt_store_result($stmtFindUsername);
	}
	if (mysqli_stmt_num_rows($stmtFindUsername) == 1)
	{
		echo "user found";
		mysqli_stmt_bind_result($stmtFindUsername, $userid, $username, $hashed_password);
		if (mysqli_stmt_fetch($stmtFindUsername)) {
			if (password_verify($password, $hashed_password)){

				session_start();
				$_SESSION["loggedin"] = true;
				$_SESSION['id'] = $userid;
				$_SESSION["username"] = $username;
				header("location: home.php");
			}
			else {
				$errors[] = "Invalid Password";
				header("location:login.html");
			}
		}
	} else {
		$errors[] = "User could not be found";
		header("location:login.html");
	}
	mysqli_stmt_close($stmtFindUsername);
	}
	mysqli_close($conn);

?>