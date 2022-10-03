<?php
include('includes/db.php');
	if(isset($_POST['user']))
    {
    $user = $_POST['user'];
	$query = "SELECT * FROM management_users WHERE username = '$user'";
	$run_query = mysqli_query($connection,$query);
	$row_rec = mysqli_num_rows($run_query);
	if($row_rec > 0)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}
if(isset($_POST['email']))
    {
    $email = $_POST['email'];
	$query1 = "SELECT * FROM management_users WHERE email = '$email'";
	$run_query1 = mysqli_query($connection,$query1);
	$row_rec1 = mysqli_num_rows($run_query1);
	if($row_rec1 > 0)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}
?>