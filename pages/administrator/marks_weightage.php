<?php
include "includes/header.php";

$fetchData = "SELECT a.post_id, a.roll_no, ca.candidate_id, r.written_result, a.session_id, a.cand_applied_id FROM result AS r LEFT JOIN assigned_center AS a ON a.roll_no = r.roll_no LEFT JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id";
$runData = mysqli_query($connection,$fetchData);
while($row = mysqli_fetch_array($runData)){
  $roll_no = $row['roll_no'];
  $candidate_id = $row['candidate_id'];
  $written_result = $row['written_result'];
  $post_id = $row['post_id'];
  $session_id = $row['session_id'];
  $cand_applied_id = $row['cand_applied_id'];
  if($candidate_id) {
    $fetchData2 = "SELECT COUNT(CASE WHEN l.id = 3 THEN 1 ELSE NULL END) AS matric,COUNT(CASE WHEN l.id = 4 THEN 1 ELSE NULL END) AS inter,COUNT(CASE WHEN l.id = 5 THEN 1 ELSE NULL END) AS diploma FROM education AS e LEFT JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS l ON l.id = d.level_id WHERE e.candi_id = '$candidate_id'";
    $runData2 = mysqli_query($connection,$fetchData2);
    $row2 = mysqli_fetch_array($runData2);
    $matric = 0;
    $inter = 0;
    $diploma = 0;

    if($row2['matric'] > 0) {
      $matric = 3;
    } else {
      $matric = 0;
    }

    if($row2['inter'] > 0) {
      $inter = 5;
      $matric = 3;
    } else {
      $inter = 0;
    }

    if($row2['diploma'] > 0) {
      $diploma = 20;
      $inter = 0;
      $matric = 0;
    } else {
      $diploma = 0;
    }

    // 40% of test
    $test_40 = round(($written_result/100)*40,2);

    $insert = "INSERT INTO `weightages`(`candidate_id`, `post_id`, `roll_no`, `test`, `test_weightage`, `matric`, `inter`, `diploma`, `session_id`, `apply_id`) VALUES ('$candidate_id','$post_id','$roll_no','$written_result','$test_40','$matric','$inter','$diploma','$session_id','$cand_applied_id')";
    $run3 = mysqli_query($connection,$insert);
  }

}


include "includes/footer.php";
