<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $fetchData = "SELECT COUNT(id) AS total FROM candidate_applied_post WHERE post_id = '$postId'";
  $runQ = mysqli_query($connection,$fetchData);
  $rowQ = mysqli_fetch_array($runQ);
  $totalApplicants = $rowQ['total'];

  $data = array('totalApplicants' => $totalApplicants);
  echo json_encode($data);
}

?>