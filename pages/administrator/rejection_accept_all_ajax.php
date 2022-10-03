<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $fetchData1 = "SELECT COUNT(id) AS total FROM candidate_applied_post WHERE post_id = '$postId'";
  $runQ1 = mysqli_query($connection,$fetchData1);
  $rowQ1 = mysqli_fetch_array($runQ1);

  $fetchData2 = "SELECT COUNT(id) AS eligible FROM candidate_applied_post WHERE post_id = '$postId' AND status = 'Inquiry' OR status = 'Accepted'";
  $runQ2 = mysqli_query($connection,$fetchData2);
  $rowQ2 = mysqli_fetch_array($runQ2);
  
  if($rowQ1['total'] == '')
  {
  	$totalApplicants = 0;
  }
  else
  {
  	$totalApplicants = $rowQ1['total'];
  }

  if($rowQ2['eligible'] == '')
  {
  	$eligibleApplicants = 0;
  }
  else
  {
  	$eligibleApplicants = $rowQ2['eligible'];
  }

  $data = array('totalApplicants' => $totalApplicants, 'eligibleApplicants' => $eligibleApplicants);
  echo json_encode($data);
}

?>