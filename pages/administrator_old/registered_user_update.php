<?php
include "includes/header.php";
$u_id = $_GET['u_id'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="hidden" value="<?php echo $u_id ?>" id="candId">
                <h4 class="m-0 text-dark">Personal Information</h4>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Personal Information</li>
                </ol>
            </div>
        </div>
          <div class="row">
    <div class="col-md-12">
    <a href="registered_users.php" class="mb-2 btn btn-warning shadow">Back</a>
    </div>
  </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" class="text-center">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <center id="succ" style="display: none">
                    <h4 class="text-success">User Added Successfully</h4>
                </center>
                <center id="err" style="display: none">
                    <h4 class="text-danger">User Not Added</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                    <div class="card-header">
                        <div class="card-title">Personal Information</div>
                    </div>
                    <br>
                    <?php

                    $query = "SELECT ct.id AS ct_id, ct.c_name, p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.f_contact, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.marital_status, c.status, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file, c.father_occup FROM `candidates` AS c
                    LEFT JOIN district AS d ON d.id = c.district_id
                    LEFT JOIN zone AS z ON z.id = d.zone_id
                    LEFT JOIN province AS p ON p.id = d.pro_id
                    LEFT  JOIN city AS ct ON ct.id = c.city
                    WHERE c.id = '$u_id'";
                    $result = mysqli_query($connection, $query);
                    $rowData = mysqli_fetch_array($result);
                    $ct_id = $rowData['ct_id'];
                    $c_name = $rowData['c_name'];
                    $status = $rowData['status'];
                    $d_id = $rowData['d_id'];
                    $d_name = $rowData['dis_name'];
                    $f_contact = $rowData['f_contact'];
                    $name = $rowData['name'];
                    $marital_statusU = $rowData['marital_status'];
                    $cnic = $rowData['cnic'];
                    $father_occup = $rowData['father_occup'];
                    $email = $rowData['email'];
                    $phone = $rowData['phone'];
                    $image = $rowData['image'];
                    $f_name = $rowData['f_name'];
                    $gender = $rowData['gender'];
                    $dob = $rowData['dob'];
                    $postal_address = $rowData['postal_address'];
                    $telephone = $rowData['telephone'];
                    $religion = $rowData['religion'];
                    ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Verification</label>
                                        <select name="status" class="form-control">
                                            <option <?php if($status == 1) echo "selected"; ?> value="1">Verified</option>
                                            <option <?php if($status == 0) echo "selected"; ?> value="0">Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input id="file1" name="logo1" onchange="showImage1(event)" type="file" accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group mr-3 mt-0">
                                        <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="130px" src="../../images/candidates/profile picture/<?php
                                                                                                                                                                                                                        if ($image == NULL or $image == '') {
                                                                                                                                                                                                                            echo "../../file_icon.png";
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            echo $image;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?> " alt="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name in Full</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required placeholder="Name in Full">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father's Name</label>
                                        <input type="text" name="fathername" placeholder="Father Name" class="form-control" value="<?php echo $f_name; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Candidate CNIC #</label>
                                        <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control" autocomplete="off" required value="<?php echo $cnic; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <?php if ($gender == NULL or $gender == '') {
                                                echo "<option value=''>Choose</option>";
                                            } else {
                                                echo "<option value='$gender'>$gender</option>";
                                            }
                                            ?>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" max="<?php echo date('Y-m-d') ?>" onchange="getAge()" autocomplete="off" value="<?php echo $dob; ?>" >
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
                                        <select class="form-control" name="marital_status" >
                                            <?php if ($marital_statusU == NULL or $marital_statusU == '') {
                                                echo "<option value=''>Choose</option>";
                                            } else {
                                                echo "<option value='$marital_statusU'>$marital_statusU</option>";
                                            }
                                            ?>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select class="form-control" name="religion" >
                                            <?php if ($religion == NULL or $religion == '') {
                                                echo "<option value=''>Choose</option>";
                                            } else {
                                                echo "<option value='$religion'>$religion</option>";
                                            }
                                            ?>
                                            <option value="Muslim">Muslim</option>
                                            <option value="Non-Muslim">Non-Muslim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father's Occupation</label>
                                        <input type="text" name="f_occupation" class="form-control" placeholder="Father's Occupation" value="<?php echo $father_occup; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father's Contact</label>
                                        <input class="form-control" type="tel" name="f_contact" data-inputmask="'mask': '9999-9999999'" maxlength="12" placeholder="03XX-XXXXXXX" value="<?php echo $f_contact; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <textarea class="form-control" name="postaladdress" ><?php echo $postal_address; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select name="city" class="form-control select2" >
                                            <option value="<?php echo $ct_id ?>"><?php echo $c_name ?></option>
                                            <?php
                                            $data = "SELECT * FROM city ORDER BY c_name ASC";
                                            $run = mysqli_query($connection, $data);
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
                                        <select name="dist_id" class="form-control select2" id="fetc_dist" onchange="getzone()" >
                                            <option value="<?php echo $d_id ?>"><?php echo $d_name ?></option>
                                            <?php
                                            $data = "SELECT * FROM district ORDER BY dis_name ASC";
                                            $run = mysqli_query($connection, $data);
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
                                        <input class="form-control" type="tel" name="contact" data-inputmask="'mask': '9999-9999999'" maxlength="12" placeholder="03XX-XXXXXXX" value="<?php echo $phone; ?>">
                                        <span class="text-danger" style="font-size:12px;">(DO NOT give your portable/converted mobile)</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Other Contact</label>
                                        <input type="phone" class="form-control" name="phone" data-inputmask="'mask': '9999-9999999'" maxlength="12" value="<?php echo $telephone; ?>" placeholder="03XX-XXXXXXX">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" autocomplete="off" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-success shadow" value="Update" name="saveUser1">
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
                        $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$u_id' ORDER BY e.id ASC";
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
                                                <th>Certificate/Degree</th>
                                                <th>Year Passing</th>
                                                <th>Major Subject</th>
                                                <th>Obtained Marks</th>
                                                <th>Total Marks/CGPA</th>
                                                <th>University/Board</th>
                                                <th>Certificate</th>
                                            </tr>
                                            <?php
                                            $count = 0;

                                            while ($rowData = mysqli_fetch_array($runData)) {
                                                $count++;
                                                $educ_id = $rowData['id'];
                                                $level1 = $rowData['level_name'];
                                                $degree1 = $rowData['deg_name'];
                                                $pas_year = $rowData['passing_year'];
                                                $major_subject = $rowData['major_subject'];
                                                $obt_marks = $rowData['obtain_marks'];
                                                $tot_marks = $rowData['total_marks'];
                                                $Board1 = $rowData['university'];
                                                $certificate = $rowData['deg_image'];
                                                $pathImg = "../../images/candidates/education/" . $certificate;
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
                                                    <a class="Data_Ajax1 btn btn-sm btn-warning shadow title" data-id="<?php echo $pathImg ?>" href="#edit" data-toggle='modal'>
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <br>
                                                    <a href="registered_education_update.php?educ_id=<?php echo $educ_id ?>" class="btn btn-sm btn-primary shadow text-white" style="margin-top:3px;" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <br>
                                                    <input type="hidden" id="edu_id<?php echo $count ?>" value="<?php echo $educ_id ?>">
                                                    <input type="hidden" id="pathImg<?php echo $count ?>" value="<?php echo $pathImg ?>">
                                                    <a style="margin-top:3px;" class="btn btn-sm btn-danger shadow text-white" title="Delete" onclick="deleteData1(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
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

                        $fetchData = "SELECT * FROM work_experince WHERE candidate_id = '$u_id'";
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
                                                <th>Date From</th>
                                                <th>Date To</th>
                                                <th>File Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            while ($rowData = mysqli_fetch_array($runData)) {
                                                $count++;
                                                $exp_id = $rowData['id'];
                                                $names = $rowData['company'];
                                                $jobs = $rowData['job_title'];
                                                $date_froms = $rowData['date_from'];
                                                $date_tos = $rowData['date_to'];
                                                $file = $rowData['file'];
                                                $pathImgE = "../../images/candidates/employee_experince/" . $file;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $names ?></td>
                                                    <td><?php echo $jobs ?></td>
                                                    <td><?php echo $date_froms ?></td>
                                                    <td><?php echo $date_tos ?></td>
                                                    <td>
                                                        <a class="Data_Ajax1 btn btn-sm btn-warning shadow title" title="Details" data-id="<?php echo $pathImgE ?>" href="#edit" data-toggle='modal'>
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <a href="registered_exp_update.php?exp_id=<?php echo $exp_id ?>" class="btn btn-sm btn-primary shadow text-white" title="Edit"><i class="fa fa-edit"></i></a>

                                                        <input type="hidden" id="exp_id<?php echo $count ?>" value="<?php echo $exp_id ?>">
                                                        <input type="hidden" id="pathImgE<?php echo $count ?>" value="<?php echo $pathImgE ?>">
                                                        <a class="btn btn-sm btn-danger shadow text-white" title="Delete" onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
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
                    <?php
                    if (isset($_POST['saveUser1']) or isset($_POST['saveUser2'])) {
                        if ($_FILES['logo1']['name'] == '') {
                            $profImage = $image;
                        } else {
                            $profImage = date("Y-m-d H-i-s") . $_FILES['logo1']['name'];
                            $temp_profImage = $_FILES['logo1']['tmp_name'];

                            $pathImg1U = "../../images/candidates/profile picture/" . $profImage;
                            move_uploaded_file($temp_profImage, $pathImg1U);
                            $path1 = "../../images/candidates/profile picture/" . $image;
                            @unlink($path1);
                        }
                        $u_name = $_POST['name'];
                        $u_status = $_POST['status'];
                        $u_f_name = $_POST['fathername'];
                        $u_cnic = $_POST['cnic'];
                        $u_gender = $_POST['gender'];
                        $u_dob = $_POST['dob'];
                        $u_marital_status = $_POST['marital_status'];
                        $u_religion = $_POST['religion'];
                        $u_f_occupation = $_POST['f_occupation'];
                        $u_f_contact = $_POST['f_contact'];
                        $u_postal_address = $_POST['postaladdress'];
                        $u_city = $_POST['city'];
                        $u_d_name = $_POST['dist_id'];
                        $u_phone = $_POST['contact'];
                        $u_telephone = $_POST['phone'];
                        $u_email = $_POST['email'];

                        $update = "UPDATE `candidates` SET `status` = '$u_status', `district_id`='$u_d_name',`name`='$u_name',`cnic`='$u_cnic',`email`='$u_email',`phone`='$u_phone',`image`='$profImage',`f_name`='$u_f_name',`gender`='$u_gender',`dob`='$u_dob',`postal_address`='$u_postal_address',`telephone`='$u_telephone',`religion`='$u_religion', marital_status = '$u_marital_status', father_occup = '$u_f_occupation', f_contact = '$u_f_contact', city = '$u_city' WHERE id = '$u_id'";
                        $run = mysqli_query($connection, $update);
                        if ($run and isset($_POST['saveUser1'])) {
                            echo "<!DOCTYPE html>
              <html>
                <body>
                  <script>
                  Swal.fire(
                  'Updated !',
                  'Register user has been updated successfully',
                  'success'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'registered_users.php';
                  
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
                  'Register user not update, Some error occure',
                  'error'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'registered_users_details.php?id=$u_id';
                  }
                  });
                  </script>
                </body>
              </html>";
                        }
                    }
                    ?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- Col-12 -->
    </div>
    <!-- row -->
    </div>
</section>
<?php include "includes/footer.php"; ?>
<script type="text/javascript">
    function deleteData1(id) {
        var candId = $("#candId").val();
        var edu_id = $("#edu_id" + id).val();
        var pathImg = $("#pathImg" + id).val();
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
                window.location.href = "registered_user_update.php?delId=" + edu_id + "&pathImg=" + pathImg + "&u_id=" + candId;
            }
        });

    }
