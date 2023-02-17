<?php
include "includes/db.php";

if(isset($_POST['pro_domicile']))
{
  $pro_id = $_POST['pro_domicile'];
  $result = mysqli_query($connection, "SELECT * FROM district WHERE pro_id = '$pro_id'");
  echo "<option value=''>Choose</option>";
	while ($row = mysqli_fetch_array($result))
	{
		$id = $row["id"];
		$dis_name = $row['dis_name'];
		echo "<option value='$id'>$dis_name</option>";
	}
}

if(isset($_POST['fetc_dist']))
{
  $fetc_dist = $_POST['fetc_dist'];
  $result = mysqli_query($connection, "SELECT z.zone_name FROM zone AS z INNER JOIN district AS d ON d.zone_id = z.id WHERE d.id = '$fetc_dist'");
  $countRow = mysqli_num_rows($result);
  if($countRow != '0')
  {
  	$row = mysqli_fetch_array($result);
		echo $zone_name = $row['zone_name'];
  }
  else
  {
  	echo $zone_name = "Zone Not Add";
  }	
}


//////////Upload Challan///////////////
if(isset($_POST['apply_id']))
{
?>

<div class="modal-header ">
  <h5 class="modal-title">Upload UTS copy of paid challan</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $apply_id = $_POST['apply_id'];
?>
<form method="post" enctype="multipart/form-data">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Upload Challan   </label> 
          <input type="file" id="file1" name="challan_file" onchange="showImage1(event)" accept="image/*" class="form-control" required>
          <span class="text-danger">Format : JPEG (or JPG), GIF, PNG </span> <span class="text-danger text-pink">....... Size less than 200 KB </span>
          <input type="hidden" value="<?php echo $apply_id ?>" name="apply_id">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success shadow" value="Upload" name="upload">
      </div>
    </div>
  </div>
</form>
<?php }


