<?php
$budgetname = "";
$itemname= "";
$category = "";

session_start();

require 'connect.php';

if (isset($_POST['createbudget'])) {
	$budgetname = strip_tags(trim(mysqli_real_escape_string($conn, $_POST["budgetname"])));
	$ownerid = $_SESSION['id'];
	
	$sqlNewBudget = "INSERT INTO Budgets (BudgetName, OwnerID) VALUES (?,?)";
	$stmtNewBudget= $conn->prepare($sqlNewBudget);
	$stmtNewBudget->bind_param('ss', $budgetname, $ownerid);
	
	$result = $stmtNewBudget->execute();
	
	if ($result) {
		header("location: home.html");
	echo $userid;
	}
	else {
		header("location:fail");
	}
}

