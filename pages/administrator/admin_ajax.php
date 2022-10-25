<?php
include "includes/db.php";

//////////Disablilty Certificate///////////////
if (isset($_POST['disability'])) {
?>

  <div class="modal-header bg-dark">
    <h5 class="modal-title">Disability Certificate</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
    </button>
  </div>
  <?php
  $disability = $_POST['disability'];
  $path    = "../../images/candidates/disability certificate/" . $disability;
  ?>

  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <img src="<?php echo $path ?>" width="100%" height="300px">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<?php }




//////////Widow Certificate///////////////
if (isset($_POST['widow_file'])) {
?>

  <div class="modal-header bg-dark">
    <h5 class="modal-title">Death's Certificate</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
    </button>
  </div>
  <?php
  $widow_file = $_POST['widow_file'];
  $path    = "../../images/candidates/death certificate/" . $widow_file;
  ?>

  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <img src="<?php echo $path ?>" width="100%" height="300px">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<?php }


if (isset($_POST['projId'])) {
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection, $fetch);
  echo "<option value=''>Choose</option>";
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}


if (isset($_POST['city'])) {
  $city = $_POST['city'];
  $fetch = "SELECT * FROM test_centers WHERE city_id = '$city'";
  $run = mysqli_query($connection, $fetch);
  echo "<option value=''>Choose</option>";
  while ($row = mysqli_fetch_array($run)) {
    $Id = $row['id'];
    $center_name = $row['center_name'];

    echo "<option value='$Id'>$center_name</option>";
  }
}

if (isset($_POST['city2'])) {
  $city2 = $_POST['city2'];
  $post = $_POST['post'];
  $fetch1 = "SELECT COUNT(id) AS total_apply FROM candidate_applied_post WHERE city_id = '$city2' AND post_id = '$post' AND status = 'Accepted'";
  $run1 = mysqli_query($connection, $fetch1);
  $row1 = mysqli_fetch_array($run1);
  $total_apply = $row1['total_apply'];

  $fetch2 = "SELECT assigned_candidate FROM assigned_center_to_cand_temp WHERE post_id = '$post' AND city_id = '$city2'";
  $run2 = mysqli_query($connection, $fetch2);
  $count2 = mysqli_num_rows($run2);
  if ($count2 != 0) {
    $row2 = mysqli_fetch_array($run2);
    $alocate = $row2['assigned_candidate'];
    $unalocate = $total_apply - $alocate;
  } else {
    $alocate = 0;
    $unalocate = $total_apply;
  }
  $data = array('total_apply' => $total_apply, 'alocate' => $alocate, 'unalocate' => $unalocate);

  echo json_encode($data);
}

if (isset($_POST['sesion'])) {
  $sesion_id = $_POST['sesion'];
  $fetch1 = "SELECT t.total_capacity FROM test_centers AS t INNER JOIN center_session AS c ON c.center_id = t.id WHERE c.id = '$sesion_id'";
  $run1 = mysqli_query($connection, $fetch1);
  $row1 = mysqli_fetch_array($run1);
  $capacity = $row1['total_capacity'];

  $fetch2 = "SELECT assigned_capacity FROM assigned_center_capacity_temp WHERE session_id = '$sesion_id'";
  $run2 = mysqli_query($connection, $fetch2);
  $count2 = mysqli_num_rows($run2);
  if ($count2 != 0) {
    $row2 = mysqli_fetch_array($run2);
    $alocate = $row2['assigned_capacity'];
    $unalocate = $capacity - $alocate;
  } else {
    $alocate = 0;
    $unalocate = $capacity;
  }

  $data = array('capacity' => $capacity, 'alocate' => $alocate, 'unalocate' => $unalocate);

  echo json_encode($data);
}

if (isset($_POST['center'])) {
  $center = $_POST['center'];
  $post_id = $_POST['post_id'];
  $fetch1 = "SELECT DISTINCT(ac.post_id) AS post_id, ac.session_id, cs.session_title,cs.reporting_date,cs.id FROM assigned_center AS ac INNER JOIN center_session AS cs ON cs.id = ac.session_id WHERE ac.post_id = '$post_id' AND cs.center_id = '$center'";
  $run1 = mysqli_query($connection, $fetch1);
  $countRow = mysqli_num_rows($run1);
  if ($countRow == 0) {
    $fetch2 = "SELECT id, session_title, reporting_date FROM center_session WHERE center_id = '$center'";
    $run1 = mysqli_query($connection, $fetch2);
  }
  echo "<option value=''>Choose</option>";
  while ($row1 = mysqli_fetch_array($run1)) {
    $id  = $row1['id'];
    $session_title = $row1['session_title'];
    $reporting_date = date('d-m-Y h:i a', strtotime($row1['reporting_date']));
    echo "<option value='$id'>$session_title ($reporting_date)</option>";
  }
}


