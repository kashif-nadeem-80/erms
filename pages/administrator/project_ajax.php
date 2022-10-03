<?php
include('includes/db.php');

if(isset($_POST['test_center']))
{
	$test_center = $_POST['test_center'];
	$fetch = "SELECT c.c_name,p.capacity FROM projects_test_centers AS p LEFT JOIN city AS c ON c.id = p.city_id WHERE p.id = '$test_center'";
  $run = mysqli_query($connection,$fetch);
  $row = mysqli_fetch_array($run);
  $c_name  	 = $row['c_name'];
  $capacity  = $row['capacity'];

  $data = array('city' => $c_name, 'capacity' => $capacity);

  echo json_encode($data);
}

?>