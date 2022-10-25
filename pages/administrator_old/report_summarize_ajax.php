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


if(isset($_POST['proj_id']) && isset($_POST['postId']) && isset($_POST['city_id']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];

?>
<table class="table table-hover table-bordered datatable bg-white" style="font-size: 11px" data-page-length="100" id="export_table">
  <thead class="bg-dark">
    <tr>
      <th width="6%">S.No</th>
      <th>Project</th>
      <th>Post</th>
      <th>City</th>
      <th class="text-center">Apply Male</th>
      <th class="text-center">Apply Female</th>
      <th class="text-center">Apply Other</th>
      <th class="text-center">Total Apply</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT p.project_name, pp.post_name, ct.c_name,
      COUNT(CASE WHEN c.gender = 'Male' THEN 1 ELSE NULL END) AS male,
      COUNT(CASE WHEN c.gender = 'Female' THEN 1 ELSE NULL END) AS female,
      COUNT(CASE WHEN c.gender = 'Other' THEN 1 ELSE NULL END) AS other
      FROM candidate_applied_post AS cp INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
      INNER JOIN projects AS p ON p.id = pp.project_id
      LEFT JOIN city AS ct ON ct.id = cp.city_id
      LEFT JOIN candidates AS c ON c.id = cp.candidate_id
      WHERE p.id = '$proj_id' AND (pp.id = '$postId' OR '$postId' = 'all') AND (ct.id = '$city_id' OR '$city_id' = 'all') GROUP BY pp.id, ct.id ORDER BY ct.c_name, pp.post_name";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $project_name = $rowQ['project_name'];
        $post_name = $rowQ['post_name'];
        $c_name = $rowQ['c_name'];
        $male = $rowQ['male'];
        $female = $rowQ['female'];
        $other = $rowQ['other'];
        $total = $male + $female + $other;
    ?>
    <tr>
      <td><?php echo $count ?></td>
      <td><?php echo $project_name ?></td>
      <td><?php echo $post_name ?></td>
      <td><?php echo $c_name ?></td>
      <td class="male text-center"><?php echo $male ?></td>
      <td class="female text-center"><?php echo $female ?></td>
      <td class="other text-center"><?php echo $other ?></td>
      <td class="total text-center"><?php echo $total ?></td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot class="bg-secondary font-weight-bold text-center">
    <tr>
      <td colspan="4" align="right">Total</td>
      <td id="sumMale"></td>
      <td id="sumFemale"></td>
      <td id="sumOther"></td>
      <td id="sumTotal"></td>
    </tr>
  </tfoot>
</table>
<?php }



// Total Apply Info Ajax
if(isset($_POST['proj_id2']) && isset($_POST['postId2']) && isset($_POST['city_id2']))
{
  $proj_id = $_POST['proj_id2'];
  $postId = $_POST['postId2'];
  $city_id = $_POST['city_id2'];
?>
<table class="table table-striped table-bordered datatable" style="font-size: 12px" data-page-length='100'>
  <thead class="bg-dark">
    <tr>
      <th>S.No</th>
      <th>Project</th>
      <th>Post</th>
      <th>City</th>
      <th class="text-center bg-info">Total Apply</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $count = 0;
  $fetchData= "SELECT c.id,pp.project_name, p.post_name, p.post_bps, c.c_name, COUNT(ca.id) AS total_apply
  FROM projects_posts AS p
  LEFT JOIN candidate_applied_post AS ca ON ca.post_id = p.id
  INNER JOIN city AS c ON c.id = ca.city_id
  INNER JOIN projects AS pp ON pp.id = p.project_id
  WHERE pp.id = '$proj_id' AND (p.id = '$postId' OR '$postId' = 'all') AND (c.id = '$city_id' OR '$city_id' = 'all') AND ca.status = 'Accepted' GROUP BY ca.city_id,ca.post_id ORDER BY pp.id DESC, c.c_name ASC";
  $runData = mysqli_query($connection,$fetchData);
  while($rowData = mysqli_fetch_array($runData)) {
    $count++;
    $city_id       = $rowData['id'];
    $c_name       = $rowData['c_name'];
    $project_name       = $rowData['project_name'];
    $post_name       = $rowData['post_name'];
    $post_bps       = $rowData['post_bps'];
    $total_apply       = $rowData['total_apply'];
  ?>
    <tr>
      <td><?php echo $count ?></td>
      <td><?php echo $project_name ?></td>
      <td><?php echo $post_name." (BPS-".$post_bps.")"; ?></td>
      <td><?php echo $c_name ?></td>
      <td class="total text-center bg-info"><?php echo $total_apply ?></td>
    </tr>
  <?php }?>
  </tbody>
  <tfoot>
    <tr class="bg-secondary text-center">
      <td colspan="4" class="text-right"><b>Total</b></td>
      <td colspan="1" id="sumTotal">0</td>
    </tr>
  </tfoot>
</table>
<?php } ?>