//////////View Challan///////////////
if (isset($_POST['apply_id'])) {
?>

  <div class="modal-header bg-dark">
    <h5 class="modal-title">Uploaded paid challan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
    </button>
  </div>
  <?php
  $apply_id = $_POST['apply_id'];
  $fetchData = "SELECT * FROM candidate_applied_post WHERE id = '$apply_id'";
  $runData = mysqli_query($connection, $fetchData);
  $rowData = mysqli_fetch_array($runData);
  $challan_path    = "../../images/candidates/challans/" . $rowData['challan_file'];
  ?>

  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="<?php echo $challan_path ?>" target="_blank"><img src="<?php echo $challan_path ?>" width="98%" height="260px"></a>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<?php
}


//////////Update AppLication Modal/////////////
if (isset($_POST['applyId_for_status'])) {
  $applyId = $_POST['applyId_for_status'];
  $autoInc = $_POST['autoInc'];

  $query = "SELECT * FROM candidate_applied_post WHERE id = '$applyId'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $application = $row['status'];
  $application_details = $row['status_details'];
?>
  <div class="modal-header bg-dark">
    <h4 class="modal-title">Status Update</h4>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span></button>
  </div>
  <div class="modal-body">
    <form method="POST" id="form_submit1">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <input type="hidden" value="<?php echo $applyId ?>" name="application_id">
          <div class="form-group">
            <label for="">Application</label>
            <select name="application" class="form-control">
              <option value="Pending" <?php if($application == 'Pending'){ echo "selected";}?> >Pending</option>
              <option value="Accepted" <?php if($application == 'Accepted'){ echo "selected";}?>>Accepted</option>
              <option value="Inquiry" <?php if($application == 'Inquiry'){ echo "selected";}?>>Inquiry</option>
              <option value="Rejected" <?php if($application == 'Rejected'){ echo "selected";}?>>Rejected</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label for="">Details</label>
            <textarea name="details1" class="form-control"><?php echo $application_details ?></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button type="button" onclick="insertData1(<?php echo $autoInc ?>)" class="btn btn-success" data-dismiss="modal">Update</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
  <br>
<?php
}

//////////Update status/////////////
if (isset($_POST['application_id'])) {
  $application = $_POST['application'];
  $details1 = $_POST['details1'];
  $application_id = $_POST['application_id'];
  date_default_timezone_set("Asia/Karachi");
  $date = date("Y-m-d H:i:s");
  $query1 = "UPDATE `candidate_applied_post` SET `status` = '$application',`status_details` = '$details1',`update_date` = '$date' WHERE id = '$application_id'";
  $result1 = mysqli_query($connection, $query1);
  if ($result1) {
    echo 1;
  } else {
    echo 0;
  }
}
if (isset($_POST['updateStatus'])) {
    $application = $_POST['status'];
    $details1 = $_POST['reason'];
    $application_id = $_POST['appId'];
    date_default_timezone_set("Asia/Karachi");
    $date = date("Y-m-d H:i:s");
    $query1 = "UPDATE `candidate_applied_post` SET `status` = '$application',`status_details` = '$details1',`update_date` = '$date' WHERE id = '$application_id'";
    $result1 = mysqli_query($connection, $query1);
    if ($result1) {
        echo 1;
    } else {
        echo 0;
    }
}



/////////// Education Degree Image ///////////////
if (isset($_POST['edu_image1'])) {

  $edu_image1 = $_POST['edu_image1'];
?>
  <div class="modal-header bg-dark">
    <h5 class="modal-title">Education Certificate/Degree</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
    </button>
  </div>
  <div class="modal-body" style="padding: 0px !important;  text-align: center;">
    <div class="row">
      <div class="col-md-12"><br>
        <img src="<?php echo $edu_image1 ?>" width="98%" />
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <center>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </center>
      </div>
    </div>
    <br>
  </div>

<?php
}
//////////////// Experince Employement //////////////
if (isset($_POST['std_image1'])) {
  $std_image1 = $_POST['std_image1'];
?>
  <div class="modal-header bg-dark">
    <h5 class="modal-title">Experince Certificate</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
    </button>
  </div>
  <div class="modal-body" style="padding: 0px !important;  text-align: center;">
    <div class="row">
      <div class="col-md-12"><br>
        <img src="<?php echo $std_image1 ?>" width="98%">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <center>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </center>
      </div>
    </div>
    <br>
  </div>
<?php
}

/////////////////////Test Center Validation //////////////////

if (isset($_POST['check_center'])) {
  $centerName = $_POST['check_center'];
  $query = "SELECT * FROM test_centers WHERE center_name = '$centerName'";
  $result = mysqli_query($connection, $query);
  echo mysqli_num_rows($result);
}


/////////////////////Roll No Validation //////////////////

if (isset($_POST['pre_rollNo'])) {
  $pre_rollNo = $_POST['pre_rollNo'];
  $query = "SELECT * FROM rollno_prefix WHERE roll_pre = '$pre_rollNo'";
  $result = mysqli_query($connection, $query);
  echo mysqli_num_rows($result);
}

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
?>