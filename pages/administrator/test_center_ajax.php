<?php
include "includes/db.php";

//////////Update AppLication Modal/////////////
if(isset($_POST['test_room_id']))
{
  $test_room_id = $_POST['test_room_id'];
  $cent_id = $_POST['cent_id'];
  $totalCapic = $_POST['totalCapic'];

  $query = "SELECT * FROM test_center_details WHERE id = '$test_room_id'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $room_name = $row ['room_name'];
  $capacity = $row ['capacity'];
?>
<div class="modal-header bg-dark">
  <h4 class="modal-title">Room/Hall Update</h4>
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span></button>
</div>
<div class="modal-body">
  <form method="POST">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <input type="hidden" value="<?php echo $test_room_id ?>" name="room_id">
        <input type="hidden" value="<?php echo $capacity ?>" name="capOld">
        <input type="hidden" value="<?php echo $cent_id ?>" name="centerId">
        <input type="hidden" value="<?php echo $totalCapic ?>" name="OldtotalCap">
        <div class="form-group">
          <label>Room/Hall</label>
          <input type="text" name="room2" value="<?php echo $room_name ?>" placeholder="Room/Hall Name" class="form-control" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="form-group">
          <label>Room/Hall Capacity</label>
          <input type="text" name="capNew" value="<?php echo $capacity ?>" placeholder="Room/Hall Capacity" class="form-control" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input type="submit" name="updateRoom" value="Update" class="btn btn-success">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
</div>
<br>
<?php 
} ?>