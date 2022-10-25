<?php
include "includes/header.php";
$canddate_id=$_GET['can_id'];
$candidateUpdated = false;
if(isset($_GET['can_id']) && isset($_POST['submit-cand'])) {
    extract($_POST);
    $candidate_query = "SELECT * FROM candidates WHERE id = '$canddate_id'";
    $candidate_result = mysqli_query($connection, $candidate_query);
    $has_candidate = mysqli_num_rows($candidate_result);
    if($has_candidate) {
        $imageError = false;
        $maxFileSize = 500;
        $cand_image = $_FILES["cand_image"]['name'];
        $ext = pathinfo($cand_image, PATHINFO_EXTENSION);
        $image_exist = $_POST['image_exist'];
        if($cand_image != '') {
            $sizeKB = round($_FILES['cand_image']['size']/1024);
            if($sizeKB > $maxFileSize) {
                $imageError = true;
                $errorMessage = 'File too large. Maximum allowed size is 500Kb';
            }
            if(!in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                $imageError = true;
                $errorMessage = 'Please upload a valid picture (png, jpg or jpeg).';
            }
            if (!$imageError) {
                $newFileName = $canddate_id . '-' . time() . '.' . $ext;
                $targetPath = '../../images/candidates/profile picture/' . $newFileName;
                move_uploaded_file($_FILES['cand_image']['tmp_name'], $targetPath);
            }
        } else {
            $newFileName = $image_exist;
        }

        if(!$imageError) {
            $update_query = "UPDATE candidates 
        SET name = '$name', cnic = '$cnic', email = '$email', phone = '$phone', f_name = '$f_name', gender = '$gender',
            disability = '$disability', dob = '$dob', postal_address = '$postal_address', telephone = '$telephone', 
            religion = '$religion', gov_employee = '$gov_employee', simple_exper = '$simple_exper', image='$newFileName',
            retired_pak = '$retired_pak', army_exper = '$army_exper', widow_gov_emp = '$widow_gov_emp', district_id = '$dist_id'
        WHERE id='$canddate_id'";
            $test_city_id = $_POST['test_city'];
            if($test_city_id) {
                $update_test_city_query = "UPDATE candidate_applied_post SET city_id='$test_city_id' WHERE candidate_id=$canddate_id";
                mysqli_query($connection, $update_test_city_query);
            }
            if (mysqli_query($connection, $update_query)) {
                echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Updated Successfuly !',
                    'Candidates updated successfully',
                    'success'
                  );
                  </script>
                  </body>
                </html>";
            }
        } else {
            echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Error !',
                    '$errorMessage',
                    'error'
                  );
                  </script>
                  </body>
                </html>";
        }

    }
}
if(isset($_POST['uploadChallan']) && isset($_GET['can_id'])) {
    $error = false;
    $message = '';
    $candidateID = $_GET['can_id'];
    $challanForm = $_FILES['challan_file']['name'];
    $postId = $_POST['challan_post_id'];
    $ext = strtolower(pathinfo($challanForm, PATHINFO_EXTENSION));
    $sizeKB = round($_FILES['challan_file']['size']/1024);
    if($sizeKB > 500) {
        $error = true;
        $message = 'File too large. Maximum allowed size is 500Kb';
    }
    if(!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $error = true;
        $message = 'Invalid challan image type. Only jpg, png or jpeg files allowed!';
    }

    if(!$error) {
        $newFileName = $candidateID . '-' . time() . '.' . $ext;
        $targetPath = '../../images/candidates/challans/' . $newFileName;
        move_uploaded_file($_FILES['challan_file']['tmp_name'], $targetPath);
        $today = date('Y-m-d');
        $challanSql = "UPDATE candidate_applied_post SET challan_file='$newFileName', challan_upload_date='$today', status='Pending', status_details='Inquiry'
                                WHERE candidate_id='$candidateID' AND post_id='$postId'";
        mysqli_query($connection, $challanSql) or die(mysqli_error());
        echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Uploaded Successfuly !',
                    'Challan uploaded successfully',
                    'success'
                  );
                  </script>
                  </body>
                </html>";
    } else {
        echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Error!',
                    '$message',
                    'error'
                  );
                  </script>
                  </body>
                </html>";
    }
}
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Candidate Information</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Personal Information</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Candidate Details</div>
          </div>
          <br>
            <?php
            $district_query = "SELECT * FROM district ORDER BY dis_name";
            $district_result = mysqli_query($connection, $district_query);
            $city_query = "SELECT * FROM city ORDER BY c_name";
            $city_result = mysqli_query($connection, $city_query);

            $query = "SELECT p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.name, c.cnic, 
              c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, 
              c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,
              c.widow_gov_emp, c.district_id, c.id,c.disable_file,c.widow_file, cap.city_id FROM `candidates` AS c 
              LEFT JOIN district AS d ON d.id = c.district_id
              LEFT JOIN zone AS z ON z.id = d.zone_id
              LEFT JOIN province AS p ON p.id = d.pro_id
              LEFT JOIN candidate_applied_post AS cap ON c.id = cap.candidate_id
              WHERE c.id = '$canddate_id'";
              $result = mysqli_query($connection,$query);
              $rowData = mysqli_fetch_array($result);
              $d_id = $rowData['d_id'];
              $d_name = $rowData['dis_name'];
              $test_city_id = $rowData['city_id'];
              $name = $rowData['name'];
              $cnic = $rowData['cnic'];
              $email = $rowData['email'];
              $phone = $rowData['phone'];
              $password = $rowData['password'];
              $zone_name = $rowData['zone_name'];
              $pro_namee = $rowData['pro_name'];
              $pro_idd = $rowData['pro_id'];
              $disable_file = $rowData['disable_file'];
              $widow_file = $rowData['widow_file'];
              $image = $rowData['image'];
              $signupdate = $rowData['signUpDate'];
              $f_name = $rowData['f_name'];
              $gender = $rowData['gender'];
              $disability = $rowData['disability'];
              if($rowData['dob'] != '')
              {
                $dob = date("Y-m-d",strtotime($rowData['dob']));
              }
              else
              {
                $dob = "";
              }
              $postal_address = $rowData['postal_address'];
              $telephone = $rowData['telephone'];
              $religion = $rowData['religion'];
              $gov_employee = $rowData['gov_employee'];
              $simple_exper = $rowData['simple_exper'];
              $retired_pak = $rowData['retired_pak'];
              $army_exper = $rowData['army_exper'];
              $widow_gov_emp = $rowData['widow_gov_emp'];
             ?>
          <div class="card-body">
              <form method="post" action="" enctype="multipart/form-data">
                  <div class="row mb-2">
                      <div class="col-md-12 text-right">
                          <a href="application_download_pdf.php?cand_id=<?php echo $canddate_id;?>" target="_blank" class="btn btn-success">
                              Download PDF
                          </a>
                      </div>
                  </div>
                <div class="row text-right">
                  <div class="col-md-5">
                  </div>
                  <div class="col-md-7">
                    <div class="form-group  mr-3 mt-0 float-right">
                      <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; " width="120px;" height="130px"  src="../../images/candidates/profile picture/<?php
                      if($image == NULL OR $image == '')
                      {
                        echo "../../file_icon.png";
                      }
                      else
                      {
                        echo $image;
                      }
                      ?> " alt="">

                    </div>
                  </div>
                </div>
                  <div class="row text-right">
                      <div class="col-md-6">
                      </div>
                      <div class="col-md-6 text-right">
                          <div class="form-group">
                              <label>Please select picture</label>
                              <input style="width: 230px;" type="file" class="right" name="cand_image">

                              <input type="hidden" name="image_exist" value="<?php echo $image;?>">
                          </div>

                      </div>
                  </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Name in Full</label>
                      <input type="text" class="form-control" name="name" value="<?php echo  $name;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Father's Name</label>
                      <input type="text" class="form-control" name="f_name" value="<?php echo  $f_name;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Candidate CNIC #</label>
                      <input type="text" class="form-control" name="cnic" value="<?php echo  $cnic;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gender</label>
                      <input type="text" class="form-control" name="gender" value="<?php echo  $gender;?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Have You any disability?</label>
                    <?php
                    if($disability == 'Yes')
                  { ?>
                      <a href="#edit" class="ajaxData1" data-toggle='modal' data-id="<?php echo $disable_file ?>">(View)
                      </a>
                  <?php } ?>
                      <input type="text" name="disability" class="form-control" value="<?php echo  $disability;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date of Birth (YYYY-MM-DD)</label>
                      <input type="text" name="dob" class="form-control" value="<?php echo  $dob;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control" value="<?php echo  $email;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Province Of Domicile</label>
                      <input type="text" name="pro_name" class="form-control" value="<?php echo  $pro_namee;?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>District</label>