</script>
<?php
if (isset($_GET['delId'])) {
    $del_id = $_GET['delId'];
    $pathImg = $_GET['pathImg'];
    @unlink($pathImg);
    echo $delete = "DELETE FROM education WHERE id = '$del_id'";
    $run = mysqli_query($connection, $delete);
    if ($run) {
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
                 window.location.href = 'registered_user_update.php?u_id=$u_id';
              }
            });
            </script>
            </body>
          </html>";
    }
}
?>

<script type="text/javascript">
    function deleteData(id) {
        var candId = $("#candId").val();
        var exp_id = $("#exp_id" + id).val();
        var pathImgE = $("#pathImgE" + id).val();
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
                window.location.href = "registered_user_update.php?deletId=" + exp_id + "&pathImgE=" + pathImgE + "&u_id=" + candId;
            }
        });

    }
</script>
<?php
if (isset($_GET['deletId'])) {
    $de_id = $_GET['deletId'];
    $pathImgE = $_GET['pathImgE'];
    @unlink($pathImgE);
    echo $delete = "DELETE FROM work_experince WHERE id = '$de_id'";
    $run = mysqli_query($connection, $delete);
    if ($run) {
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
                 window.location.href = 'registered_user_update.php?u_id=$u_id';
              }
            });
            </script>
            </body>
          </html>";
    }
}
?>
<script>
    var showImage1 = function(event) {
        var uploadField = document.getElementById("file1");
        if (uploadField.files[0].size > 300000) {
            uploadField.value = "";
            Swal.fire(
                'Error !',
                'File Size is too big! Upload logo under 300kB !',
                'error'
            ).then((result) => {
                if (result.isConfirmed) {}
            });
        } else {
            var logoId = document.getElementById('log1');
            logoId.src = URL.createObjectURL(event.target.files[0]);
        }
    }


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
        getAge();
    }
