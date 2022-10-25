<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $uptoDate = $_POST['uptoDate'];
  $candidateType = $_POST['candidateType'];
  $where = "cp.post_id='$postId'";
  if($candidateType == 'over-age-tab') {
    $where .= " AND pp.age_upper < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3))";
  } else if($candidateType == 'under-age-tab') {
    $where .= " AND pp.age_lower > (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3))";
  } else if($candidateType == 'dob-missing-tab') {
    $where .= " AND c.dob IS NULL";
  } else if($candidateType == 'eligible-age-tab') {
      $where .= " AND pp.age_upper > (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) 
      AND pp.age_lower < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AND c.dob IS NOT NULL";
  }
  $fetchData = "SELECT c.name, c.email, c.cnic, c.phone, cp.status, c.gender, pp.post_name, c.dob 
    FROM candidate_applied_post AS cp 
    INNER JOIN candidates AS c ON c.id = cp.candidate_id 
    INNER JOIN projects_posts AS pp ON pp.id = cp.post_id 
    WHERE $where";
//  echo $fetchData = "SELECT pp.age_upper, pp.age_lower, COUNT(cp.id) AS total,
//  COUNT(CASE WHEN  THEN 1 ELSE NULL END) AS overage,
//  COUNT(CASE WHEN  THEN 1 ELSE NULL END) AS underage,
//  COUNT(CASE WHEN c.dob IS NULL THEN 1 ELSE NULL END) AS dob_miss
//  FROM candidate_applied_post AS cp
//  INNER JOIN candidates AS c ON c.id = cp.candidate_id
//  INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
//  WHERE cp.post_id = '$postId'";
  $runQ = mysqli_query($connection,$fetchData);
?>
    <table class="table table-hover table-bordered datatable bg-white" style="font-size: 11px" data-page-length="100" id="export_inq_table">
        <thead class="bg-dark">
        <tr>
            <th>S.No</th>
            <th>Post</th>
            <th>Name</th>
            <th>CNIC</th>
            <th>Phone</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $count = 1;
        while($rowQ = mysqli_fetch_array($runQ)) {
            $post_name = $rowQ['post_name'];
            $name = $rowQ['name'];
            $cnic = $rowQ['cnic'];
            $phone = $rowQ['phone'];
            $email = $rowQ['email'];
            $gender = $rowQ['gender'];
            $status = $rowQ['status'];
            $dob = $rowQ['dob'];
            if($rowQ['dob'] != '') {
                $bday = new DateTime($rowQ['dob']);
                $today = new DateTime(date('Y-m-d'));
                $diff = $today->diff($bday);

            }
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $post_name; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $cnic; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $dob;?></td>
                <td><?php echo ($diff != null) ? $diff->y.' years, '.$diff->m.' months and '.$diff->d.' days' : '' ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
            <?php
            $count++;
        }
        ?>
        </tbody>
    </table>
<?php

}

?>