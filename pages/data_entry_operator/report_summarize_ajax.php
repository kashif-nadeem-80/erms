<?php
include "includes/db.php";
session_start();
$dataEntryId = $_SESSION['DataEntryOperator'];


if(isset($_POST['proj_id']))
{
  $proj_id = $_POST['proj_id'];

?>

<table class="table table-hover table-bordered datatable bg-white" data-page-length="100">
  <thead class="bg-dark">
    <tr>
      <th width="6%" class="text-center">S.No</th>
      <th>Post</th>
      <th class="text-center">Total Applications Submitted</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $fetchData = "SELECT COUNT(c.id) AS total, pp.post_name, pp.post_bps FROM candidate_applied_post AS c INNER JOIN projects_posts AS pp ON pp.id = c.post_id INNER JOIN projects AS p ON p.id = pp.project_id WHERE c.operator_id = '$dataEntryId' AND p.id = '$proj_id' GROUP BY c.post_id ORDER BY pp.post_name ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $post_name = $rowQ['post_name'];
        $post_bps = $rowQ['post_bps'];
        $total = $rowQ['total'];
    ?>
    <tr>
      <td class="text-center"><?php echo $count ?></td>
      <td><?php echo $post_name." (".$post_bps.")"; ?></td>
      <td class="text-center font-weight-bold totalApp"><?php echo $total ?></td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr class="bg-secondary">
      <th colspan="2" class="text-right">Total</th>
      <th id="sumtotal" class="text-center"></th>
    </tr>
  </tfoot>
</table>
<?php } ?>