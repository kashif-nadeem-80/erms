<?php
session_start();
include('includes/db.php');

	$canddate_id = $_SESSION['candd_id'];
	$oldPass = $_POST['oldPass'];

	$query = "SELECT * FROM candidates WHERE id = '$canddate_id'";
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