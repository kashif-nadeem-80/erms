<?php
include "includes/header.php";
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
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Application</h4>
      </div>
      <div class="col-md-6">
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
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="personalInfo-tab" data-toggle="tab" href="#personalInfo" role="tab" aria-controls="personalInfo" aria-selected="true">Personal Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " id="eduInfo-tab" data-toggle="tab" href="#eduInfo" role="tab" aria-controls="eduInfo" aria-selected="false">Education Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="empInfo-tab" data-toggle="tab" href="#empInfo" role="tab" aria-controls="empInfo" aria-selected="false">Employment Record</a>
          </li>
        </ul>
        <hr>

        <form method="post" enctype="multipart/form-data" id="myform">
          <div class="tab-content" id="myTabContent">
            <!-- Personal Infromation Start -->
            <div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Reg No</label>
                        <input type="text" name="reg_no" class="form-control"  placeholder="Reg No" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Project Title</label>
                        <select class="form-control select2" id="proj" onchange="getPost()" name="projectId" required>
                          <option value="">Choose</option>
                          <?php
                          $fetchData = "SELECT * FROM projects WHERE status = '1' ORDER BY id DESC";
                          $run = mysqli_query($connection,$fetchData);
                          while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $name = $row['project_name'];
                          ?>
                          <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Posts</label>
                        <select class="form-control select2" name="post" id="post_id" required>
                          <option value="">First Select Project</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                        <label>Desired Test City</label>
                        <select class="form-control select2" name="city" id="city_id" required>
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
                  </div>

                  <hr>
                  
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Name in Full</label>
                        <input type="text" name="name" class="form-control"  placeholder="Name in Full" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="fathername" placeholder="Father Name" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Candidate CNIC #</label>
                        <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                          <option value="">Choose</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Have You any disability?</label>
                        <select name="disability" id="test0" class="form-control" onchange="showDiv()" required>
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Disability Certificate</label>
                        <input type="file" accept="image/*" onchange="showDisability()"
                        style="overflow: hidden;" disabled name="disbl_file" id="dis_file" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group text-center m-1">
                        <img id="viewDis" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="130px" src="../../images/file_icon.png">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" placeholder="dob" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Province Of Domicile</label>
                        <select class="form-control" id="pro_domicile" name="pro_domicile"
                          onchange="getdist()" required>
                          <option value="">Choose</option>
                          <?php
                          $query = "SELECT * FROM province";
                          $result = mysqli_query($connection,$query);
                          while ($row = mysqli_fetch_array($result)) {
                          $pro_id = $row['id'];
                          $pro_name = $row['pro_name'];
                          echo "<option value='$pro_id'>$pro_name</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>District</label>
                        <select name="dist_id" class="form-control select2" id="fetc_dist"
                          onchange="getzone()" required>
                          <option value="">Choose</option>
                          <?php
                          $data = "SELECT * FROM district WHERE pro_id = '$pro_idd'";
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
                        <label>Zone</label>
                        <input type="text" class="form-control" id="zone" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Postal Address</label>
                        <textarea class="form-control" name="postaladdress" placeholder="Postal Address" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Phone No:(Res.)</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone No">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Mobile(mandatory)</label>
                        <input class="form-control" type="text" name="contact" data-inputmask="'mask': '9999-9999999'" maxlength="12" placeholder="03XX-XXXXXXX" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Religion</label>
                        <select class="form-control" name="religion" required>
                          <option value="">Choose</option>
                          <option value="Muslim">Muslim</option>
                          <option value="Non-Muslim">Non-Muslim</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Are You a Govt serving employee?</label>
                        <select class="form-control" name="govt" id="emp1" onchange="checkEmpl()">
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id="exp1" style="display: none">
                      <div class="form-group">
                        <label>Total Experience</label>
                        <select type="text" class="form-control select2" name="experince1">
                          <option value=''>Choose</option>
                          <option value="Less Than 1 Year">Less Than 1 Year</option>
                          <?php
                          for($i = 1; $i < 26; $i++)
                          {
                          if($i == 1)
                          {
                          $exp = $i." Year";
                          }
                          else
                          {
                          $exp = $i." Years";
                          }
                          ?>
                          <option value="<?php echo $exp ?>"><?php echo $exp ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Are You retired from Pakistan Armed Forces?</label>
                        <select class="form-control" name="retired" id="emp2" onchange="checkEmpl2()">
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id="exp2" style="display: none">
                      <div class="form-group">
                        <label>Total Experince</label>
                        <select type="text" class="form-control select2" name="experince2">
                          <option value=''>Choose</option>
                          <option value="Less Than 1 Year">Less Than 1 Year</option>
                          <?php
                          for($i = 1; $i < 26; $i++)
                          {
                          if($i == 1)
                          {
                          $exp = $i." Year";
                          }
                          else
                          {
                          $exp = $i." Years";
                          }
                          ?>
                          <option value="<?php echo $exp ?>"><?php echo $exp ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Widow/Son/Daughter of deceased Govt Employee?</label>
                        <select name="widow" class="form-control" id="test3" onchange="showDiv1()">
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Attach File</label>
                        <input type="file" accept="image/*" onchange="showWidow()"
                        style="overflow: hidden;" name="widow_file" disabled id="widowFile" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group text-center m-1">
                        <img id="viewWidow" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%"
                        width="120px;" height="130px" src="../../images/file_icon.png">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button type="button" class="btn btn-info shadow" onclick="checkReq()">Next <i class="fa fa-angle-double-right"></i></button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- Personal Information End -->

            <!-- Education Information Start-->
            <div class="tab-pane fade" id="eduInfo" role="tabpanel" aria-labelledby="eduInfo-tab">
              <div class="card">
                <div class="card-body">

                  <div class="row" id="edu_new_row">
                    <div class="col-md-12" id="edu_data_row1">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Level</label>
                            <select class="form-control select2" name="edu_level[]" id="levl1" onchange="getdegree(1)" required>
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
                            <label>Certificate / Degree</label>
                            <select id="degree1" class="form-control select2" name="edu_degree[]" required>
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
                            <select type="text" class="form-control select2" name="edu_passyear[]" id="pass1" required>
                              <?php
                              $current_year = date('Y')+1;
                              for($i = 0; $i < 45; $i++)
                              {
                              $current_year--;
                              ?>
                              <option value="<?php echo $current_year ?>"><?php echo $current_year ?>
                              </option>
                              <?php } ?>
                              <span><input type="checkbox" onchange="currentlyEdu(1)" id="eduInprog1" value="yes" name="inProgress[]">&nbsp;In Progress</span>
                            </select>
                            <input type="text" name="edu_passyear[]">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Total / CGPA</label>
                            <input type="number" name="edu_totalmarks[]" step="any" id="total1" placeholder="Total / CGPA" class="form-control" required>
                            <input type="text" name="edu_totalmarks[]">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Obtained / CGPA</label>
                            <input type="number" name="edu_obtainedmarks[]" step="any" id="obtained1" placeholder="Obtained / CGPA" class="form-control"  onkeyup="checkCapacity(1)" required>
                            <input type="text" name="edu_obtainedmarks[]">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>University / Board</label>
                            <input type="text" name="edu_university[]" placeholder="University / Board" class="form-control" required>
                            <input type="text" name="edu_university[]">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Upload Certificate / Degree</label>
                            <input type="file" class="form-control" id="eduImg1" name="edu_file[]" onchange="showEduImg(1)" style="overflow-x: hidden;" accept="image/*">
                            <input type="text" name="edu_file[]">
                            <?php
                            ?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group text-center">
                            <img id="eduView1" class="shadow" style="border: 1px blue solid; border-radius: 10%;" width="50%" height="130px" src="../../images/file_icon.png" alt="">
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

                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button type="button" class="btn btn-warning shadow" onclick="persInfo()"><i class="fa fa-angle-double-left"></i> Back</button>
                      <input type="submit" name="savedata" value="Save & Exit" class="btn btn-success shadow">
                      <button type="button" class="btn btn-info shadow" onclick="EmpInfo()">Next <i class="fa fa-angle-double-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Education Information End-->

            <!-- Experience Information Start-->
            <div class="tab-pane fade" id="empInfo" role="tabpanel" aria-labelledby="empInfo-tab">
              <div class="card">
                <div class="card-body">

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
                            <input type="date" class="form-control" name="exp_datefrom[]" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Date To</label><span class="float-right" style="font-size:12px"><b>Currently Working</b> <input type="checkbox" name="currentlyWorking[]" value="yes" id="expStatus1" onchange="currentlyWrkExp(1)"></span>
                            <input type="date" class="form-control" name="exp_dateto[]" id="working1" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Uploaded File</label>
                            <input type="file" class="form-control" id="experImg1" name="exp_file[]" onchange="showExpImg(1)" style="overflow-x: hidden;" accept="image/*">
                            <?php
                            ?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group text-center">
                            <img id="expView1" class="shadow" style="border: 1px blue solid; border-radius: 10%;" width="50%" height="130px" src="../../images/file_icon.png" alt="">
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

                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button type="button" class="btn btn-warning shadow" onclick="EduInfo()"><i class="fa fa-angle-double-left"></i> Back</button>
                      <input type="submit" name="savedata" value="Save & Exit" class="btn btn-success shadow">
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- Experience Information End-->

          </div>
        </form>
        <?php
            if(isset($_POST['savedata']))
            {
              date_default_timezone_set("Asia/Karachi");
              $dateTime       = date("Y-m-d H:i:s");
              $date = date("Y-m-d");
              $reg_no = $_POST['reg_no'];
              $u_d_name = $_POST['dist_id'];
              $u_name = $_POST['name'];
              $u_cnic = $_POST['cnic'];
              $u_email = $_POST['email'];
              $u_phone = $_POST['contact'];
              $u_f_name = $_POST['fathername'];
              $u_gender = $_POST['gender'];
              $u_disability = $_POST['disability'];
              if($u_disability == 'No')
              {
                $disabl = '';
              }
              else
              {
                if($_FILES['disbl_file']['name'] == '')
                {
                  $disabl = '';
                }
                else
                {
                  $disabl = date('Y-m-d H-i-s').$_FILES['disbl_file']['name'];
                  $temp_disabl  = $_FILES['disbl_file']['tmp_name'];
                  $disblImg1U    = "../../images/candidates/disability certificate/".$disabl;
                  move_uploaded_file($temp_disabl,$disblImg1U);
                }
              }
              $u_dob = $_POST['dob'];
              $u_postal_address = $_POST['postaladdress'];
              $u_telephone = $_POST['phone'];
              $u_religion = $_POST['religion'];
              $u_gov_employee = $_POST['govt'];
              $u_simple_exper = $_POST['experince1'];
              $u_retired_pak = $_POST['retired'];
              $u_army_exper = $_POST['experince2'];
              $widow_gov_emp = $_POST['widow'];
              if($widow_gov_emp == 'No')
              {
                $widow = '';
              }
              else
              {
                if($_FILES['widow_file']['name'] == '')
                {
                  $widow = '';
                }
                else
                {
                  $widow = date('Y-m-d H-i-s').$_FILES['widow_file']['name'];
                  $temp_widow  = $_FILES['widow_file']['tmp_name'];
                  $widowImg1U    = "../../images/candidates/death certificate/".$widow;
                  move_uploaded_file($temp_widow,$widowImg1U);
                }
              }
              $profImage = $_POST['reg_no'].".jpg";
              
              $insert = "INSERT INTO `candidates` (`district_id`, `name`, `cnic`, `email`, `phone`, `image`, `f_name`, `gender`, `disability`, `disable_file`, `dob`, `postal_address`, `telephone`, `religion`, `gov_employee`, `simple_exper`, `retired_pak`, `army_exper`, `widow_gov_emp`, `widow_file`, `created_by`, `signUpDate`) VALUES ('$u_d_name','$u_name','$u_cnic','$u_email','$u_phone','$profImage','$u_f_name','$u_gender','$u_disability', '$disabl','$u_dob','$u_postal_address','$u_telephone','$u_religion','$u_gov_employee','$u_simple_exper','$u_retired_pak','$u_army_exper','$widow_gov_emp','$widow','$dataEntryId', '$date')";
              $run = mysqli_query($connection,$insert);

              $cand_id = mysqli_insert_id($connection);
              $postID = $_POST['post'];
              $cityId = $_POST['city'];

              $insert2 = "INSERT INTO `candidate_applied_post`(`candidate_id`, `post_id`, `city_id`, `apply_date`, `status`, `status_details`, `reg_no`) VALUES ('$cand_id','$postID','$cityId','$dateTime','Accepted','Submitted By Operator','$reg_no')";
              $run2 = mysqli_query($connection,$insert2);

              $countEdu = COUNT($_POST['edu_level']);

              for($i = 0; $i < $countEdu; $i++)
              {
                $edu_level = $_POST['edu_level'][$i];
                $edu_degree = $_POST['edu_degree'][$i];
                $edu_major = $_POST['edu_major'][$i];
                echo @$inProgress = $_POST['inProgress'][$i];

                if($inProgress == 'yes')
                {
                  $edu_passyear = "Inprogress";
                  $edu_totalmarks = "Inprogress";
                  $edu_obtainedmarks = "Inprogress";
                  $certImage = "Inprogress";
                }
                else
                {
                  $edu_passyear = $_POST['edu_passyear'][$i];
                  $edu_totalmarks = $_POST['edu_totalmarks'][$i];
                  $edu_obtainedmarks = $_POST['edu_obtainedmarks'][$i];
                  if($_FILES['edu_file']['name'][$i] == '')
                  {
                    $certImage = "";
                  }
                  else
                  {
                    $certImage = date("Y-m-d H-i-s").$_FILES['edu_file']['name'][$i];
                    $temp_certImage = $_FILES['edu_file']['tmp_name'][$i];
                    $pathImg1U = "../../images/candidates/education/".$certImage;
                    move_uploaded_file($temp_certImage,$pathImg1U);
                  }
                }
                
                $edu_university = $_POST['edu_university'][$i];

                $insert3 = "INSERT INTO `education`(`candi_id`, `degree_id`, `passing_year`, `obtain_marks`, `major_subject`, `total_marks`, `university`, `deg_image`) VALUES ('$cand_id', '$edu_degree', '$edu_passyear', '$edu_obtainedmarks', ' $edu_major','$edu_totalmarks','$edu_university','$certImage')";
                $run3 = mysqli_query($connection,$insert3); 
              }

              if($_POST['exp_company'][0] != '' AND $_POST['exp_job'][0] != '' AND $_POST['exp_datefrom'][0] != '')
              {
                $countExp = COUNT($_POST['exp_company']);

                for($i = 0; $i < $countExp; $i++)
                {
                  $exp_company = $_POST['exp_company'][$i];
                  $exp_job = $_POST['exp_job'][$i];
                  $exp_datefrom = $_POST['exp_datefrom'][$i];
                  @$currentlyWorking = $_POST['currentlyWorking'][$i];
                  if($currentlyWorking == 'yes')
                  {
                    $exp_dateto = $_POST['exp_dateto'][$i] = "0000-00-00";
                    $exp_cert = $_FILES['exp_file']['name'][$i] = "Continue";
                  }
                  else
                  {
                    $exp_dateto = $_POST['exp_dateto'][$i];
                    if($_FILES['exp_file']['name'][$i] == '')
                    {
                      $exp_cert = "";
                    }
                    else
                    {
                      $exp_cert = date("Y-m-d H-i-s").$_FILES['exp_file']['name'][$i];
                      $temp_exp_cert = $_FILES['exp_file']['tmp_name'][$i];
                      $pathImg1U = "../../images/candidates/employee_experince/".$exp_cert;
                      move_uploaded_file($temp_exp_cert,$pathImg1U);
                    }
                  }

                  $insert4 = "INSERT INTO `work_experince`(`company`, `job_title`, `date_from`, `date_to`, `file`, `candidate_id`) VALUES ('$exp_company', '$exp_job', '$exp_datefrom', '$exp_dateto', '$exp_cert','$cand_id')";
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
</script>
<script>
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
      }
    });
  }

  function remove_edu(id)
  {
    let div = '#edu_data_row'+id;
    $(div).remove();
  }

  function checkCapacity(id) {
    var obtained = parseFloat($("#obtained"+id).val());
    var total = parseFloat($("#total"+id).val());
    if(obtained > total)
    {
      Swal.fire(
        'Error !',
        'Obtained marks must be equal or less than total marks !',
        'error'
      ).then((result) => {
        if (result.isConfirmed) {
          $("#obtained"+id).val("");
        }
      });
      
    }
  }
  function persInfo()
  {
    $("#eduInfo-tab").removeClass("active");
    $("#empInfo-tab").removeClass("active");
    $("#personalInfo-tab").addClass("active");

    $("#eduInfo").removeClass("active show");
    $("#empInfo").removeClass("active show");
    $("#personalInfo").addClass("active show");
  }

  function EduInfo()
  {
    $("#personalInfo-tab").removeClass("active");
    $("#empInfo-tab").removeClass("active");
    $("#eduInfo-tab").addClass("active");

    $("#personalInfo").removeClass("active show");
    $("#empInfo").removeClass("active show");
    $("#eduInfo").addClass("active show");
  }

  function EmpInfo()
  {
    $("#personalInfo-tab").removeClass("active");
    $("#eduInfo-tab").removeClass("active");
    $("#empInfo-tab").addClass("active");

    $("#personalInfo").removeClass("active show");
    $("#eduInfo").removeClass("active show");
    $("#empInfo").addClass("active show");
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

  function getdist()
  {
    let pro_domicile = $("#pro_domicile").val();
    $.ajax({
      url: "application_ajax.php",
      type: "POST",
      data: {
        pro_domicile: pro_domicile
      },
      success: function(data) {
        $("#fetc_dist").html(data);
      }
    }).done(function() {
        getzone();
      });
  }
  function getzone() {
    let fetc_dist = $("#fetc_dist").val();
    if (fetc_dist != '') {
      $.ajax({
        url: "application_ajax.php",
        type: "POST",
        data: {
          fetc_dist: fetc_dist
        },
        success: function(data) {
          $("#zone").val(data);
        }
      });
    }
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

  function currentlyEdu(id) {
    let x = $("#eduInprog"+id).is(':checked');
    if (x == true)
    {
      $("#pass"+id).attr('disabled', 'disabled');
      $("#obtained"+id).attr('disabled', 'disabled');
      $("#total"+id).attr('disabled', 'disabled');
      $("#eduImg"+id).attr('disabled', 'disabled');
    }
    else
    {
      $("#pass"+id).attr('disabled', false);
      $("#obtained"+id).attr('disabled', false);
      $("#total"+id).attr('disabled', false);
      $("#eduImg"+id).attr('disabled', false);
    }
  }

  function currentlyWrkExp (id) {
    let x = $("#expStatus"+id).is(':checked');
    if (x == true)
    {
      $("#working"+id).attr('disabled', 'disabled');
      $("#experImg"+id).attr('disabled', 'disabled');
    }
    else
    {
      $("#working"+id).attr('disabled', false);
      $("#experImg"+id).attr('disabled', false);
    }
  }

  function checkEmpl() {
    let empl = $("#emp1").val();
    if (empl == 'Yes') {
      $("#exp1").show();
    }
    else
    {
      $("#exp1").hide();
    }
  }
  function checkEmpl2() {
    let empl = $("#emp2").val();
    if (empl == 'Yes') {
      $("#exp2").show();
    }
    else
    {
      $("#exp2").hide();
    }
  }

  function showDiv() {
    let check1 = $('#test0').val();
    if (check1 != 'No') {
      $('#dis_file').attr('disabled', false);
      $('#viewDis').css('display', 'block');
    }
    else
    {
      $('#dis_file').attr('disabled', true);
      $('#viewDis').css('display', 'none');
    }
  }

  function showDiv1() {
    let check1 = $('#test3').val();
    if (check1 != 'No') {
      $('#widowFile').attr('disabled', false);
      $('#viewWidow').css('display', 'block');
    }
    else
    {
      $('#widowFile').attr('disabled', true);
      $('#viewWidow').css('display', 'none');
    }
  }

  //Experience Image
  function showExpImg(id) {
    let uploadField = document.getElementById("experImg"+id);
    if (uploadField.files[0].size > 300000) {
      uploadField.value = "";
      // alert("File is too big! Upload logo under 300kB");
      Swal.fire(
        'Error !',
        'File Size is too big! Upload Image under 300kB !',
        'error'
        );
    }
    else
    {
      let imgId = document.getElementById('expView'+id);
      imgId.src = URL.createObjectURL(event.target.files[0]);
    }
  }

  //Disability Image
  function showDisability() {
    let uploadField = document.getElementById("dis_file");
    if (uploadField.files[0].size > 300000) {
      uploadField.value = "";
      // alert("File is too big! Upload logo under 300kB");
      Swal.fire(
        'Error !',
        'File Size is too big! Upload Image under 300kB !',
        'error'
        );
    }
    else
    {
      let imgId = document.getElementById('viewDis');
      imgId.src = URL.createObjectURL(event.target.files[0]);
    }
  }

  //Widow Certificate Image
  function showWidow() {
    let uploadField = document.getElementById("widowFile");
    if (uploadField.files[0].size > 300000) {
      uploadField.value = "";
      // alert("File is too big! Upload logo under 300kB");
      Swal.fire(
        'Error !',
        'File Size is too big! Upload Image under 300kB !',
        'error'
        );
    }
    else
    {
      let imgId = document.getElementById('viewWidow');
      imgId.src = URL.createObjectURL(event.target.files[0]);
    }
  }

  //Education Image
  function showEduImg(id) {
    let uploadField = document.getElementById("eduImg"+id);
    if (uploadField.files[0].size > 300000) {
      uploadField.value = "";
      // alert("File is too big! Upload logo under 300kB");
      Swal.fire(
        'Error !',
        'File Size is too big! Upload Image under 300kB !',
        'error'
        );
    }
    else
    {
      let imgId = document.getElementById('eduView'+id);
      imgId.src = URL.createObjectURL(event.target.files[0]);
    }
  }

</script>