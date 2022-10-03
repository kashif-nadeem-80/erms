<?php
include "includes/db.php";

if(isset($_POST['level1']))
{
  $level = $_POST['level1'];
  $result = mysqli_query($connection, "SELECT * FROM degree WHERE level_id = '$level'");
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["deg_name"]; ?></option>
  <?php
  } 
}

if(isset($_POST['count']))
 {
	$count= $_POST['count'];
?>

<div class="col-md-12" id="edu_data_row<?php echo $count ?>">
  <hr>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Certificate/Degree Name</label>
        <select class="form-control select2" name="edu_level[]" id="levl<?php echo $count ?>" onchange="getdegree(<?php echo $count ?>)" required>
          <option value="">Select Option</option>
          <?php
          $query = "SELECT * FROM edu_level";
          $result = mysqli_query($connection,$query);
          while ($row = mysqli_fetch_array($result)) {
          $l_id = $row['id'];
          $level = $row['level_name'];
          echo "<option value='$l_id'>$level</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
       <label>Certificate/Degree Title</label>
        <select id="degree<?php echo $count ?>" class="form-control select2" name="edu_degree[]" required>
          <option value="">Select Option</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Major Subject</label>
        <input class="form-control" placeholder="Major Subject" name="edu_major[]">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Passing Year</label>
        <select type="text" class="form-control select2" id="pass<?php echo $count ?>" onchange="PassYChange(<?php echo $count ?>)" required>
          <option value="">Choose</option>
          <?php
          $current_year = date('Y')+1;
          for($i = 0; $i < 45; $i++)
          {
          $current_year--;
          ?>
          <option value="<?php echo $current_year ?>"><?php echo $current_year ?>
          </option>
          <?php } ?>
          <span><input type="checkbox" onchange="currentlyEdu(<?php echo $count ?>)" id="eduInprog<?php echo $count ?>" value="yes">&nbsp;In Progress</span>
        </select>
        <input type="hidden" id="pass_hide<?php echo $count ?>" name="edu_passyear[]">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Total / CGPA</label>
        <input type="number" step="any" id="total<?php echo $count ?>" onkeyup="TotalChange(<?php echo $count ?>)" placeholder="Total / CGPA" class="form-control" required>
        <input type="hidden" id="total_hide<?php echo $count ?>" name="edu_totalmarks[]">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Obtained / CGPA</label>
        <input type="number" step="any" id="obtained<?php echo $count ?>" onkeyup="checkCapacity(<?php echo $count ?>)" placeholder="Obtained / CGPA" class="form-control" required>
        <input type="hidden" id="obtain_hide<?php echo $count ?>" name="edu_obtainedmarks[]">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Percentage</label>
        <input type="text" id="percent<?php echo $count ?>" placeholder="Percentage" class="form-control" readonly>
        <input type="hidden" id="percent_hide<?php echo $count ?>" name="edu_percent[]">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Division</label>
        <select class="form-control" onchange="passDivision(<?php echo $count ?>)" id="division<?php echo $count ?>">
          <option value="">Choose</option>
          <option value="First">First</option>
          <option value="Second">Second</option>
          <option value="Third">Third</option>
        </select>
        <input type="hidden" id="division_hide<?php echo $count ?>" name="edu_division[]">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>University / Board</label>
        <input type="text" name="edu_university[]" placeholder="University / Board" class="form-control" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <button type="button" class="btn btn-danger shadow" onclick="remove_edu(<?php echo $count ?>)"><i class="fa fa-trash"></i> Remove</button>
    </div>
  </div>
</div>
<?php } ?>