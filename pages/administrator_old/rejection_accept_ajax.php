<?php include "includes/db.php";

      // Challan Emty AND challan iS fULL
if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $fetchData = "SELECT id FROM candidate_applied_post WHERE post_id = '$postId'";
  $runQ = mysqli_query($connection,$fetchData);
  $totalApplicants = mysqli_num_rows($runQ);
  $data = array('totalApplicants' => $totalApplicants);
  echo json_encode($data);
}

?>