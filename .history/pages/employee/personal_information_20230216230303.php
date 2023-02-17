<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Personal Information</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home /</a></li>
          <!-- <li class="breadcrumb-item active">Personal Information</li> -->
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
        <center id="succ" style="display: none">
        <h4 class="text-success">Record Added Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">Record Not Added</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
          <br>
          <?php
          
          $query = "SELECT e.name as name,
          e.f_name as f_name, 
          e.cnic as cnic,
          e.email as email,
          e.cellno as cellno,
          e.designation as designation,
          e.bps as bps, 
          e.curr_posting as posting,
          e.gender as gender,
          e.disability as disability,
          e.bg as bg,
          e.dob as dob,
          e.doa as doa,
          e.age as emp_age,
          e.province as province_id,
          e.district as district_id,
          e.postal_address as postal_address,
          e.domicile as domicile_id,
          e.last_degree as last_degree,
          e.telephone as telephone,
          e.religion as religion,
          e.marital_status as marital_status,
          e.image as image, d.district_id as dist_id, d.district as domicile, d.province as province ,
          d.district as district 
          from employees e 
          left outer join districts d on e.domicile =  d.district_id  
          WHERE cnic = '$canddate_id'";
          $result = mysqli_query($connection,$query);
          $rowData = mysqli_fetch_array($result);
          // $ct_id = $rowData['id'];
          $emp_name = $rowData['name'];
          $f_name = $rowData['f_name'];
          $cnic = $rowData['cnic'];
          $email = $rowData['email'];
          $designation = $rowData['designation'];
          $bps = $rowData['bps'];
          $bg = $rowData['bg'];
          $posting = $rowData['posting'];
          $cellno = $rowData['cellno'];
          $image = $rowData['image'];
          $gender = $rowData['gender'];
          $disability = $rowData['disability'];
          $province = $rowData['province'];
          $district = $rowData['district'];
          $province_id = $rowData['province_id'];
          $district_id = $rowData['district_id'];
          $dob = $rowData['dob'];
          $doa = $rowData['doa'];
          $emp_age = $rowData['emp_age'];
          $postal_address = $rowData['postal_address'];
          $domicile = $rowData['domicile'];
          $domicile_id = $rowData['domicile_id'];
          $religion = $rowData['religion'];
          $qualification = $rowData['last_degree'];
          $marital_statusU = $rowData['marital_status'];
          $telephone = $rowData['telephone'];
          ?>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name in Full</label>
                    <input type="text" name="name" class="form-control" value="<?php echo  $emp_name;?>"
                    required placeholder="Name in Full">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" name="fathername" placeholder="Father Name"
                    class="form-control" value="<?php echo  $f_name;?>" autocomplete="off"
                    required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Employee CNIC #</label>
                    <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'"
                    placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control"
                    autocomplete="off" required value="<?php echo  $cnic;?>">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" value="<?php echo  $designation;?>"
                    required placeholder="Designation">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>BPS</label>
                    <select name="bps" class="form-control" required>
                      <?php if($bps == NULL OR $bps == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$bps'>$bps</option>"; 
                    }
                      ?>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Place of Posting</label>
                    <input type="text" name="posting" placeholder="posting"
                    class="form-control" value="<?php echo  $posting;?>" autocomplete="off"
                    required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                      <?php if($gender == NULL OR $gender == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$gender'>$gender</option>"; }
                      ?>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Transgender</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" 
                    max="<?php echo date('Y-m-d')?>" onchange="getAge()" autocomplete="off" 
                    value="<?php echo  $dob;?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Age</label>
                    <input type="text" placeholder="Age" name="employee_age" id="agee" class="form-control"  readonly>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select class="form-control" name="marital_status" required>
                      <?php if($marital_statusU == NULL OR $marital_statusU == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$marital_statusU'>$marital_statusU</option>"; }
                      ?>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Religion</label>
                    <select class="form-control" name="religion" required>
                      <?php if($religion == NULL OR $religion == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$religion'>$religion</option>"; }
                      ?>
                      <option value="Muslim">Muslim</option>
                      <option value="Non-Muslim">Non-Muslim</option>
                    </select>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>Latest Qualification</label>
                    <input type="text" name="qualification" class="form-control"
                    placeholder="Last Degree" required value="<?php echo  $qualification; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Appointment</label>
                    <input type="date" name="doa" id="d_o_a" class="form-control" 
                    max="<?php echo date('Y-m-d')?>"  autocomplete="off" value="<?php echo  $doa;?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Province</label>
                    <select name="province" class="form-control select2" required>
                      <option value="<?php echo $province_id ?>"><?php echo $province ?></option>
                      <?php
                      $data = "SELECT distinct province, province_id FROM districts ORDER BY province ASC";
                      $run = mysqli_query($connection,$data);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['province_id'];
                      $name = $row['province'];
                      echo "<option value='$id'>$name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Domicile</label>
                    <select name="domicile" class="form-control select2" required>
                      <option value="<?php  echo $domicile_id ?>"><?php echo $domicile ?></option>
                      <?php
                      $data = "SELECT * FROM districts ORDER BY district ASC";
                      $run = mysqli_query($connection,$data);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['district_id'];
                      $name = $row['district'];
                      echo "<option value='$id'>$name</option>";
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
                      <option value="<?php echo $district_id ?>"><?php echo $district ?></option>
                      <?php
                      $data = "SELECT * FROM districts ORDER BY district ASC";
                      $run = mysqli_query($connection,$data);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['district_id'];
                      $district = $row['district'];
                      echo "<option value='$id'>$district</option>";
                      }
                      ?>
                    </select>
                  
                  </div>
                  
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>Blood Group</label>
                    <select name="bg" class="form-control" required>
                      <?php if($bg == NULL OR $bg == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$bg'> $bg </option>"; 
                    }
                      ?>
                      <option value="A+">A+</option>
                      <option value="B+">B+</option>
                      <option value="O+">O+</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="A-">A-</option>
                      <option value="B-">B-</option>
                      <option value="O-">O-</option>
                      
                    </select>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Postal Address</label>
                     <!-- <textarea class="form-control" 
                    name="postaladdress" required><?php echo  $postal_address;?></textarea> -->
                    <input type="text" class="form-control" 
                    name="postaladdress" required value= " <?php echo  $postal_address; ?>" > </input>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Cell No</label>
                    <input class="form-control" type="tel" required name="cellno"
                    data-inputmask="'mask': '9999-9999999'" maxlength="12"
                    placeholder="03XX-XXXXXXX" value="<?php echo $cellno;?>">
                    <span class="text-red" style="font-size:15px;">(Dont give portable/converted mobile no)</span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="phone" class="form-control" name="phone" data-inputmask="'mask': '999-9999999'" maxlength="12" value="<?php echo  $telephone;?>" placeholder="03XX-XXXXXXX">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                    placeholder="example@gmail.com" autocomplete="off"
                    value="<?php echo  $email;?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Have Any Disability</label>
                    <select class="form-control" name="disability_status" required>
                      <?php if($disability == NULL OR $disability == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$disability'>$disability</option>"; }
                      ?>
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Profile Image</label>
                    <input id="file1" name="logo1" required onchange="showImage1(event)" type="file"
                    accept="image/*" class="form-control" style="overflow: hidden;"
                    placeholder="Insert Your Image">
                  </div>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                  <div class="form-group mr-2 mt-3">
                    <img id="log1" class="shadow"
                    style="border: 1px blue solid; border-radius: 50%; margin-top: -2%"
                    width="120px;" height="130px" src="../../images/candidates/profile picture/<?php
                    if($image == NULL OR $image == '')
                    {
                    echo "../../file_icon.png";
                    }
                    else
                    {
                    echo $image;
                    }
                    ?> " alt="Profile Picture">
                  </div>
                 
                </div>
                <p style="font-size: large; font-style: italic; color: red;"> 
                   Undertaking ! <br>
                   All the information mentioned above is true and provided in good faith.
                
                
                </p>

                <div class="col-md-11 text-right">
                  <input type="submit" class="btn btn-success shadow" value="Update"
                  name="saveUser1" style=" width:170px">
                  <input type="submit" class="btn btn-primary shadow" value="Update & Next"
                  name="saveUser2" style=" width:170px">
                </div>
              </div>
            </form>
<?php

       


          if(isset($_POST['saveUser1']) OR isset($_POST['saveUser2']))
          {
            if($_FILES['logo1']['name'] == '')
            {
              $profImage = $image;
            }
            else
            {
              $profImage = date("Y-m-d H-i-s").$_FILES['logo1']['name'];
              $temp_profImage  = $_FILES['logo1']['tmp_name'];

              $pathImg1U    = "../../images/candidates/profile picture/".$profImage;
              move_uploaded_file($temp_profImage,$pathImg1U);
              $path1    = "../../images/candidates/profile picture/".$image;
              @unlink($path1);
            }
            $u_name = $_POST['name'];
            $u_f_name = $_POST['fathername'];
            $u_cnic = $_POST['cnic'];
            $u_designation = $_POST['designation'];
            $u_bps = $_POST['bps'];
            $u_posting = $_POST['posting'];
            
            $u_gender = $_POST['gender'];
            $u_dob = $_POST['dob'];
            $u_age = $_POST['employee_age'];
            $u_marital_status = $_POST['marital_status'];
            $u_religion = $_POST['religion'];
            $u_qualification = $_POST['qualification'];
            $u_doa = $_POST['doa'];
            
            $u_province = $_POST['province'];
            $u_bg = $_POST['bg'];
            $u_domicile = $_POST['domicile'];
            $u_postal_address = $_POST['postaladdress'];
            $u_d_name = $_POST['dist_id'];
            $u_cellno = $_POST['cellno'];
            $u_telephone = $_POST['phone'];
            $u_email = $_POST['email'];
            $u_disability=$_POST['disability_status'];
            
            $update ="UPDATE `employees` SET `district`='$u_d_name',
            `name`='$u_name',`cnic`='$u_cnic',`email`='$u_email',
            `cellno`='$u_cellno',`image`='$profImage',`f_name`='$u_f_name',
            `gender`='$u_gender', `dob`='$u_dob',`postal_address`='$u_postal_address',
            `telephone`='$u_telephone',`religion`='$u_religion', 
            `marital_status` = '$u_marital_status',`disability`='$u_disability', 
             domicile = '$u_domicile', province = '$u_province', last_degree = '$u_qualification',
             province = '$u_province', age = '$u_age' , bg='$u_bg', curr_posting='$u_posting' , designation='$u_designation',
             bps='$u_bps'
              WHERE cnic = '$canddate_id'" ;

            $run = mysqli_query($connection,$update);
            if($run AND isset($_POST['saveUser1']))
            {
              echo "<!DOCTYPE html>
              <html>
                <body>
                  <script>
                  Swal.fire(
                  'Updated !',
                  'Personal Information has been updated successfully',
                  'success'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'personal_information.php';
                  
                  }
                  });
                  </script>
                </body>
              </html>";
            }
            elseif ($run AND isset($_POST['saveUser2']))
            {
              echo "<!DOCTYPE html>
              <html>
                <body>
                  <script>
                  Swal.fire(
                  'Updated !',
                  'Personal Information has been updated successfully',
                  'success'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'dependent_information.php';
                  
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
                  'Personal Information not update, Some error occure',
                  'error'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'personal_information.php';
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
if (result.isConfirmed) {
}
});
} else {
var logoId = document.getElementById('log1');
logoId.src = URL.createObjectURL(event.target.files[0]);
}
}
var showImage2 = function(event) {
var uploadField = document.getElementById("hidden_div");
if (uploadField.files[0].size > 300000) {
uploadField.value = "";
// alert("File is too big! Upload logo under 300kB");
Swal.fire(
'Error !',
'File Size is too big! Upload logo under 300kB !',
'error'
).then((result) => {
if (result.isConfirmed) {
}
});
} else {
var logoId = document.getElementById('log2');
logoId.src = URL.createObjectURL(event.target.files[0]);
}
}
var showImage3 = function(event) {
var uploadField = document.getElementById("hidden_div3");
if (uploadField.files[0].size > 300000) {
uploadField.value = "";
// alert("File is too big! Upload logo under 300kB");
Swal.fire(
'Error !',
'File Size is too big! Upload logo under 300kB !',
'error'
).then((result) => {
if (result.isConfirmed) {
}
});
} else {
var logoId = document.getElementById('log3');
logoId.src = URL.createObjectURL(event.target.files[0]);
}
}
</script>
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
})
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

  let dur1 = Math.floor(months/12)
  let dur2 = (months/12)-dur1
  let dur3 = Math.floor(dur2*12)
  let age =  dur1+" years & "+dur3+" months";
  document.getElementById('agee').value = age;
}
</script>