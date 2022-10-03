<?php
include "includes/db.php";

if(isset($_POST['projId']))
{
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  echo "<option value='all'>All</option>";
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}


if(isset($_POST['proj_id']) && isset($_POST['postId']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];

?>
<table class="table table-hover table-bordered datatable bg-white" style="font-size: 11px" data-page-length="100" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Post</th>
      <th>Name</th>
      <th>Father Name</th>
      <th>CNIC</th>
      <th>Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $fetchData = "SELECT c.name, c.cnic, c.f_name, r.result, pp.post_name FROM result AS r INNER JOIN projects_posts AS pp ON pp.id = r.post_id INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN assigned_center AS a ON a.roll_no = r.roll_no INNER JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id INNER JOIN candidates AS c ON c.id = ca.candidate_id WHERE (r.post_id = '$postId' OR 'all' = '$postId') AND p.id = '$proj_id' ORDER BY r.result DESC, pp.post_name ASC";
      $runData = mysqli_query($connection,$fetchData);

      $countRow = mysqli_num_rows($runData);
      if($countRow > 0)
      {
        while($rowData = mysqli_fetch_array($runData))
        {
          $count++;
          $post_name = $rowData['post_name'];
          $name = $rowData['name'];
          $f_name = $rowData['f_name'];
          $cnic = $rowData['cnic'];
          $result = $rowData['result'];

    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $post_name; ?></td>
      <td><?php echo $name; ?></td>
      <td><?php echo $f_name; ?></td>
      <td><?php echo $cnic; ?></td>
      <td><?php echo $result; ?></td>
    </tr>
  <?php } } ?>
  </tbody>
</table>
<?php } ?>