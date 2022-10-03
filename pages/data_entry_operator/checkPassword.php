<?php
session_start();
include('includes/db.php');

	$userID = $_SESSION['DataEntryOperator'];
	$oldPass = $_POST['oldPass'];

	$query = "SELECT * FROM management_users WHERE id = '$userID'";
	$run_query = mysqli_query($connection,$query);
	$row_rec = mysqli_fetch_array($run_query);

	$userPaswsord = $row_rec['password'];
	if($userPaswsord == $oldPass)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
?>