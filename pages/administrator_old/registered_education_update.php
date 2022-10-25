<?php
include "includes/header.php";
$educ_id = $_GET['educ_id'];

?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Educational's Details</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Educational Record</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid" class="text-center">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <p class="text-info font-weight-bold">Write down your educational record from lower level to higher level; e.g: Matric, Intermediate, Bachelor etc</p>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Educational Certificate / Degree</div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
              $query2 = "SELECT c.id AS cand_id, e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.percentage, e.division, e.deg_image,d.id AS deg_id, d.deg_name,ed.id AS level_id, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id LEFT JOIN candidates AS c ON c.id= e.candi_id WHERE e.id= '$educ_id'";
              $runData = mysqli_query($connection,$query2);
              $rowData= mysqli_fetch_array($runData);
              $id = $rowData['id'];
              $level_id = $rowData['level_id'];
              $level1  = $rowData['level_name'];
              $deg_id = $rowData['deg_id'];
              $degree1  = $rowData['deg_name'];
              $major_subject = $rowData['major_subject'];
              $pas_year = $rowData['passing_year'];
              $obt_marks  = $rowData['obtain_marks'];
              $tot_marks   = $rowData['total_marks'];
              $percentage   = $rowData['percentage'];
              $division   = $rowData['division'];
              $Board1   = $rowData['university'];
              $certificate = $rowData['deg_image'];
              $cand_id = $rowData['cand_id'];
            ?>

            <div class="row">
              <div class="col-md-12">
              <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Certificate/Degree Name</label>
                                <select class="form-control" name="level" id="levl" onchange="getdegree()" required>
                                    <?php if ($level1 == NULL or $level1 == '') {
                                        echo "<option value=''>Choose</option>";
                                    } else {
                                        echo "<option value='$level_id'>$level1</option>";
                                    }

                                    $query = "SELECT * FROM edu_level";
                                    $result = mysqli_query($connection, $query);
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
                                <select id="degree" class="form-control level" name="degree" required>
                                    <?php if ($degree1 == NULL or $degree1 == '') {
                                        echo "<option value=''>Choose</option>";
                                    } else {
                                        echo "<option value='$deg_id'>$degree1</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Major Subject</label>
                                <input class="form-control" placeholder="Major Subject" id="major" value="<?php echo $major_subject ?>" name="major">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Passing Year</label>
                                <select type="text" class="form-control select2" name="pass_year" id="pass" required>
                                    <?php if ($pas_year == NULL or $pas_year == '') {
                                        echo "<option value=''>Choose</option>";
                                    } else {
                                        echo "<option value='$pas_year'>$pas_year</option>";
                                    }
                                    ?>
                                    <?php
                                    $current_year = date('Y') + 1;
                                    for ($i = 0; $i < 45; $i++) {
                                        $current_year--;
                                    ?>
                                        <option value="<?php echo $current_year ?>"><?php echo $current_year ?>
                                        </option>
                                    <?php } ?>
                                    <span><input type="checkbox" id="check" value="yes" name="inProgress">&nbsp;In Progress</span>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total / CGPA</label>
                                <input type="number" name="total_marks" step=".01" id="total" placeholder="Total / CGPA" onkeyup="checkCapacity()" value="<?php echo $tot_marks ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Obtained / CGPA</label>
                                <input type="number" name="obtained_marks" step=".01" id="obtained" placeholder="Obtained / CGPA" class="form-control" value="<?php echo $obt_marks ?>" required onkeyup="checkCapacity()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Percentage (%)</label>
                                <input type="text" id="percent" name="edu_percent" placeholder="Percentage" class="form-control" value="<?php echo $percentage ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Division</label>
                                <select class="form-control" name="edu_division" id="division">
                                   <?php if($division == NULL OR $division == '')
                                    {
                                    echo "
                                    <option value=''>Choose</option>";
                                    }
                                    else{
                                    echo $division;
                                    }?>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>University / Board</label>
                                <input type="text" name="university" placeholder="University / Board" class="form-control" value="<?php echo $Board1 ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <label>Upload Certificate / Degree <span class="text-info"> &nbsp;(Optional)</span></label>
                                <input type="file" id="file1" name="logo1" placeholder="Upload Your Certificate / Degree" class="form-control" onchange="showImage1(event)" accept="image/*">
                                <span class="text-danger">Format : JPEG (or JPG), GIF, PNG</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; " width="60%" height="140px" src="../../images/candidates/education/<?php
                                  if($certificate == NULL OR $certificate == '')
                                  {
                                  echo "../../file_icon.png";
                                  }
                                  else
                                  {
                                  echo $certificate;
                                  }
                                  ?> " alt="">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-success shadow" value="Update" name="saveUser5">
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
if (isset($_POST['saveUser5'])) {
    $degree = $_POST['degree'];
    $major_subject = $_POST['major'];
    @$inProgress = $_POST['inProgress'];
    if ($inProgress == 'yes') {
        $pass_year = "Inprogress";
        $obtained_marks = "Inprogress";
        $total_marks = "Inprogress";
        $certImage = "Inprogress";
        $edu_percent = "Inprogress";
        $edu_division = "Inprogress";
        
    } else {
        $pass_year = $_POST['pass_year'];
        $obtained_marks = $_POST['obtained_marks'];
        $total_marks = $_POST['total_marks'];
        $edu_percent = $_POST['edu_percent'];
        $edu_division = $_POST['edu_division'];
        if ($_FILES['logo1']['name'] == '') {
            $certImage = $certificate;
        } else {
            $certImage = date("Y-m-d H-i-s") . $_FILES['logo1']['name'];
            $temp_certImage = $_FILES['logo1']['tmp_name'];
            $pathImg1U = "../../images/candidates/education/" . $certImage;
            move_uploaded_file($temp_certImage, $pathImg1U);
            $path    = "../../images/candidates/education/".$certificate;
            @unlink($path);
        }
    }

    $university = $_POST['university'];

    $query1 = "UPDATE `education` SET `degree_id`='$degree', `passing_year`='$pass_year', `obtain_marks`='$obtained_marks', `major_subject`='$major_subject', `total_marks`='$total_marks', `university`='$university', `deg_image`='$certImage', `percentage`='$edu_percent', `division`='$edu_division' WHERE id = '$educ_id'";
    // exit();
    $run1 = mysqli_query($connection, $query1);
    if ($run1) {
        echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Updated !',
                'Education has been updated successfully',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'registered_user_update.php?u_id=$cand_id';
                }
              });
              </script>
              </body>
            </html>";
    } else {
        echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Error !',
                'Education not updated, Some error occure',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'registered_user_update.php?u_id=$cand_id';
                }
              });
              </script>
              </body>
            </html>";
    }
}
?>
    
  </div>
