<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $uptoDate = $_POST['uptoDate'];

  $fetchData = "SELECT pp.age_upper, pp.age_lower, COUNT(cp.id) AS total,
  COUNT(CASE WHEN pp.age_upper < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) THEN 1 ELSE NULL END) AS overage,
  COUNT(CASE WHEN pp.age_lower > (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) THEN 1 ELSE NULL END) AS underage,
  COUNT(CASE WHEN c.dob IS NULL THEN 1 ELSE NULL END) AS dob_miss
  FROM candidate_applied_post AS cp 
  INNER JOIN candidates AS c ON c.id = cp.candidate_id 
  INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
  WHERE cp.post_id = '$postId'";
  $runQ = mysqli_query($connection,$fetchData);
  $rowQ = mysqli_fetch_array($runQ);

  $total = $rowQ['total'];
  $overage 	= $rowQ['overage'];
  $underage = $rowQ['underage'];
  $dob_miss = $rowQ['dob_miss'];
  $age_upper = $rowQ['age_upper'];
  $age_lower = $rowQ['age_lower'];

  $eligibleC = $total-($overage+$underage+$dob_miss);
  
  
  $data = array('total' => $total, 'overage' => $overage, 'underage' => $underage, 'eligibleC' => $eligibleC, 'dob_miss' => $dob_miss, 'age_lower' => $age_lower, 'age_upper' => $age_upper);
  echo json_encode($data);
}

?>