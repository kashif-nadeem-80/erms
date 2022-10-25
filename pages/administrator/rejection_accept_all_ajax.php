<?php include "includes/db.php";

if(isset($_POST['postId']))
{
  $postId = $_POST['postId'];
  $candidateType = $_POST['candidateType'];
  $where = "cp.post_id = '$postId'";
  if($candidateType == 'eligible-tab') {
      $where .= " AND cp.status='Inquiry' OR cp.status='Accepted'";
  }
  $fetchData = "SELECT c.name, c.email, c.cnic, c.phone, cp.status, c.gender, pp.post_name
    FROM candidate_applied_post AS cp 
    INNER JOIN candidates AS c ON c.id = cp.candidate_id 
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

