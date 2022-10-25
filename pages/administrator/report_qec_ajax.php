<?php
include "includes/db.php";
if(isset($_POST['proj_id']))
{
  $proj_id = $_POST['proj_id'];

?>

<table class="table table-hover table-bordered datatable bg-white" data-page-length="100">
  <thead class="bg-dark">
    <tr>
      <th width="6%" class="text-center">S.No</th>
      <th>Operator Name</th>
      <th>Contact No</th>
      <th class="text-center">Total Applications QEC</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $fetchData = "SELECT COUNT(c.id) AS total, m.name, m.contact FROM candidate_applied_post AS c INNER JOIN projects_posts AS pp ON pp.id = c.post_id INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN management_users AS m ON m.id = c.qeco_id WHERE p.id = '$proj_id' GROUP BY c.qeco_id ORDER BY m.name ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $name = $rowQ['name'];
        $contact = $rowQ['contact'];
        $total = $rowQ['total'];
    ?>
    <tr>
      <td class="text-center"><?php echo $count ?></td>
      <td><?php echo $name ?></td>
      <td><?php echo $contact ?></td>
      <td class="text-center font-weight-bold totalApp"><?php echo $total ?></td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr class="bg-secondary">
      <th colspan="3" class="text-right">Total</th>
      <th id="sumtotal" class="text-center"></th>
    </tr>
  </tfoot>
</table>
<?php } ?>