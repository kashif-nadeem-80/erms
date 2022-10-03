<?php
include "includes/header.php";
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
          <li class="breadcrumb-item active">...</li>
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
        <p class="text-red font-weight-bold">Write down your educational record from lower level to higher level; e.g: Matric, Intermediate, Bachelor etc</p>
        <div class="card card-dark" class="text-center">
          <!-- <div class="card-header">
            <div class="card-title">Educational Certificate / Degree</div>
          </div> -->
          <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
          <br>
          <!-- /.card-header -->
     
            <div class="row">
              <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Certificate/Degree Name</label>
                        <select class="form-control" name="level" id="levl" onchange="getdegree()" required>
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
                        <select id="degree" class="form-control level" name="degree" required>
                          <option value="">Select Option</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Major Subject</label>
                        <input class="form-control" placeholder="Major Subject" id="major" name="major">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Passing Year</label>
                        <select type="text" class="form-control select2" name="pass_year" id="pass" required>
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
                          <span><input type="checkbox" id="check" value="yes" name="inProgress">&nbsp;In Progress</span>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Total / CGPA</label>
                        <input type="number" name="total_marks" step=".01" id="total" placeholder="Total / CGPA" onkeyup="checkCapacity()" class="form-control"  required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Obtained / CGPA</label>
                        <input type="number" name="obtained_marks" step=".01" id="obtained" placeholder="Obtained / CGPA" value="0" class="form-control" required onkeyup="checkCapacity()">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Percentage (%)</label>
                        <input type="text" id="percent" name="edu_percent" placeholder="Percentage" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Division</label>
                        <select class="form-control" name="edu_division" id="division">
                          <option value="">Choose</option>
                          <option value="First">First</option>
                          <option value="Second">Second</option>
                          <option value="Third">Third</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>University / Board</label>
                        <input type="text" name="university" placeholder="University / Board" class="form-control" required>
                      </div>
                 
                    </div>
                     <div class="col-md-4">
                      <div class="form-group mt-2">
                        <!-- <label>Upload Certificate / Degree <span class="text-info">  &nbsp;(Optional)</span></label> -->
                        <!-- <input type="file" id="file1" name="logo1" placeholder="Upload Your Certificate / Degree" class="form-control"  onchange="showImage1(event)" accept="image/*">
                        <span class="text-danger">Format : JPEG (or JPG), GIF, PNG</span> -->
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group text-center">
                        <!-- <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; " width="60%" height="140px" src="../../images/file_icon.png"> -->
                      </div>
                    </div>
                  </div> 
                  
                  <div class="row" >
                    
                    <div class="col-md-12 text-right align-content-center">
                      <input type="submit" class="btn btn-success shadow" style="width:230px ;" value="Add" name="saveUser1">
                      <input type="submit" class="btn btn-primary shadow" style="width:230px ;" value="Add & Next" name="saveUser2">
                      <a href="employement_experince.php" style="width:230px ;" class="btn btn-warning shadow" >Next</a>
                    </div>
                  </div>
                </form>
              </div>
        
        
        
      
    
    <?php
    if(isset($_POST['saveUser1']) OR isset($_POST['saveUser2']))
    {
      $degree = $_POST['degree'];
      $major_subject = $_POST['major'];
      @$inProgress = $_POST['inProgress'];
      if($inProgress == 'yes')
      {
        $pass_year = "Inprogress";
        $obtained_marks = "Inprogress";
        $total_marks = "Inprogress";
        $certImage = "Inprogress";
        $edu_percent = "Inprogress";
        $edu_division = "Inprogress";
      }
      else
      {
        $pass_year = $_POST['pass_year'];
        $obtained_marks = $_POST['obtained_marks'];
        $total_marks = $_POST['total_marks'];
        $edu_percent = $_POST['edu_percent'];
        $edu_division = $_POST['edu_division'];
        if($_FILES['logo1']['name'] == '')
        {
          $certImage = "";
        }
        else
        {
          $certImage = date("Y-m-d H-i-s").$_FILES['logo1']['name'];
          $temp_certImage = $_FILES['logo1']['tmp_name'];
          $pathImg1U = "../../images/candidates/education/".$certImage;
          move_uploaded_file($temp_certImage,$pathImg1U);
        }

      }
      
      $university = $_POST['university'];
      
      $query1 = "INSERT INTO `education`(`candi_id`, `degree_id`, `passing_year`, `obtain_marks`, `major_subject`, `total_marks`, `university`, `deg_image`, `percentage`, `division`) VALUES ('$canddate_id', '$degree', '$pass_year', '$obtained_marks', ' $major_subject','$total_marks','$university','$certImage','$edu_percent','$edu_division')";
      $run1 = mysqli_query($connection,$query1);
      if($run1 AND isset($_POST['saveUser1'])) 
        {
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Added !',
                'Education has been added successfully',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'education_add.php';
                }
              });
              </script>
              </body>
            </html>";
        }
         elseif ($run1 AND isset($_POST['saveUser2'])){
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Added !',
                'Education has been added successfully',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'employement_experince.php';
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
                'Education not add, Some error occure',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'education_add.php';
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
<script type="text/javascript">
  function deleteData(id)
  {
    var edu_id = $("#edu_id"+id).val();
    var pathImg = $("#pathImg"+id).val();
    Swal.fire({
    title: 'Are you sure?',
    text: "To delete the selected record !",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href= "education_add.php?deletId="+edu_id+"&pathImg="+pathImg;
    }
});

  }
