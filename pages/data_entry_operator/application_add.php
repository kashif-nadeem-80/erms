<?php
  include "includes/header.php";

  $fetchDataG= "SELECT p.project_name, p.id FROM project_to_operator AS o INNER JOIN projects_posts AS pp ON pp.id = o.post_id INNER JOIN projects AS p ON p.id = pp.project_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
  $runDataG = mysqli_query($connection,$fetchDataG);
  $rowDataG = mysqli_fetch_array($runDataG);
  $idG         = $rowDataG['id'];
  $projectG    = $rowDataG['project_name'];
  $fetchData2G = "SELECT COUNT(id) AS total FROM candidate_applied_post WHERE operator_id = '$dataEntryId'";
  $runData2G = mysqli_query($connection,$fetchData2G);
  $rowData2G = mysqli_fetch_array($runData2G);
  $totalG    = $rowData2G['total'];
?>
<style>
.error
{
  color: red;
  font-style: italic;
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-4">
        <h4 class="m-0 text-dark">Application</h4>
      </div>
      <div class="col-md-4 font-weight-bold text-danger">
        Total Appliction Submitted : <?php echo $totalG ?>
      </div>
      <div class="col-md-4">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Application Form</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid" class="text-center">
    <div class="row">
      <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="myform">
          <div class="tab-content" id="myTabContent">
            <!-- Personal Infromation Start -->
            <div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
              <div class="card">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Project Title</label>
                        <select class="form-control" readonly id="proj" name="projectId" required>
                          <option value="<?php echo $idG ?>"><?php echo $projectG ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Posts</label>
                        <select class="form-control" name="post" id="post_id" required>
                          <?php
                          $fetch = "SELECT p.id, p.post_name, p.post_bps FROM project_to_operator AS o INNER JOIN projects_posts AS p ON p.id = o.post_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
                          $run = mysqli_query($connection,$fetch);
                          while ($row = mysqli_fetch_array($run))
                          {
                            $postId = $row['id'];
                            $postname = $row['post_name'];
                            $postbps = $row['post_bps'];
                            echo "<option value='$postId'>$postname BPS($postbps)</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Candidate CNIC</label>
                        <input type="text" id="cnic_1" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control" onchange="check_cnic_data()" autocomplete="off" required>
                        <span class="text-info font-weight-bold" style="display: none" id="cnicExistMsg">The cnic # already exist</span>
                        <span class="text-success font-weight-bold" style="display: none" id="cnicNewMsg">New CNIC</span>
                        <input type="hidden" name="candID" id="candd_id">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Reg No</label>
                        <input type="number" name="reg_no" class="form-control"  placeholder="Reg No" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Desired Test City</label>
                        <select class="form-control" name="city" id="city_id" required>
                          <option value="">Choose</option>
                          <?php
                          $fetchData = "SELECT * FROM city ORDER BY c_name ASC";
                          $run = mysqli_query($connection,$fetchData);
                          while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $name = $row['c_name'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Work Experince (No. of Year’s)</label>
                        <input type="number" step="any" name="numberofyears" class="form-control" placeholder="Work Experince (No. of Year’s)">
                      </div>
                    </div>
                  </div>

                  <!-- New CNIC Start -->
                  <div id="new_cnic" style="display: none">
                    <!-- Experience Information Start-->
                    <hr class="shadow" style="border: 1px solid grey;">

                    <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-primary">
                        <h4>Experience's Information</h4>
                        <hr class="shadow" style="border: 1px solid #007bff; width: 260px; ">
                      </div>
                    </div>
                    <div class="row" id="exp_new_row">
                      <div class="col-md-12" id="exp_data_row1">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Organization/ Company</label>
                              <input type="text" class="form-control" name="exp_company[]" placeholder="Organization/ Company" >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Job Title(Job Relevent Experince)</label>
                              <input type="text" class="form-control" name="exp_job[]" placeholder="Job Experince" >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Date From</label>
                              <input type="date" id="dateFrom1" class="form-control" name="exp_datefrom[]">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Date To</label><span class="float-right" style="font-size:12px"><b>Currently Working</b> <input type="checkbox" value="yes" tabindex="-1" id="expStatus1" onchange="currentlyWrkExp(1)"></span>
                              <input type="date" class="form-control" onchange="dToChange(1)" id="working1">
                              <input type="hidden" name="exp_dateto[]" id="work_hide1">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Total Experience</label>
                              <input type="text" name="exp_total[]" id="tExperience1" class="form-control" placeholder="Total Experience" readonly>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Pay Package (Rs)</label>
                              <input type="number" placeholder="Pay Package" class="form-control" name="exp_payment[]">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <button type="button" class="btn btn-dark shadow" onclick="add_experience()"><i class="fa fa-plus"></i> Add More</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Experience Information End-->
                    
                    <!-- Education Information Start-->
                    <hr class="shadow" style="border: 1px solid grey;">
                    <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-primary">
                        <h4>Education Information</h4>
                        <hr class="shadow" style="border: 1px solid #007bff; width: 260px; ">
                      </div>
                    </div>
                    <div class="row" id="edu_new_row">
                      <div class="col-md-12" id="edu_data_row1">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Certificate/Degree Name</label>
                              <select class="form-control" name="edu_level[]" id="levl1" onchange="getdegree(1)" required>
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
                              <select id="degree1" class="form-control" name="edu_degree[]" required>
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
                              <select type="text" class="form-control select2" id="pass1" onchange="PassYChange(1)" required>
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
                                <span><input type="checkbox" onchange="currentlyEdu(1)" id="eduInprog1" value="yes">&nbsp;In Progress</span>
                              </select>
                              <input type="hidden" id="pass_hide1" name="edu_passyear[]">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Total / CGPA</label>
                              <input type="number" step="any" id="total1" onkeyup="TotalChange(1)" placeholder="Total / CGPA" class="form-control" required>
                              <input type="hidden" id="total_hide1" name="edu_totalmarks[]">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Obtained / CGPA</label>
                              <input type="number" step="any" id="obtained1" onkeyup="checkCapacity(1)" placeholder="Obtained / CGPA" class="form-control" required>
                              <input type="hidden" id="obtain_hide1" name="edu_obtainedmarks[]">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Percentage</label>
                              <input type="text" id="percent1" placeholder="Percentage" class="form-control" readonly>
                              <input type="hidden" id="percent_hide1" name="edu_percent[]">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Division</label>
                              <select class="form-control" onchange="passDivision(1)" id="division1">
                                <option value="">Choose</option>
                                <option value="First">First</option>
                                <option value="Second">Second</option>
                                <option value="Third">Third</option>
                              </select>
                              <input type="hidden" id="division_hide1" name="edu_division[]">
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
                            <button type="button" class="btn btn-dark shadow" onclick="add_education()"><i class="fa fa-plus"></i> Add More</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Education Information End-->

                    <!-- Personal Information Start-->
                    <hr class="shadow" style="border: 1px solid grey;">
                    <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-primary">
                        <h4>Personal Information</h4>
                        <hr class="shadow" style="border: 1px solid #007bff; width: 260px; ">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Name in Full</label>
                          <input type="text" name="name" class="form-control" required placeholder="Name in Full">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Father's Name</label>
                          <input type="text" name="fathername" placeholder="Father Name"
                          class="form-control" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Confirm Candidate CNIC</label><span class="text-danger font-weight-bold" id="cnic_error" style="display: none;"> (Not Match)</span>
                          <span class="text-success font-weight-bold" id="cnic_succ" style="display: none;"> (Matched)</span>
                          <input type="text" name="cnic" onchange="confirmCnic()" id="cnic_2" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control" autocomplete="off" required>
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Gender</label>
                          <select name="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" max="<?php echo date('Y-m-d')?>" onchange="getAge()" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Age</label>
                          <input type="text" placeholder="Age" id="agee" class="form-control" disabled>
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Marital Status</label>
                          <select class="form-control" name="marital_status">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Religion</label>
                          <select class="form-control" name="religion">
                            <option value="Muslim">Muslim</option>
                            <option value="Non-Muslim">Non-Muslim</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Father's Occupation</label>
                          <input type="text" name="f_occupation" class="form-control"
                          placeholder="Father's Occupation" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Father's Contact</label>
                          <input class="form-control" type="tel" name="f_contact"
                          data-inputmask="'mask': '9999-9999999'" maxlength="12"
                          placeholder="03XX-XXXXXXX">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Postal Address</label>
                          <textarea class="form-control" placeholder="Postal Address" name="postaladdress"></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>City</label>
                          <select name="city_cand" class="form-control select2" required>
                            <option value="">Choose</option>
                            <?php
                            $data = "SELECT * FROM city ORDER BY c_name ASC";
                            $run = mysqli_query($connection,$data);
                            while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $name = $row['c_name'];
                            echo "<option value='$id'>$name</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>District</label>
                          <select name="dist_id" class="form-control select2" id="fetc_dist" required>
                            <option value="">Choose</option>
                            <?php
                            $data = "SELECT * FROM district ORDER BY dis_name ASC";
                            $run = mysqli_query($connection,$data);
                            while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $district = $row['dis_name'];
                            echo "<option value='$id'>$district</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Personal Contact</label>
                          <input class="form-control" type="tel" name="contact" data-inputmask="'mask': '9999-9999999'" maxlength="12" placeholder="03XX-XXXXXXX" >
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Other Contact</label>
                          <input type="phone" class="form-control" name="phone" data-inputmask="'mask': '9999-9999999'" maxlength="12" placeholder="03XX-XXXXXXX">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" class="form-control"
                          placeholder="example@gmail.com" autocomplete="off" required>
                        </div>
                      </div>
                    </div>
                    <!-- Personal Information End -->
                  </div>
                  <!-- New CNIC END -->

                  <!-- Existing CNIC Start -->
                  <div id="exist_cnic">
                  </div>
                  <!-- Existing CNIC End -->

                  <div class="row">
                    <div class="col-md-12 text-right">
                      <input type="submit" id="savebtn" name="savedata" value="Save" class="btn btn-success shadow">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <?php
          if(isset($_POST['savedata']))
          {
            $candID = $_POST['candID'];
            $numberofyears = $_POST['numberofyears'];

            $dateTime       = date("Y-m-d H:i:s");
            $date = date("Y-m-d");
            $profImage = $_POST['reg_no'].".jpg";
            $u_name = $_POST['name'];
            $u_f_name = $_POST['fathername'];
            $u_cnic = $_POST['cnic'];
            $u_gender = $_POST['gender'];
            $u_dob = $_POST['dob'];
            $u_marital_status = $_POST['marital_status'];
            $u_religion = $_POST['religion'];
            $u_f_occupation = $_POST['f_occupation'];
            $u_f_contact = $_POST['f_contact'];
            $u_postal_address = $_POST['postaladdress'];
            $u_city = $_POST['city_cand'];
            $u_d_name = $_POST['dist_id'];
            $u_phone = $_POST['contact'];
            $u_telephone = $_POST['phone'];
            $u_email = $_POST['email'];
            $reg_no = $_POST['reg_no'];
            $postID = $_POST['post'];
            $cityId = $_POST['city'];

            if($candID == 0 OR $candID == '0')
            {
              $fetch = "SELECT id FROM candidate_applied_post WHERE post_id = '$postID' AND reg_no = '$reg_no'";
              $runQ = mysqli_query($connection,$fetch);
              $countR = mysqli_num_rows($runQ);
              if($countR != 0)
              {
                echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Error !',
                    'This Reg No.($reg_no) already submitted in the selected post',
                    'error'
                  ).then((result) => {
                    if (result.isConfirmed) {
                       window.location.href = 'application_add.php';
                    }
                  });
                  </script>
                  </body>
                </html>";
              }
              else
              {
                $insert = "INSERT INTO `candidates` (`district_id`, `name`, `cnic`, `email`, `phone`, `image`, `f_name`, `gender`, `dob`, `postal_address`, `telephone`, `religion`, `created_by`, `signUpDate`, marital_status, father_occup, f_contact, city) VALUES ('$u_d_name','$u_name','$u_cnic','$u_email','$u_phone','$profImage','$u_f_name','$u_gender','$u_dob','$u_postal_address','$u_telephone','$u_religion', '$dataEntryId', '$date', '$u_marital_status', '$u_f_occupation', '$u_f_contact', '$u_city')";
                $run = mysqli_query($connection,$insert);
                $cand_id = mysqli_insert_id($connection);

                $insert2 = "INSERT INTO `candidate_applied_post`(`candidate_id`, `post_id`, `city_id`, `apply_date`, `status`, `status_details`, `reg_no`, `operator_id`, `experienceInYears`) VALUES ('$cand_id','$postID','$cityId','$dateTime','Accepted','Submitted By Operator','$reg_no','$dataEntryId', '$numberofyears')";
                $run2 = mysqli_query($connection,$insert2);
                $countEdu = COUNT($_POST['edu_level']);
                for($i = 0; $i < $countEdu; $i++)
                {
                  $edu_degree = $_POST['edu_degree'][$i];
                  $edu_major = $_POST['edu_major'][$i];
                  $edu_passyear = $_POST['edu_passyear'][$i];
                  $edu_totalmarks = $_POST['edu_totalmarks'][$i];
                  $edu_obtainedmarks = $_POST['edu_obtainedmarks'][$i];
                  $edu_university = $_POST['edu_university'][$i];
                  $edu_percent = $_POST['edu_percent'][$i];
                  $edu_division = $_POST['edu_division'][$i];

                  $insert3 = "INSERT INTO `education`(`candi_id`, `degree_id`, `passing_year`, `obtain_marks`, `major_subject`, `total_marks`, `university`, `percentage`, `division`) VALUES ('$cand_id', '$edu_degree', '$edu_passyear', '$edu_obtainedmarks', ' $edu_major','$edu_totalmarks','$edu_university','$edu_percent', '$edu_division')";
                  $run3 = mysqli_query($connection,$insert3);
                }

                if($_POST['exp_company'][0] != '' AND $_POST['exp_job'][0] != '' AND $_POST['exp_datefrom'][0] != '')
                {
                  $countExp = COUNT($_POST['exp_company']);
                  for($i = 0; $i < $countExp; $i++)
                  {
                    $exp_company = $_POST['exp_company'][$i];
                    $exp_job = $_POST['exp_job'][$i];
                    $exp_payment = $_POST['exp_payment'][$i];
                    $exp_datefrom = $_POST['exp_datefrom'][$i];
                    $exp_dateto = $_POST['exp_dateto'][$i];
                    $exp_total = $_POST['exp_total'][$i];

                    $insert4 = "INSERT INTO `work_experince`(`company`, `job_title`, `date_from`, `date_to`, `candidate_id`, `payment`, `total_exp`) VALUES ('$exp_company', '$exp_job', '$exp_datefrom', '$exp_dateto','$cand_id','$exp_payment')";
                    $run4 = mysqli_query($connection,$insert4);
                  }
                }
                if($run2)
                {
                  echo "<!DOCTYPE html>
                  <html>
                    <body>
                      <script>
                      Swal.fire(
                      'Added !',
                      'Application has been added successfully',
                      'success'
                      ).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'application_add.php';
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
                      'Application not added, Some error occure',
                      'error'
                      ).then((result) => {
                      if (result.isConfirmed) {
                      window.location.href = 'application_add.php';
                      }
                      });
                      </script>
                    </body>
                  </html>";
                }
              }
            }

            else
            {
              $fetchData = "SELECT * FROM candidate_applied_post WHERE candidate_id = '$candID' AND post_id = '$postID'";
              $runData = mysqli_query($connection,$fetchData);
              $countRow = mysqli_num_rows($runData);
              if($countRow == '0' OR $countRow == 0)
              {
                $fetch = "SELECT id FROM candidate_applied_post WHERE post_id = '$postID' AND reg_no = '$reg_no'";
                $runQ = mysqli_query($connection,$fetch);
                $countR = mysqli_num_rows($runQ);
                if($countR != 0)
                {
                  echo "<!DOCTYPE html>
                  <html>
                    <body> 
                    <script>
                    Swal.fire(
                      'Error !',
                      'This Reg No.($reg_no) already submitted in the selected post',
                      'error'
                    ).then((result) => {
                      if (result.isConfirmed) {
                         window.location.href = 'application_add.php';
                      }
                    });
                    </script>
                    </body>
                  </html>";
                }
                else
                {
                  $insert = "INSERT INTO `candidate_applied_post`(`candidate_id`, `post_id`, `city_id`, `apply_date`, `status`, `status_details`, `reg_no`, `operator_id`, `experienceInYears`) VALUES ('$candID','$postID','$cityId','$dateTime','Accepted','Submitted By Operator','$reg_no','$dataEntryId', '$numberofyears')";
                  $run = mysqli_query($connection,$insert);
                  if($run)
                  {
                    echo "<!DOCTYPE html>
                    <html>
                      <body>
                        <script>
                        Swal.fire(
                        'Added !',
                        'Application has been added successfully',
                        'success'
                        ).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = 'application_add.php';
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
                        'Application not added, Some error occure',
                        'error'
                        ).then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = 'application_add.php';
                        }
                        });
                        </script>
                      </body>
                    </html>";
                  }
                }
              }
              else
              {
                echo "<!DOCTYPE html>
                <html>
                  <body>
                    <script>
                    Swal.fire(
                    'Exist !',
                    'Candidate already Applied for the same Post!',
                    'error'
                    ).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'application_add.php';
                    }
                    });
                    </script>
                  </body>
                </html>";
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  
  <?php include "includes/footer.php"; ?>
  <script>
  $("#myform").validate();

  function checkReq()
  {
    if ($('#myform').valid())
    {
      EduInfo();
    }
  }

  function currentlyEdu(id) {
    let x = $("#eduInprog"+id).is(':checked');
    if (x == true)
    {
      $("#pass_hide"+id).val('Inprogress');
      $("#total_hide"+id).val('Inprogress');
      $("#obtain_hide"+id).val('Inprogress');
      $("#percent_hide"+id).val('Inprogress');
      $("#division_hide"+id).val('Inprogress');
      $("#percent"+id).val('');
      $("#percent"+id).attr('disabled', 'disabled');
      $("#division"+id).val('');
      $("#division"+id).attr('disabled', 'disabled');
      $("#pass"+id).val('');
      $("#pass"+id).attr('disabled', 'disabled');
      $("#obtained"+id).val('');
      $("#obtained"+id).attr('disabled', 'disabled');
      $("#total"+id).val('');
      $("#total"+id).attr('disabled', 'disabled');
    }
    else
    {
      $("#pass_hide"+id).val('');
      $("#total_hide"+id).val('');
      $("#obtain_hide"+id).val('');
      $("#percent_hide"+id).val('');
      $("#division_hide"+id).val('');
      $("#percent"+id).attr('disabled', false);
      $("#division"+id).attr('disabled', false);
      $("#pass"+id).attr('disabled', false);
      $("#obtained"+id).attr('disabled', false);
      $("#total"+id).attr('disabled', false);
    }
  }

  function PassYChange(id)
  {
    let pass = $("#pass"+id).val();
    let pass_hidden = $("#pass_hide"+id).val(pass);
  }

  function TotalChange(id)
  {
    let total = $("#total"+id).val();
    let total_hidden = $("#total_hide"+id).val(total);
    calPercentage(id)
  }

  function ObtainChange(id)
  {
    let obtaind = $("#obtained"+id).val();
    let obtaind_hidden = $("#obtain_hide"+id).val(obtaind);
  }

  //Experience
  function passDivision(id)
  {
    let division = $("#division"+id).val();
    let division_hidden = $("#division_hide"+id).val(division);
  }
  function dToChange(id)
  {
    var dateTo = $("#working"+id).val();
    var mdate = $("#dateFrom"+id).val();
    var yearThen = parseInt(mdate.substring(0,4), 10);
    var monthThen = parseInt(mdate.substring(5,7), 10);
    var dayThen = parseInt(mdate.substring(8,10), 10);
    
    // Calculate Experience
    var from = new Date(mdate);

    if($('#expStatus'+id).is(":checked"))
    {
      $("#work_hide"+id).val("0000-00-00");
      var to = new Date();
    }
    else
    {
      $("#work_hide"+id).val(dateTo);
      var to = new Date(dateTo);
    }

    var birthday = new Date(yearThen, monthThen-1, dayThen);
    
    var differenceInMilisecond = to.valueOf() - birthday.valueOf();
    
    var year_age = Math.floor(differenceInMilisecond / 31536000000);
    var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

    var month_age = Math.floor(day_age/30);
    
    day_age = day_age % 30;
    if(year_age != 0 && month_age != 0)
    {
      var total_exp = year_age + " years & " + month_age + " months";
    }
    else if(year_age == 0 && month_age != 0)
    {
      var total_exp = month_age + " months";
    }
    else if(year_age != 0 && month_age == 0)
    {
      var total_exp = year_age + " years";
    }
    else
    {
      var total_exp = day_age + " days";
    }

    $("#tExperience"+id).val(total_exp);
  }
  </script>
  <script>
  function check_cnic_data() {
    let cnic_1 = $("#cnic_1").val();
    $.ajax({
      url:'application_ajax.php',
      method:'POST',
      data:{
        'cnic_1':cnic_1
      },
      dataType: 'json',
      success(data){
        if(data.record == 0)
        {
          $("#candd_id").val(0);
          $("#exist_cnic").css('display','none');
          $("#new_cnic").css('display','block');

          $("#cnicExistMsg").css('display','none');
          $("#cnicNewMsg").css('display','block');  
        }
        else
        {
          $("#candd_id").val(data.cand_id);
          $("#new_cnic").css('display','none');
          $("#cnicNewMsg").css('display','none');
          $("#cnicExistMsg").css('display','block');
          $("#exist_cnic").css('display','block');
          $.ajax({
            url:'application_exist_details.php',
            method:'POST',
            data:{
              'candId' : data.cand_id
            },
            dataType: 'html',
            success(result){
              $('#exist_cnic').html(result);
            }
          }).done(function(){
            getAgeExistingCand();
          });
        }
      }
    });
  }

  let autoIncNo = 1;
  function add_experience() {
    autoIncNo++;
    $.ajax({
      url:'add_experience_row.php',
      method:'POST',
      data:{'count':autoIncNo},
      success(data){
        $('#exp_new_row').append(data);
      }
    });
  }

  function remove_exp(id)
  {
    let div = '#exp_data_row'+id;
    $(div).remove();
  }

  let autoIncNoEdu = 1;
  function add_education() {
    autoIncNoEdu++;
    $.ajax({
      url:'add_edu_row.php',
      method:'POST',
      data:{'count':autoIncNoEdu},
      success(data){
        $('#edu_new_row').append(data);
        $('.select2').select2({
          theme: 'bootstrap4'
        });
      }
    });
  }
  function remove_edu(id)
  {
    let div = '#edu_data_row'+id;
    $(div).remove();
  }

  function checkCapacity(id) {
    let obtained = parseFloat($("#obtained"+id).val());
    let total = parseFloat($("#total"+id).val());
    if(obtained > total)
    {
      Swal.fire(
      'Error !',
      'Obtained marks must be equal or less than total marks !',
      'error'
      ).then((result) => {
        if (result.isConfirmed) {
          $("#obtained"+id).val("");
          $("#obtain_hide"+id).val("");
          $("#percent"+id).val("");
          $("#percent_hide"+id).val("");
        }
      });
    }
    else
    {
      ObtainChange(id);
      calPercentage(id);
    }
  }

  function calPercentage(id)
  {
    let obtained = parseFloat($("#obtained"+id).val());
    let total = parseFloat($("#total"+id).val());
    let edu_percentage = ((obtained*100)/total).toFixed(2);
    $("#percent"+id).val(edu_percentage+" %");
    $("#percent_hide"+id).val(edu_percentage);
  }

  function getPost()
  {
    let projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'application_ajax.php',
      data: {
        projId: projId
      },
      dataType: "html",
      success:function(result){
        $("#post_id").html(result);
      }
    });
  }

  function getdegree(id) {
    let level1 = $("#levl"+id).val();
    $.ajax({
      url: "add_edu_row.php",
      type: "POST",
      data: {
      level1: level1
      },
      success: function(data) {
        $("#degree"+id).html(data);
      }
    });
  }

  function currentlyWrkExp(id) {
    let x = $("#expStatus"+id).is(':checked');
    if (x == true)
    {
      $("#working"+id).val('');
      $("#working"+id).attr('disabled', 'disabled');
      dToChange(id);
    }
    else
    {
      $("#tExperience"+id).val('');
      $("#work_hide"+id).val('');
      $("#working"+id).attr('disabled', false);
    }
  }

  


  /////////CNICN MATCH///////
  $('#cnic, #cnicconfirm').on('keyup', function() {
    if ($('#cnic').val() || $('#cnic').val()) {
      if ($('#cnic').val() == $('#cnicconfirm').val()) {
        $('#message_p').html('<b>CNIC Match</b>').css('color', 'green');
      } else {
        $('#message_p').html('<b>CNIC not Match</b>').css('color', 'red');
      }
    } else {
      $('#message_p').html('');
    }
  });
  ///////////////NUMBER MATCH
  $('#number, #confirm_number').on('keyup', function() {
    if ($('#number').val() || $('#number').val()) {
      if ($('#number').val() == $('#confirm_number').val()) {
        $('#message_n').html('<b>Number Match</b>').css('color', 'green');
      } else {
        $('#message_n').html('<b>Number not Match</b>').css('color', 'red');
      }
    } else {
      $('#message_n').html('');
    }
  });
  ////////////////////////
  function getAge()
  {
    var mdate = $("#d_o_b").val();
    var yearThen = parseInt(mdate.substring(0,4), 10);
    var monthThen = parseInt(mdate.substring(5,7), 10);
    var dayThen = parseInt(mdate.substring(8,10), 10);
    
    var today = new Date();
    var birthday = new Date(yearThen, monthThen-1, dayThen);
    
    var differenceInMilisecond = today.valueOf() - birthday.valueOf();
    
    var year_age = Math.floor(differenceInMilisecond / 31536000000);
    var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

    var month_age = Math.floor(day_age/30);
    
    day_age = day_age % 30;

    $("#agee").val(year_age + " years & " + month_age + " months");

  }

  function getAgeExistingCand()
  {
    var mdate = $("#d_o_b2").val();
    var yearThen = parseInt(mdate.substring(0,4), 10);
    var monthThen = parseInt(mdate.substring(5,7), 10);
    var dayThen = parseInt(mdate.substring(8,10), 10);
    
    var today = new Date();
    var birthday = new Date(yearThen, monthThen-1, dayThen);
    
    var differenceInMilisecond = today.valueOf() - birthday.valueOf();
    
    var year_age = Math.floor(differenceInMilisecond / 31536000000);
    var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

    var month_age = Math.floor(day_age/30);
    
    day_age = day_age % 30;

    $("#agee2").val(year_age + " years & " + month_age + " months");
  }
  </script>
  <script type="text/javascript">
    function confirmCnic()
    {
      let cnic1 = $('#cnic_1').val();
      let cnic2 = $('#cnic_2').val();
      if(cnic1 != cnic2)
      {
        $('#cnic_succ').css("display","none");
        $('#cnic_error').css("display","inline");
        $('#savebtn').attr("disabled","disabled");
      }
      else
      {
        $('#cnic_error').css("display","none");
        $('#cnic_succ').css("display","inline");
        $('#savebtn').removeAttr("disabled");
      }
    }
  </script>