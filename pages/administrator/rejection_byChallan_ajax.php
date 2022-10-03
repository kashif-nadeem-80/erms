<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $fetchData = "SELECT COUNT(CASE WHEN `challan_file` IS NOT NULL THEN 1 ELSE NULL END) AS withChallan, COUNT(CASE WHEN `challan_file` IS NULL THEN 1 ELSE NULL END) AS withOutChallan, COUNT(id) AS totalApplicants FROM candidate_applied_post WHERE post_id = '$postId'";
  $runQ = mysqli_query($connection,$fetchData);
  $rowQ = mysqli_fetch_array($runQ);
  $withChallan 	= $rowQ['withChallan'];
  $withOutChallan = $rowQ['withOutChallan'];
  $totalApplicants = $rowQ['totalApplicants'];
  $data = array('totalApplicants' => $totalApplicants, 'withChallan' => $withChallan, 'withOutChallan' => $withOutChallan);
  echo json_encode($data);
}

?>