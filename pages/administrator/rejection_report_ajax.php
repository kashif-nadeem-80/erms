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
  $candidateType = $_POST['candidateType'];
  $where = "pp.project_id='$projId2'";
  if($postId != 'all') {
      $where .= " AND cp.post_id='$postId'";
  }
  if($candidateType == 'reject-by-challan-tab') {
    $where .= " AND cp.status = 'Rejected' AND (cp.status_details = 'Challan is missing' OR cp.challan_file IS NULL)";
  } else if($candidateType == 'reject-by-age-tab') {
    $where .= " AND cp.status = 'Rejected' AND cp.status_details = 'Under Age' OR cp.status_details = 'Over Age' OR cp.status_details = 'D.O.B is missing'";
  } else if($candidateType == 'reject-by-edu-tab') {
    $where .= " AND cp.status = 'Rejected' AND cp.status_details = 'Required education is missing'";
  } else if($candidateType == 'eligible-tab') {
    $where .= " AND cp.status = 'Accepted'";
  }
  $fetchData = "SELECT c.name, c.email, c.cnic, c.phone, cp.status, c.gender, pp.post_name
    FROM candidate_applied_post AS cp 
        INNER JOIN candidates AS c ON cp.candidate_id=c.id
    INNER JOIN projects_posts AS pp ON pp.id = cp.post_id 
WHERE $where";
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
            $status = $rowQ['status'];
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

