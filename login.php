<?php
$username = "";
$password = "";
$errors = array();
$errorflag = false;


session_start();


require 'connect.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.html");
    exit;
}

function clean($str) {
		echo "str: ".$str;
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
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
		
	if (mysqli_stmt_num_rows($stmtFindUsername) == 1)
	{
		echo "User found";
		mysqli_stmt_bind_result($stmtFindUsername, $userid, $username, $hashed_password);
		
		if (mysqli_stmt_fetch($stmtFindUsername)) {
			if (password_verify($password, $hashed_password)){

				session_start();
				$_SESSION["loggedin"] = true;
				$_SESSION['id'] = $userid;
				$_SESSION["username"] = $username;
				
				header("location: home.html");
			}
			else {
				$errors[] = "Invalid Password";
			}
		}
	} else {
		$errors[] = "User could not be found";
	}
	mysqli_stmt_close($stmtFindUsername);
	}
	mysqli_close($conn);
}

?>