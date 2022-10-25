<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $edu_level = $_POST['edu_level'];

  // total candidate with minimum edu
  $fetchData1 = "SELECT c.id FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN education AS e ON e.candi_id = c.id INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) < '$edu_level'";
  $runQ1 = mysqli_query($connection,$fetchData1);
  

  // total candidate eligible
  $fetchData2 = "SELECT c.id FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN education AS e ON e.candi_id = c.id INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) >= '$edu_level'";
  $runQ2 = mysqli_query($connection,$fetchData2);
  

  // total candidate with no edu
  $fetchData3 = "SELECT COUNT(c.id) As no_edu FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id LEFT JOIN education AS e ON e.candi_id = c.id WHERE cp.post_id = '$postId' AND e.id IS NULL";
  $runQ3 = mysqli_query($connection,$fetchData3);
  $rowQ3 = mysqli_fetch_array($runQ3);


  $rej1 = mysqli_num_rows($runQ1);
  $rej2 = $rowQ3['no_edu'];
  $eligibleC = mysqli_num_rows($runQ2);

  $totalRej = $rej1+$rej2;
  $total = $eligibleC+$totalRej;
  
  
  $data = array('total' => $total, 'totalRej' => $totalRej, 'eligibleC' => $eligibleC);
  echo json_encode($data);
}

?>