//////////View Challan///////////////
if(isset($_POST['apply_id2']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Uploaded paid challan</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $apply_id2 = $_POST['apply_id2'];
  $fetchData = "SELECT * FROM candidate_applied_post WHERE id = '$apply_id2'";
  $runData = mysqli_query($connection,$fetchData);
  $rowData = mysqli_fetch_array($runData);
  $challan_path    = "../../images/candidates/challans/".$rowData['challan_file'];
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $challan_path ?>" width = "100%" height="260px">
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



//////////Edit Challan///////////////
if(isset($_POST['apply_id3']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Update paid challan</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $apply_id3 = $_POST['apply_id3'];
?>
<form method="post" enctype="multipart/form-data">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Upload New Challan</label>
          <input type="file" id="file1" name="challan_file" class="form-control" onchange="showImage1(event)" accept="image/*" required>
          <span class="text-danger">Format : JPEG (or JPG), GIF, PNG </span>

          <input type="hidden" value="<?php echo $apply_id3 ?>" name="apply_id">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info shadow" value="Update" name="update">
      </div>
    </div>
  </div>
</form>
<?php }

//////////Disablilty Certificate///////////////
if(isset($_POST['disability']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Disability Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $disability = $_POST['disability'];
  $path    = "../../images/candidates/disability certificate/".$disability;
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "100%" height="300px">
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
if(isset($_POST['widow_file']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Death's Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $widow_file = $_POST['widow_file'];
  $path    = "../../images/candidates/death certificate/".$widow_file;
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "100%" height="300px">
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


if(isset($_POST['projId']))
{
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}


if(isset($_POST['city']))
{
  $city = $_POST['city'];
  $fetch = "SELECT * FROM test_centers WHERE city_id = '$city'";
  $run = mysqli_query($connection,$fetch);
   echo "<option value=''>Choose</option>";
  while ($row = mysqli_fetch_array($run)) {
    $Id = $row['id'];
    $center_name = $row['center_name'];

    echo "<option value='$Id'>$center_name</option>";
  }
}

if(isset($_POST['city2']))
{
  $city2 = $_POST['city2'];
  $post = $_POST['post'];
  $fetch = "SELECT COUNT(id) AS total_apply FROM candidate_applied_post WHERE city_id = '$city2' AND post_id = '$post' AND application_status = 'Accept'";
  $run = mysqli_query($connection,$fetch);
  $row = mysqli_fetch_array($run);
  echo $total_apply = $row['total_apply'];
}

if(isset($_POST['center']))
{
  $center = $_POST['center'];
  $fetch = "SELECT capacity FROM test_centers WHERE id = '$center'";
  $run = mysqli_query($connection,$fetch);
  $row = mysqli_fetch_array($run);
  echo $capacity = $row['capacity'];
}




//////////Update payment status/////////////
if(isset($_POST['payment_status']))
{
  $status_id = $_POST['payment_status'];
  $autoInc = $_POST['autoInc'];

  $query = "SELECT * FROM candidate_applied_post WHERE id = '$status_id'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $id = $row ['id'];
  $status = $row ['status'];
  $status_details = $row ['status_details'];
?>
<div class="modal-header bg-dark">
  <h4 class="modal-title">Status Update</h4>
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span></button>
</div>
<div class="modal-body">
  <form method="POST" id="form_submit">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <input type="hidden" value="<?php echo $status_id ?>" name="statusID">
        <div class="form-group">
          <label for="">Status</label>
          <select name="status" class="form-control">
            <option value="<?php echo $status ?>"><?php echo $status ?></option>
            <option value="Pending">Pending</option>
            <option value="Paid">Paid</option>
            <option value="Reject">Reject</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="form-group">
          <label>Details</label>
          <textarea name="details" class="form-control"><?php echo $status_details ?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="button" onclick="insertData(<?php echo $status_id ?>)" class="btn btn-success" data-dismiss="modal">Update</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
</div>
<br>
<?php 
}

//////////Update AppLication status/////////////
if(isset($_POST['application_status']))
{
  $application_id = $_POST['application_status'];
  $autoInc1 = $_POST['autoInc1'];

  $query = "SELECT * FROM candidate_applied_post WHERE id = '$application_id'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_array($result);
  $application = $row ['application_status'];
  $application_details = $row ['application_status_details'];
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
        <input type="hidden" value="<?php echo $application_id ?>" name="application_id">
        <div class="form-group">
          <label for="">Application</label>
          <select name="application" class="form-control">
            <option value="<?php echo $application ?>"><?php echo $application ?></option>
            <option value="Pending">Pending</option>
            <option value="Accept">Accept</option>
            <option value="Reject">Reject</option>
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
        <button type="button" name="application_update" onclick="insertData1(<?php echo $application_id ?>)" class="btn btn-success" data-dismiss="modal">Update</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
</div>
<br>
<?php 
}

/////////////Status Update//////////////////////////////

  if(isset($_POST['status']))
  {
    $status_u = $_POST['status'];
    $details_u = $_POST['details'];
    $statusID = $_POST['statusID'];
    $query1 = "UPDATE `candidate_applied_post` SET `status`= '$status_u',`status_details` = '$details_u' WHERE id = '$statusID'";
    $result1 = mysqli_query($connection, $query1);
  }
/////////////////Application Update///////////////////////

if(isset($_POST['application']))
  {
    $application = $_POST['application'];
    $details1 = $_POST['details1'];
    $application_id = $_POST['application_id'];
    date_default_timezone_set("Asia/Karachi");
    $date = date("Y-m-d H:i:s");
    $query1 = "UPDATE `candidate_applied_post` SET `application_status` = '$application',`application_status_details` = '$details1',`update_date` = '$date' WHERE id = '$application_id'";
    $result1 = mysqli_query($connection, $query1);
  }


/////////// Education Degree Image ///////////////
if (isset($_POST['edu_image1'])) 
{

  $edu_image1 = $_POST['edu_image1'];
?>
<div class="modal-header bg-dark">
  <h5 class="modal-title">Education Degree/Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<div class="modal-body" style="padding: 0px !important;  text-align: center;">
  <div class="row">
    <div class="col-md-12"><br>
      <img src="<?php echo $edu_image1 ?>" width="98%" height="340px">
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
<div class="modal-body" style="padding: 0px !important;  text-align: center;">
  <div class="row">
    <div class="col-md-12"><br>
      <img src="<?php echo $std_image1 ?>" width="98%" height="340px">
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