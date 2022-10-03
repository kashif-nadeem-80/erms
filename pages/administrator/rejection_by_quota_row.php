<?php
include('includes/db.php');

if (isset($_POST['count1']))
{
  $count1 = $_POST['count1'];
?>
<div class="col-md-12" id="new_data1<?php echo $count1 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id1[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '8' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp1(<?php echo $count1 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }



if (isset($_POST['count2']))
{
  $count2 = $_POST['count2'];
?>
<div class="col-md-12" id="new_data2<?php echo $count2 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id2[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '4' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp2(<?php echo $count2 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }


if (isset($_POST['count3']))
{
  $count3 = $_POST['count3'];
?>
<div class="col-md-12" id="new_data3<?php echo $count3 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id3[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '9' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp3(<?php echo $count3 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }


if (isset($_POST['count4']))
{
  $count4 = $_POST['count4'];
?>
<div class="col-md-12" id="new_data4<?php echo $count4 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id4[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '5' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp4(<?php echo $count4 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }


if (isset($_POST['count5']))
{
  $count5 = $_POST['count5'];
?>
<div class="col-md-12" id="new_data5<?php echo $count5 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id5[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '6' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp5(<?php echo $count5 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }

if (isset($_POST['count6']))
{
  $count6 = $_POST['count6'];
?>
<div class="col-md-12" id="new_data6<?php echo $count6 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id6[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '1' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp6(<?php echo $count6 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }


if (isset($_POST['count7']))
{
  $count7 = $_POST['count7'];
?>
<div class="col-md-12" id="new_data7<?php echo $count7 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id7[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '2' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp7(<?php echo $count7 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }

if (isset($_POST['count8']))
{
  $count8 = $_POST['count8'];
?>
<div class="col-md-12" id="new_data8<?php echo $count8 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id8[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '7' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp8(<?php echo $count8 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }


if (isset($_POST['count9']))
{
  $count9 = $_POST['count9'];
?>
<div class="col-md-12" id="new_data9<?php echo $count9 ?>">
  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <label>Domicile's District</label>
        <select class="form-control" name="domicile_id9[]" required>
          <option value="">Choose</option>
          <?php
          $query2 = "SELECT * FROM `district` WHERE pro_id = '3' ORDER BY dis_name ASC";
          $runData = mysqli_query($connection, $query2);
          while ($rowData = mysqli_fetch_array($runData)) {
            $id = $rowData['id'];
            $dis_name  = $rowData['dis_name'];
            echo "<option value='$id'>$dis_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group mt-2">
        <br>
        <button type="button" tabindex="-1" class="btn btn-danger shadow title" title="Remove" onclick="remove_exp9(<?php echo $count9 ?>)"><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</div>
<?php } ?>