<!--                      <input type="text" name="d_name" class="form-control" value="--><?php //echo  $d_name;?><!--">-->
                        <select class="form-control select2" name="dist_id">
                            <?php
                            while($distData = mysqli_fetch_array($district_result)) {
                            ?>
                            <option value="<?php echo $distData['id'] ?>" <?php if($distData['id']==$rowData['district_id']) { echo "selected='selected'"; } ?>><?php echo $distData['dis_name'] ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                  </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Test City</label>
                            <select class="form-control shadow w-100"  name="test_city">
                                <option value="">Please select Test city</option>
                                <?php
                                $citySql = "SELECT id, c_name FROM city WHERE c_name IN ('Rawalpindi', 'LAHORE' , 'QUETTA' , 'PESHAWAR' , 'KARACHI', 'Multan', 'Sukkur', 'Muzaffarabad', 'Gilgit') ORDER BY c_name";
                                $cityQ = mysqli_query($connection, $citySql);
                                while($cityRow = mysqli_fetch_assoc($cityQ)) {
                                    ?>
                                    <option value="<?php echo $cityRow['id'];?>" <?php if($test_city_id == $cityRow['id']) {?> selected <?php } ?>>
                                        <?php echo $cityRow['c_name'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Zone</label>
                      <input type="text" name="zone_name" class="form-control" value="<?php echo  $zone_name;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Postal Address</label>
                      <textarea class="form-control" name="postal_address"><?php echo  $postal_address;?></textarea>
                    </div>
                  </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Phone No:(Res.)</label>
                            <input type="text" class="form-control" name="telephone" value="<?php echo  $telephone;?>">
                        </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Mobile(mandatory)</label>
                      <input type="text" name="phone" class="form-control" value="<?php echo  $phone;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Religion</label>
                      <input type="text" name="religion" class="form-control" value="<?php echo  $religion;?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Are You a Govt serving employee?</label>
                      <input type="text" id="emp1" name="gov_employee" class="form-control" value="<?php echo  $gov_employee;?>">
                    </div>
                  </div>
                  <div class="col-md-6" id="exp1">
                    <div class="form-group">
                      <label for="">Total Experience</label>
                      <input type="text" id="emp1" name="simple_exper" class="form-control" value="<?php echo  $simple_exper;?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Are You retired from Pakistan Armed Forces?</label>
                      <input type="text" id="emp2" name="retired_pak" class="form-control" value="<?php echo  $retired_pak;?>">
                    </div>
                  </div>
                  <div class="col-md-6" id="exp2">
                    <div class="form-group">
                      <label for="">Total Experince</label>
                      <input type="text" id="emp2" name="army_exper" class="form-control" value="<?php echo  $army_exper;?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Widow/Son/Daughter of deceased Govt Employee?</label>
                    <?php
                     if($widow_gov_emp  == 'Yes'){
                    ?>
                      <a href="#edit" class="ajaxData2" data-toggle='modal' data-id="<?php echo $widow_file ?>">(View)
                        </a>
                    <?php }?>
                      <input type="text" name="widow_gov_emp" id="test3" class="form-control" value="<?php echo  $widow_gov_emp;?>">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 text-right">
                      <button class="btn btn-success" name="submit-cand" value="submit">Update</button>
                  </div>
              </div>
              </form>
              <hr class="shadow" style="border: 1px solid grey;">
              <div class="row p-0 m-0">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Education's Information</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; width: 290px; ">
                  </div>
              </div>

              <?php
              $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, 
              e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id 
                  LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$canddate_id' ORDER BY e.id ASC";
              $runData = mysqli_query($connection,$query2);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
                  ?>
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="table table-striped table-bordered bg-white text-center" style="font-size: 12px">
                              <thead class="bg-dark">
                              <tr>
                                  <th>S.No</th>
                                  <th>Level</th>
                                  <th>Certificate/Degree </th>
                                  <th>Year Passing</th>
                                  <th>Major Subject</th>
                                  <th>Obtained Marks</th>
                                  <th>Total Marks/CGPA</th>
                                  <th>University/Board</th>
                                  <th>Certificate</th>
                              </tr>
                              <?php
                              $count = 0;

                              while($rowData = mysqli_fetch_array($runData)) {
                              $count++;
                              $id = $rowData['id'];
                              $level1  = $rowData['level_name'];
                              $degree1  = $rowData['deg_name'];
                              $pas_year = $rowData['passing_year'];
                              $major_subject = $rowData['major_subject'];
                              $obt_marks  = $rowData['obtain_marks'];
                              $tot_marks   = $rowData['total_marks'];
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
                                  <td><?php echo $pas_year;?></td>
                                  <td><?php echo $major_subject;?></td>
                                  <td><?php echo $obt_marks; ?></td>
                                  <td><?php echo $tot_marks; ?></td>
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
                                          <a class="Data_Ajax5" data-id="<?php echo $pathImg ?>" href="#edit1"
                                             data-toggle='modal'>
                                              View
                                          </a>
                                      <?php } ?>
                                  </td>
                              </tr>
                              <?php } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>

              <?php } else { ?>
                  <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-danger">
                          <p><b>Education Details Not Uploaded</b></p>
                      </div>
                  </div>
              <?php } ?>

              <hr class="shadow" style="border: 1px solid grey;">
              <div class="row p-0 m-0">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Experience's Information</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; width: 300px; ">
                  </div>
              </div>
              <?php

              $fetchData= "SELECT * FROM work_experince WHERE candidate_id = '$canddate_id'";
              $runData = mysqli_query($connection,$fetchData);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
                  ?>

                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="table table-bordered bg-white text-center" style="font-size: 12px">
                              <thead class="bg-dark">
                              <tr>
                                  <th>S.No</th>
                                  <th>Organization/ Company</th>
                                  <th>Job Title(Job Relevent Experince)</th>
                                  <th>Date From </th>
                                  <th>Date To</th>
                                  <th>Duration</th>
                                  <th>File Upload</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $count = 0;
                              while($rowData = mysqli_fetch_array($runData)) {
                                  $count++;
                                  $id  = $rowData['id'];
                                  $names  = $rowData['company'];
                                  $jobs  = $rowData['job_title'];
                                  $date_froms   = $rowData['date_from'];
                                  $date_tos   = $rowData['date_to'];
                                  $total_exp = $rowData['total_exp'];
                                  $file = $rowData['file'];
                                  $pathImg = "../../images/candidates/employee_experince/".$file;
                                  ?>
                                  <tr>
                                      <td><?php echo $count ?></td>
                                      <td><?php echo $names ?></td>
                                      <td><?php echo $jobs ?></td>
                                      <td><?php echo $date_froms ?></td>
                                      <td>
                                          <?php
                                          if($rowData['date_to'] != "0000-00-00")
                                          {
                                              echo $date_tos;
                                          }
                                          else
                                          {
                                              echo "Continue";
                                          }
                                          ?>
                                      </td>
                                      <td><?php echo $total_exp ?></td>
                                      <td>
                                          <?php
                                          if($file == "Continue")
                                          {
                                              echo "Continue";
                                          }
                                          elseif($file == '')
                                          {
                                              echo "Not Uploaded";
                                          }
                                          else
                                          {
                                              ?>
                                              <a class="Data_Ajax4" data-id="<?php echo $pathImg ?>" href="#edit1"
                                                 data-toggle='modal'>
                                                  View
                                              </a>
                                          <?php } ?>
                                      </td>
                                  </tr>
                              <?php }?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              <?php } else { ?>
                  <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-danger">
                          <p><b>Experience Details Not Uploaded</b></p>
                      </div>
                  </div>
              <?php } ?>


              <hr class="shadow" style="border: 1px solid grey;">
              <div class="row p-0 m-0">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Challan Details</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; width: 300px; ">
                  </div>
              </div>
              <?php

              $fetchData= "SELECT cap.challan_file, cap.challan_upload_date, cap.post_id, p.post_name  FROM candidate_applied_post AS cap  
                LEFT JOIN projects_posts AS p ON cap.post_id=p.id
                WHERE candidate_id = '$canddate_id'";

              $runData = mysqli_query($connection,$fetchData);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
                  ?>

                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="table table-bordered bg-white text-center" style="font-size: 12px">
                              <thead class="bg-dark">
                              <tr>
                                  <th>Post Name</th>
                                  <th>Uploaded Date</th>
                                  <th>Challan</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              while($rowData = mysqli_fetch_array($runData)) {
                                  $file  = $rowData['challan_file'];
                                  $challan_date  = $rowData['challan_upload_date'];
                                  $challan_file = "../../images/candidates/challans/".$file;
                                  $postName = $rowData['post_name'];
                                  ?>
                                  <tr>
                                      <td><?php echo $postName ?></td>
                                      <td><?php echo $challan_date ?></td>
                                      <td>
                                          <form method="post" enctype="multipart/form-data">
                                          <?php
                                          if($file){
                                          ?>
                                          <img src="<?php echo $challan_file ?>" width="500" />
                                          <?php
                                          } else {
                                              ?>
                                              <input type="file" name="challan_file" required>
                                              <input type="hidden" name="challan_post_id" value="<?php echo $rowData['post_id'];?>">
                                              <input type="submit" value="Upload" name="uploadChallan">
                                              <?php
                                          }

                                          ?>
                                          </form>
                                      </td>

                                  </tr>
                              <?php
                                  } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              <?php } else { ?>
                  <div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-danger">
                          <p><b>Challan not uploaded!</b></p>
                      </div>
                  </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modal Start-->
<div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog bg-white" style="border: blue 2px solid; border-radius: 8px" role="document">
        <div class="modal-content1">

        </div>
    </div>
</div>
<!-- Modal end -->
<?php include "includes/footer.php"; ?>

<script type="text/javascript">
    $('.Data_Ajax5').click(function() {
        var std_image1 = $(this).attr('data-id');

        $.ajax({
            method: 'POST',
            url: 'admin_ajax.php',
            data: {
                edu_image1: std_image1
            },
            datatype: "html",
            success: function(result) {
                $(".modal-content1").html(result);
            }
        });
    });
    $('.Data_Ajax4').click(function() {
        var std_image1 = $(this).attr('data-id');

        $.ajax({
            method: 'POST',
            url: 'admin_ajax.php',
            data: {
                std_image1: std_image1
            },
            datatype: "html",
            success: function(result) {
                $(".modal-content1").html(result);
            }
        });
    });
  function checkEmpl()
  {
    var empl = $("#emp1").val();
    if(empl == 'Yes')
    {
      $("#exp1").show();
    }
    else
    {
      $("#exp1").hide();
    }
  }
  function checkEmpl2()
  {
    var empl = $("#emp2").val();
    if(empl == 'Yes')
    {
      $("#exp2").show();
    }
    else
    {
      $("#exp2").hide();
    }
  }
  window.onload = function()
  {
    checkEmpl();
    checkEmpl2();
  }

  $('.ajaxData1').click(function(){
    var disability = $(this).attr('data-id');
    $.ajax({
      method:'POST',
      url:'candidate_ajax.php',
      data: {
          disability: disability
      },
      datatype: "html",
      success:function(result){
        $(".modal-content").html(result);
    }
    });
  });

  $('.ajaxData2').click(function(){
    var widow_file = $(this).attr('data-id');
    $.ajax({
      method:'POST',
      url:'candidate_ajax.php',
      data: {
          widow_file: widow_file
      },
      datatype: "html",
      success:function(result){
        $(".modal-content").html(result);
    }
    });
  });
</script>
<!-- Modal Start-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

    </div>
  </div>
</div>
<!-- Modal end -->