</section>

  <?php
  include "includes/footer.php";
  ?>
  <script>
  function showImage1(event) {
    var uploadField = document.getElementById("file1");
    
    if (uploadField.files[0].size > 100000) {
    uploadField.value = "";
    // alert("File is too big! Upload File under 80kB");
    Swal.fire(
                'Error !',
                'File Size is too big! Upload File under 100kB !',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {

                }
              });
    } else {
      var logoId = document.getElementById('log1');
      logoId.src = URL.createObjectURL(event.target.files[0]);
    }
  }
  //////////////////////////
  function getdegree() {
  var level1 = $("#levl").val();
  $.ajax({
  url: "../candidates/education_add_ajax.php",
  type: "POST",
  data: {
  level1: level1
  },
  success: function(data) {
  $("#degree").html(data);
  }
  });
  }
  </script>
  <script type="text/javascript">
  $(function() {
  $("#check").click(function(event) {
  var x = $(this).is(':checked');
  if (x == true) {
  $("#pass").attr('disabled', 'disabled');
  $("#obtained").attr('disabled', 'disabled');
  $("#total").attr('disabled', 'disabled');
  $("#file1").attr('disabled', 'disabled');
  $("#percent").attr('disabled', 'disabled');
  $("#division").attr('disabled', 'disabled');
  } else {
  $("#obtained").attr('disabled', false);
  $("#total").attr('disabled', false);
  $("#pass").attr('disabled', false);
  $("#file1").attr('disabled', false);
  $("#percent").attr('disabled', false);
  $("#division").attr('disabled', false);
  }
  });
  })
  </script>
  <script type="text/javascript">
  $('.Data_Ajax1').click(function() {
  var std_image1 = $(this).attr('data-id');
  $.ajax({
  method: 'POST',
  url: 'candidate_ajax.php',
  data: {
  edu_image1: std_image1
  },
  datatype: "html",
  success: function(result) {
  $(".std1").html(result);
  }
  });
  });

  function checkCapacity(){
    var obtained = parseFloat($("#obtained").val());
    var total = parseFloat($("#total").val());
    if(obtained > total)
    {
      Swal.fire(
        'Error !',
        'Obtained marks must be equal or less than total marks !',
        'error'
      ).then((result) => {
        if (result.isConfirmed) {

          $("#percent").val(0);
        }
      });
      
    }
    else
    {
      calPercentage();
    }
  }
  function calPercentage()
  {
    let obtained = parseFloat($("#obtained").val());
    let total = parseFloat($("#total").val());
    let edu_percentage = ((obtained*100)/total).toFixed(2);
    $("#percent").val(edu_percentage);
  }
  </script>
  <!-- Modal Start-->
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 550px">
      <div class="modal-content std1">
      </div>
    </div>
  </div>
  <!-- Modal end -->