</script>
<script>
    function getdist() {
        var pro_domicile = $("#pro_domicile").val();
        $.ajax({
            url: "candidate_ajax.php",
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
        var fetc_dist = $("#fetc_dist").val();
        if (fetc_dist != '') {
            $.ajax({
                url: "candidate_ajax.php",
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
</script>
<script type="text/javascript">
    function showDiv() {
        var check1 = $('#test0').val();
        if (check1 != 'No') {
            $('#hidden_div').attr('disabled', false);
            $('#log2').css('display', 'block');
        } else {
            $('#hidden_div').attr('disabled', true);
            $('#log2').css('display', 'nonenone');
        }
    }
</script>
<script type="text/javascript">
    function showDiv1() {
        var check1 = $('#test3').val();
        if (check1 != 'No') {
            $('#hidden_div3').attr('disabled', false);
            $('#log3').css('display', 'block');
        } else {
            $('#hidden_div3').attr('disabled', true);
            $('#log3').css('display', 'nonenone');
        }
    }

    function getAge() {
        let d_o_b = document.getElementById('d_o_b').value;
        let d_o_b1 = new Date(d_o_b);
        let currentDate = new Date();
        let months = 0;
        months = (currentDate.getFullYear() - d_o_b1.getFullYear()) * 12;
        months -= d_o_b1.getMonth();
        months += currentDate.getMonth();

        let dur1 = Math.floor(months / 12)
        let dur2 = (months / 12) - dur1
        let dur3 = Math.floor(dur2 * 12)
        let age = dur1 + " years & " + dur3 + " months";
        document.getElementById('agee').value = age;
    }
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