</script>
  <?php
  if(isset($_GET['deletId']))
  {
  $id = $_GET['deletId'];
  $path = $_GET['pathImg'];
  @unlink($path);
  $delete = "DELETE FROM education WHERE id = '$id'";
  $run = mysqli_query($connection,$delete);
  if($run)
  {
    echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Deleted !',
              'The selected record has been deleted',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                 window.location.href = 'education_add.php';
              }
            });
            </script>
            </body>
          </html>";
  }
  }
  ?>
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
  url: "education_add_ajax.php",
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
          $("#obtained").val(0);
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

  <div class="card-body">
            <?php
              $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.percentage, e.division, e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$canddate_id' ORDER BY e.id ASC";
              $runData = mysqli_query($connection,$query2);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
            ?>
            <div class="row">
              <div class="col-md-12 table-responsive">
                <table class="table table-striped table-bordered bg-white text-center" style="font-size: 12px">
                  <thead class="bg-gray">
                    <tr>
                      <th>S.No</th>
                      <th>Degree Name</th>
                      <th>Degree Title</th>
                      <th>Major Subject</th>
                      <th>Year Passing</th>
                      <th>Total Marks/CGPA</th>
                      <th>Obtained Marks</th>
                      <th>Percentage/Division</th>
                      <th>University/Board</th>
                      <th>Certificate</th>
                      <th>Action</th>
                    </tr>
                    <?php
                    $count = 0;
                    
                    while($rowData = mysqli_fetch_array($runData)) {
                      $count++;
                      $id = $rowData['id'];
                      $level1  = $rowData['level_name'];
                      $degree1  = $rowData['deg_name'];
                      $major_subject = $rowData['major_subject'];
                      $pas_year = $rowData['passing_year'];
                      $obt_marks  = $rowData['obtain_marks'];
                      $tot_marks   = $rowData['total_marks'];
                      $percentage   = $rowData['percentage'];
                      $division   = $rowData['division'];
                      $Board1   = $rowData['university'];
                      $certificate = $rowData['deg_image'];
                      $pathImg    = "../../images/candidates/education/".$certificate;
                    ?>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $level1; ?></td>
                      <td><?php echo $degree1; ?></td>
                       <td><?php echo $major_subject;?></td>
                      <td><?php echo $pas_year;?></td>
                      <td><?php echo $tot_marks; ?></td>
                      <td><?php echo $obt_marks; ?></td>
                      <td>
                        <?php if($percentage == 'Inprogress') { echo 'Inprogress'; }
                          else { echo $percentage."% <b>/</b> ".$division; } ?> 
                      </td>
                      <td><?php echo $Board1; ?></td>
                      <td>
                        <?php if($certificate == 'Inprogress') {
                          echo "Inprogress";
                        }
                        elseif($certificate == '')
                        {
                          echo "Not Uploaded";
                        }
                        else {
                          ?>
                          <a class="Data_Ajax1" data-id="<?php echo $pathImg ?>" href="#edit"
                          data-toggle='modal'>
                          View
                        </a>
                      <?php } ?>
                      </td>
                      <td>
                       <input type="hidden" id="edu_id<?php echo $count ?>" value="<?php echo $id ?>">
                       <input type="hidden" id="pathImg<?php echo $count ?>" value="<?php echo $pathImg ?>">
                        <a class="btn btn-sm btn-danger shadow text-white" title="Delete"
                        onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
                        </div>
                        </div>
            <hr>
            <?php } ?>