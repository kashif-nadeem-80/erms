<?php
include "includes/header.php";
$canddate_id = $_GET['id'];
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
          <li class="breadcrumb-item active">Candidate Information</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <a href="registered_users.php" class="mb-2 btn btn-warning shadow">Back</a>
        <a href="registered_users.php" class="mb-2 btn btn-primary shadow float-right">Show List</a>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Candidate Details</div>
          </div>
          <br>
          <?php

          $query = "SELECT p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file FROM `candidates` AS c 
              LEFT JOIN district AS d ON d.id = c.district_id
              LEFT JOIN zone AS z ON z.id = d.zone_id
              LEFT JOIN province AS p ON p.id = d.pro_id
              WHERE c.id = '$canddate_id'";
          $result = mysqli_query($connection, $query);
          $rowData = mysqli_fetch_array($result);
          $d_id = $rowData['d_id'];
          $d_name = $rowData['dis_name'];
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
          if ($rowData['dob'] != '') {
            $dob = date("d-m-Y", strtotime($rowData['dob']));
          } else {
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
            <div class="row p-0 m-0">
              <div class="col-md-12 text-center text-primary">
                <h3>Personal Information</h3>
                <hr class="shadow" style="border: 1px solid #007bff; width: 250px; ">
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
              </div>
              <div class="col-md-7">
                <div class="form-group  mr-3 mt-0 float-right">
                  <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="130px" src="../../images/candidates/profile picture/<?php if ($image == NULL or $image == '') { echo "../../file_icon.png"; } else { echo $image; } ?>" alt="Image">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Name in Full</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $name; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $f_name; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Candidate CNIC #</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $cnic; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Gender</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $gender; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Have You any disability?</label>
                  <?php
                  if ($disability == 'Yes') { ?>
                    <a href="#edit" class="ajaxData1" data-toggle='modal' data-id="<?php echo $disable_file ?>">(View)
                    </a>
                  <?php } ?>
                  <input type="text" class="form-control" disabled value="<?php echo  $disability; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $dob; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $email; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Province Of Domicile</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $pro_namee; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>District</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $d_name; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Zone</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $zone_name; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Postal Address</label>
                  <textarea class="form-control" disabled><?php echo  $postal_address; ?></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Phone No:(Res.)</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $telephone; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Mobile(mandatory)</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $phone; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Religion</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $religion; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Are You a Govt serving employee?</label>
                  <input type="text" id="emp1" class="form-control" disabled value="<?php echo  $gov_employee; ?>">
                </div>
              </div>
              <div class="col-md-6" id="exp1">
                <div class="form-group">
                  <label for="">Total Experience</label>
                  <input type="text" id="emp1" class="form-control" disabled value="<?php echo  $simple_exper; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Are You retired from Pakistan Armed Forces?</label>
                  <input type="text" id="emp2" class="form-control" disabled value="<?php echo  $retired_pak; ?>">
                </div>
              </div>
              <div class="col-md-6" id="exp2">
                <div class="form-group">
                  <label for="">Total Experince</label>
                  <input type="text" id="emp2" class="form-control" disabled value="<?php echo  $army_exper; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Widow/Son/Daughter of deceased Govt Employee?</label>
                  <?php
                  if ($widow_gov_emp  == 'Yes') {
                  ?>
                    <a href="#edit" class="ajaxData2" data-toggle='modal' data-id="<?php echo $widow_file ?>">(View)
                    </a>
                  <?php } ?>
                  <input type="text" id="test3" class="form-control" disabled value="<?php echo  $widow_gov_emp; ?>">
                </div>
              </div>
            </div>
            <hr class="shadow" style="border: 1px solid grey;">
            <div class="row p-0 m-0">
              <div class="col-md-12 text-center text-primary">
                <h3>Education's Information</h3>
                <hr class="shadow" style="border: 1px solid #007bff; width: 290px; ">
              </div>
            </div>

            <?php
            $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$canddate_id' ORDER BY e.id ASC";
            $runData = mysqli_query($connection, $query2);
            $countRow = mysqli_num_rows($runData);
            if ($countRow != 0) {
            ?>
              <div class="row">
                <div class="col-md-12">
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
                        <th>Action</th>
                      </tr>
                      <?php
                      $count = 0;

                      while ($rowData = mysqli_fetch_array($runData)) {
                        $count++;
                        $educ_id = $rowData['id'];
                        $level1  = $rowData['level_name'];
                        $degree1  = $rowData['deg_name'];
                        $pas_year = $rowData['passing_year'];
                        $major_subject = $rowData['major_subject'];
                        $obt_marks  = $rowData['obtain_marks'];
                        $tot_marks   = $rowData['total_marks'];
                        $Board1   = $rowData['university'];
                        $certificate = $rowData['deg_image'];
                        $pathImg    = "../../images/candidates/education/" . $certificate;
                      ?>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $level1; ?></td>
                        <td><?php echo $degree1; ?></td>
                        <td><?php echo $pas_year; ?></td>
                        <td><?php echo $major_subject; ?></td>
                        <td><?php echo $obt_marks; ?></td>
                        <td><?php echo $tot_marks; ?></td>
                        <td><?php echo $Board1; ?></td>
                        <td>
                          <a class="Data_Ajax3" data-id="<?php echo $pathImg ?>" href="#edit" data-toggle='modal'>
                            View
                          </a>
                        </td>
                        <td>
                          <a href="registered_education_update.php?educ_id=<?php echo $educ_id ?>" class="btn btn-sm btn-primary shadow text-white" style="margin-top:3px;" title="Edit"><i class="fa fa-edit"></i></a>
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

            $fetchData = "SELECT * FROM work_experince WHERE candidate_id = '$canddate_id'";
            $runData = mysqli_query($connection, $fetchData);
            $countRow = mysqli_num_rows($runData);
            if ($countRow != 0) {
            ?>

              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered bg-white text-center" style="font-size: 12px">
                    <thead class="bg-dark">
                      <tr>
                        <th>S.No</th>
                        <th>Organization/ Company</th>
                        <th>Job Title(Job Relevent Experince)</th>
                        <th>Date From </th>
                        <th>Date To</th>
                        <th>File Upload</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 0;
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $count++;
                        $exp_id  = $rowData['id'];
                        $names  = $rowData['company'];
                        $jobs  = $rowData['job_title'];
                        $date_froms   = $rowData['date_from'];
                        $date_tos   = $rowData['date_to'];
                        $file = $rowData['file'];
                        $pathImg = "../../images/candidates/employee_experince/" . $file;
                      ?>
                        <tr>
                          <td><?php echo $count ?></td>
                          <td><?php echo $names ?></td>
                          <td><?php echo $jobs ?></td>
                          <td><?php echo $date_froms ?></td>
                          <td><?php echo $date_tos ?></td>
                          <td><a class="Data_Ajax1" data-id="<?php echo $pathImg ?>" href="#edit" data-toggle='modal'>
                              View
                            </a></td>
                          <td>
                            <a href="registered_exp_update.php?exp_id=<?php echo $exp_id ?>" class="btn btn-sm btn-primary shadow text-white" title="Edit"><i class="fa fa-edit"></i></a>
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
                  <p><b>Experience Details Not Uploaded</b></p>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include "includes/footer.php"; ?>

<script type="text/javascript">
  function checkEmpl() {
    var empl = $("#emp1").val();
    if (empl == 'Yes') {
      $("#exp1").show();
    } else {
      $("#exp1").hide();
    }
  }

  function checkEmpl2() {
    var empl = $("#emp2").val();
    if (empl == 'Yes') {
      $("#exp2").show();
    } else {
      $("#exp2").hide();
    }
  }
  window.onload = function() {
    checkEmpl();
    checkEmpl2();
  }

  $('.ajaxData1').click(function() {
    var disability = $(this).attr('data-id');
    $.ajax({
      method: 'POST',
      url: 'admin_ajax.php',
      data: {
        disability: disability
      },
      datatype: "html",
      success: function(result) {
        $(".modal-content").html(result);
      }
    });
  });

  $('.ajaxData2').click(function() {
    var widow_file = $(this).attr('data-id');
    $.ajax({
      method: 'POST',
      url: 'admin_ajax.php',
      data: {
        widow_file: widow_file
      },
      datatype: "html",
      success: function(result) {
        $(".modal-content").html(result);
      }
    });
  });
</script>
<script type="text/javascript">
  $('.Data_Ajax3').click(function() {
    var std_image1 = $(this).attr('data-id');
    $.ajax({
      method: 'POST',
      url: 'admin_ajax.php',
      data: {
        edu_image1: std_image1
      },
      datatype: "html",
      success: function(result) {
        $(".modal-content").html(result);
      }
    });
  });
</script>
<script type="text/javascript">
  $('.Data_Ajax1').click(function() {
    var std_image1 = $(this).attr('data-id');
    $.ajax({
      method: 'POST',
      url: 'admin_ajax.php',
      data: {
        std_image1: std_image1
      },
      datatype: "html",
      success: function(result) {
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