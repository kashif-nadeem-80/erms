<?php
include "includes/db.php";


//////////Update AppLication Modal/////////////
if(isset($_POST['assign_postId']))
{
  $assign_postId = $_POST['assign_postId'];
  $opertorID = $_POST['opertorID'];

  $query = "SELECT status FROM project_to_operator WHERE id = '$assign_postId'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $status = $row['status'];
?>
<div class="modal-header bg-dark">
  <h4 class="modal-title">Status Update</h4>
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span></button>
</div>
<div class="modal-body">
  <form method="POST">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <input type="hidden" value="<?php echo $assign_postId ?>" name="projToOpId">
        <input type="hidden" value="<?php echo $opertorID ?>" name="operatrid">
        <div class="form-group">
          <label for="">Status</label>
          <select name="opp_status" class="form-control">
            <option <?php if($status=='1') echo 'selected'; ?> value="1">Active</option>
            <option <?php if($status=='0') echo 'selected'; ?> value="0">Inactive</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="submit" name="updateStatus" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
</div>
<br>
<?php 
}


if(isset($_POST['projId']))
{
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  echo "<option value=''>Choose</option>";
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}

?>