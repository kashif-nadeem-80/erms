<?php
include "includes/header.php";
$proj_id = $_GET['proj_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Project Edit</h4>
        <a href="project_list.php" class="mt-4 btn btn-warning shadow">Back</a>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Edit Project</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-dark">
          <div class="card-header">
            <div class="card-title">Project Form</div>
            <div class="card-tools">
              <a href="project_list.php" class="btn btn-primary btn-sm shadow">Project's Details</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <?php
          $query = "SELECT * FROM projects WHERE id = '$proj_id'";
          $result = mysqli_query($connection,$query);
          $row = mysqli_fetch_array($result);
          $project_name = $row['project_name'];
          $project_id = $row['project_id'];
          $organization = $row['organization'];
          $start_date = $row['start_date'];
          $last_date = $row['last_date'];
          $create_date = $row['create_date'];
          $advertisement = $row['advertisement'];
          $adv= "../../images/admin/project/advertisement/".$advertisement;
          $app_form = $row['app_form'];
          $app = "../../images/admin/project/app_form/".$app_form;
          $update_date = $row['update_date'];
          $status = $row['status'];
          if($status == '1')
          {
          $status1 = "Active";
          }
          else
          {
          $status1 = "In-Active";
          }
          ?>
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Organization <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="organization" placeholder="Organization"
                    value="" required><?php echo $organization;?></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Project Title <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="title" placeholder="Project Title"
                    required><?php echo $project_name;?></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Project Id <span class="text-danger">*</span></label>
                    <input type="text" name="proj_id" placeholder="Project Id" class="form-control"
                    autocomplete="off" value="<?php echo $project_id; ?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Apply Start Date <span class="text-danger">*</span></label>
                    <input type="date" onchange="getLastDate()" 
                    id="strt" class="form-control" name="strt_date"
                    value="<?php echo $start_date; ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Apply Last Date <span class="text-danger">*</span></label>
                    <input type="date" id="lst" class="form-control"
                    min="<?php echo $start_date; ?>" value="<?php echo $last_date; ?>"
                    name="end_date">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Project Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="status" required>
                      <option value="<?php echo $status;?>"><?php echo $status1; ?></option>
                      <option value="1">Active</option>
                      <option value="0">In-Active</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload Advertisement (PDF)</label>
                    <span> <a href="<?php echo $adv ?> ">View</a></span>
                    <input type="file" accept="application/pdf" class="form-control"
                    onchange="showImage1(event);" id="advertisement" name="addver" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload Application Form (PDF)</label>
                    <span> <a href="<?php echo $app ?> ">View</a></span>
                    <input type="file" accept="application/pdf" class="form-control" id="app_form"
                    onchange="showImage2(event);" name="app_form">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" class="btn btn-success shadow" value="Update"
                  name="saveUser">
                  </center>
                </div>
              </div>
            </form>
            <?php
            if(isset($_POST['saveUser']))
            {
            $title   = $_POST['title'];
            $proj_id1      = $_POST['proj_id'];
            $status  = $_POST['status'];
            $organization     = $_POST['organization'];
            $strt_date  = $_POST['strt_date'];
            $end_date    = $_POST['end_date'];
            date_default_timezone_set("Asia/Karachi");
            $date       = date('Y-m-d');
            
            if($_FILES['addver']['name'] != '')
            {
            $addver = date('Y-m-d H-i-s a')."_".$proj_id.$_FILES['addver']['name'];
            $addvertmp = $_FILES['addver']['tmp_name'];
            $path = "../../images/admin/project/advertisement/".$addver;
            move_uploaded_file($addvertmp,$path);
            unlink($adv);
            }
            else{
            $addver = $advertisement;
            
            }
            if($app_formm = $_FILES['app_form']['name'] != '')
            {
            $app_formm = date('Y-m-d H-i-s a')."_".$proj_id.$_FILES['app_form']['name'];
            $app_formtmp = $_FILES['app_form']['tmp_name'];
            $path1 = "../../images/admin/project/app_form/".$app_formm;
            move_uploaded_file($app_formtmp,$path1);
            unlink($app);
            }
            else
            {
            $app_formm = $app_form;
            }
            $insert = "UPDATE `projects` SET `project_name`='$title',`project_id`='$proj_id1',`organization`='$organization',`start_date`='$strt_date',`last_date`='$end_date',`update_date`='$date',`status`='$status',`advertisement`='$addver',`app_form`='$app_formm' WHERE id = '$proj_id';";
            $run = mysqli_query($connection,$insert);
            if($run)
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Project !',
                'Project has been updated successfully',
                'success'
                ).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'project_list.php';
                }
                });
                </script>
              </body>
            </html>";
            }
            else
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Error !',
                'Project not update, Some error occure',
                'error'
                ).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'project_edit.php?proj_id=$proj_id';
                }
                });
                </script>
              </body>
            </html>";
            }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include "includes/footer.php"; ?>
<script type="text/javascript">
function getLastDate() {
var s = $("#strt").val();
var l = $("#lst").val();
if (l < s) {
$("#lst").val(s);
}
$("#lst").attr("min", s);
}
var showImage1 = function(event) {
var uploadField = document.getElementById("advertisement");
if (uploadField.files[0].size > 5024000) {
uploadField.value = "";
Swal.fire(
'Error !',
'File Size is too big! Upload logo under 5MB !',
'error'
).then((result) => {
if (result.isConfirmed) {
}
});
} else {
var logoId = document.getElementById('advertisement');
logoId.src = URL.createObjectURL(event.target.files[0]);
}
}
var showImage2 = function(event) {
var uploadField = document.getElementById("app_form");
if (uploadField.files[0].size > 5024000) {
uploadField.value = "";
Swal.fire(
'Error !',
'File Size is too big! Upload logo under 5MB !',
'error'
).then((result) => {
if (result.isConfirmed) {
}
});
} else {
var logoId = document.getElementById('app_form');
logoId.src = URL.createObjectURL(event.target.files[0]);
}
}
</script>