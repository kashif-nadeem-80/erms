<?php
include "includes/header.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0 text-dark">Add New Project</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Add New Project</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid" class="text-center">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <center id="succ" style="display: none">
                    <h4 class="text-success">Project Created Successfully</h4>
                </center>
                <center id="err" style="display: none">
                    <h4 class="text-danger">Project Not Created</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                    <div class="card-header">
                        <div class="card-title">Project Form</div>
                        <div class="card-tools">
                            <a href="project_list.php" class="btn btn-primary btn-sm shadow">Project's Details</a>
                        </div>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Organization</label>
                                        <textarea class="form-control" name="organization" placeholder="Organization"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Project Title</label>
                                        <textarea class="form-control" name="title" placeholder="Project Title"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Project Id</label>
                                        <input type="text" name="proj_id" placeholder="Project Id" class="form-control"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apply Start Date</label>
                                        <input type="date" placeholder="dd-mm-yyyy" onchange="getLastDate()" min="<?php echo date("Y-m-d"); ?>"
                                            id="strt" class="form-control" name="strt_date" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apply Last Date</label>
                                        <input type="date" id="lst" class="form-control" name="end_date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Project Status</label>
                                        <select class="form-control" name="status" required>
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
                                        <input type="file" accept="application/pdf" id="advertisement"
                                            class="form-control" name="addver" onchange="showImage1(event);">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Application Form (Word)</label>
                                        <input type="file" accept=".doc, .docx" class="form-control" name="app_form"
                                            onchange="showImage2(event);" id="app_form">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <input type="submit" class="btn btn-success shadow" value="Add" name="saveUser">
                                    </center>
                                </div>
                            </div>
                        </form>
                        <?php
            if(isset($_POST['saveUser']))
            {
              $title   = $_POST['title'];
              $proj_id      = $_POST['proj_id'];
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
              }
              else{
                $addver = '';
              }

              if($app_form = $_FILES['app_form']['name'] != '')
              {
                $app_form = date('Y-m-d H-i-s a')."_".$proj_id.$_FILES['app_form']['name'];
                $app_formtmp = $_FILES['app_form']['tmp_name'];
                $path1 = "../../images/admin/project/app_form/".$app_form;
                move_uploaded_file($app_formtmp,$path1);
              }
              else
              {
                $app_form = '';
              }
              


              $insert = "INSERT INTO `projects`(`project_name`, `project_id`, `organization`, `start_date`, `last_date`, `create_date`, `status`,`advertisement`,`app_form`) VALUES ('$title','$proj_id','$organization','$strt_date','$end_date','$date','$status','$addver','$app_form')";
              $run = mysqli_query($connection,$insert);
              if($run) 
                {
                  echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Project !',
                        'Project has been added successfully',
                        'success'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'project_add.php';
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
                        'Project not add, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'project_add.php';
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