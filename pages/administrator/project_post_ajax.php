<?php
include "includes/db.php";

if(isset($_POST['projID']))
{
	$proj_id = $_POST['projID'];
?>
<option value="">Choose</option>
  <?php
    $fetch1 = "SELECT id, challan_title FROM projects_challans WHERE project_id = '$proj_id'";
    $run1 = mysqli_query($connection,$fetch1);
    while($row1 = mysqli_fetch_array($run1))
    {
      $id  = $row1['id'];
      $challan_title  = $row1['challan_title'];
  ?>
  <option value="<?php echo $id ?>"><?php echo $challan_title ?></option>
<?php }
}
?>