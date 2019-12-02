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
	$stmtNewBudget->bind_param('si', $budgetname, $ownerid);
	
	$result = $stmtNewBudget->execute();
	
	if ($result) {
		header("location: home.html");
	}
	else {
		header("location:fail");
	}

	$sqlGetBudgetID = "SELECT BudgetID FROM Budgets WHERE OwnerID = ?";
	$stmtGetBudgetID = $conn->prepare($sqlGetBudgetID);
	$stmtGetBudgetID->bind_param('i', $ownerid);
	$stmtGetBudgetID ->execute();
	
	//having issues with this part right here, i think
	if ($stmtFindUsername->execute())
	{
		mysqli_store_result($stmtFindUsername);
	}
	echo $stmtFindUsername;
	$memberid = $ownerid;

	$ismoderator = 1; //for current user logged in
	$sqlAddBudgetMember = "INSERT INTO BudgetMembers (MemberID, BudgetID, IsModerator) VALUES (?, ?, ?)";
	$stmtAddBudgetMember = $conn->prepare($sqlAddBudgetMember);
	$stmtAddBudgetMember->bind_param('iii', $memberid, $stmtFindUsername, $ismoderator);
	
}
	?>