<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $edu_level = $_POST['edu_level'];
  $candidateType = $_POST['candidateType'];
  if($candidateType == 'total-apply-tab') {
      $fetchData = "SELECT c.name, c.email, c.cnic, c.phone, cap.status, c.gender, pp.post_name 
    FROM candidate_applied_post AS cap
    LEFT JOIN candidates AS c ON cap.candidate_id=c.id
    LEFT JOIN projects_posts AS pp ON cap.post_id=pp.id
    WHERE cap.post_id='$postId'";
  } else if($candidateType == 'no-req-edu-tab') {
      $fetchData = "SELECT c.id, c.name, c.email, c.cnic, c.phone, c.gender, pp.post_name 
    FROM candidate_applied_post AS cp
    LEFT JOIN projects_posts AS pp ON cp.post_id=pp.id
    INNER JOIN candidates AS c ON c.id = cp.candidate_id
    INNER JOIN education AS e ON e.candi_id = c.id
    INNER JOIN degree AS d ON d.id = e.degree_id
    INNER JOIN edu_level AS el ON el.id = d.level_id
    WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) < '$edu_level'";
  } else if($candidateType == 'eligible-can-tab') {
  $fetchData = "SELECT c.id, c.name, c.email, c.cnic, c.phone, c.gender, pp.post_name  
    FROM candidate_applied_post AS cp
    LEFT JOIN candidates AS c ON c.id = cp.candidate_id
    LEFT JOIN education AS e ON e.candi_id = c.id
    LEFT JOIN projects_posts AS pp ON cp.post_id=pp.id
    LEFT JOIN degree AS d ON d.id = e.degree_id
    LEFT JOIN edu_level AS el ON el.id = d.level_id
    WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) >= '$edu_level'";
  }
  // total candidate with minimum edu
//  $fetchData1 = "SELECT c.id FROM candidate_applied_post AS cp
//    INNER JOIN candidates AS c ON c.id = cp.candidate_id
//    INNER JOIN education AS e ON e.candi_id = c.id
//    INNER JOIN degree AS d ON d.id = e.degree_id
//    INNER JOIN edu_level AS el ON el.id = d.level_id
//    WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) < '$edu_level'";
//  $runQ1 = mysqli_query($connection,$fetchData1);
//
//
//  // total candidate eligible
//  $fetchData2 = "SELECT c.id FROM candidate_applied_post AS cp
//    INNER JOIN candidates AS c ON c.id = cp.candidate_id
//    INNER JOIN education AS e ON e.candi_id = c.id
//    INNER JOIN degree AS d ON d.id = e.degree_id
//    INNER JOIN edu_level AS el ON el.id = d.level_id
//    WHERE cp.post_id = '$postId' GROUP BY cp.candidate_id HAVING MAX(el.id) >= '$edu_level'";
//  $runQ2 = mysqli_query($connection,$fetchData2);
//
//
//  // total candidate with no edu
//  $fetchData3 = "SELECT COUNT(c.id) As no_edu FROM candidate_applied_post AS cp
//    INNER JOIN candidates AS c ON c.id = cp.candidate_id
//    LEFT JOIN education AS e ON e.candi_id = c.id
//    WHERE cp.post_id = '$postId' AND e.id IS NULL";
//  $runQ3 = mysqli_query($connection,$fetchData3);
//  $rowQ3 = mysqli_fetch_array($runQ3);
//
//
//  $rej1 = mysqli_num_rows($runQ1);
//  $rej2 = $rowQ3['no_edu'];
//  $eligibleC = mysqli_num_rows($runQ2);
//
//  $totalRej = $rej1+$rej2;
//  $total = $eligibleC+$totalRej;
  
  
//  $data = array('total' => $total, 'totalRej' => $totalRej, 'eligibleC' => $eligibleC);
//  echo json_encode($data);
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
            $status = isset($rowQ['status']) ? : '';
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $post_name; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $cnic; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $email; ?></td>
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
