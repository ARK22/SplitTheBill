<?php
$username = "";
$password = "";

session_start();

require 'connect.php';


	$sqlFindUsername = "SELECT COUNT(*) FROM Users WHERE username = '$username'";
	$stmtFindUsername = $conn->prepare($sqlFindUsername);
	$stmtFindUsername->bind_param('s', $username);
	$stmtFindUsername->execute();
	
	if (!$stmtFindUsername->execute())
	{
		if(password_verify(password,"SELECT password FROM Users WHERE username = $username") == false)
		{
			die("Incorrect password");
		}
		else
		{
			echo "welcome back";
		}
	}
	else
	{
		die("That username does not exit.");
	}

?>