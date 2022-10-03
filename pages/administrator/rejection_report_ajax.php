<?php include "includes/db.php";

if (isset($_POST['projId_post'])) {
  $projId1 = $_POST['projId_post'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId1'";
  $run = mysqli_query($connection, $fetch);
  echo "<option value='all'>All</option>";
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $projId2 = $_POST['projId'];

  $fetchData = "SELECT COUNT(c.id) AS total,
  COUNT(CASE WHEN (c.status = 'Rejected' AND c.status_details = 'Challan is missing') THEN 1 ELSE NULL END) AS challan,
  COUNT(CASE WHEN (c.status = 'Rejected' AND c.status_details = 'Under Age' OR c.status_details = 'Over Age' OR c.status_details = 'D.O.B is missing') THEN 1 ELSE NULL END) AS age,
  COUNT(CASE WHEN (c.status = 'Rejected' AND c.status_details = 'Required education is missing') THEN 1 ELSE NULL END) AS edu,
  COUNT(CASE WHEN c.status = 'Accepted' THEN 1 ELSE NULL END) AS eligibleC
  FROM candidate_applied_post AS c INNER JOIN projects_posts AS pp ON pp.id = c.post_id WHERE pp.project_id = '$projId2' AND (pp.id = '$postId' OR 'all' = '$postId')";
  $runQ = mysqli_query($connection,$fetchData);
  $rowQ = mysqli_fetch_array($runQ);

  $total = $rowQ['total'];
  $challan 	= $rowQ['challan'];
  $age = $rowQ['age'];
  $edu = $rowQ['edu'];
  $eligibleC = $rowQ['eligibleC'];
  
  $data = array('total' => $total, 'challan' => $challan, 'age' => $age, 'edu' => $edu, 'eligibleC' => $eligibleC);
  echo json_encode($data);
}

?>