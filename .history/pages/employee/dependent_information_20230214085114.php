<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Dependet Detail</h4>
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
        <h4 class="text-success">User Added Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">User Not Added</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
          <br>
          <?php
          
          $query = "SELECT ct.id AS ct_id, ct.c_name, p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.f_contact, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.marital_status, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file, c.father_occup FROM `candidates` AS c
          LEFT JOIN district AS d ON d.id = c.district_id
          LEFT JOIN zone AS z ON z.id = d.zone_id
          LEFT JOIN province AS p ON p.id = d.pro_id
          LEFT  JOIN city AS ct ON ct.id = c.city
          WHERE c.id = '$canddate_id'";
          $result = mysqli_query($connection,$query);
          $rowData = mysqli_fetch_array($result);
          $ct_id = $rowData['ct_id'];
          $c_name = $rowData['c_name'];
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
          $disability = $rowData['disability'];
          ?>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name in Full</label>
                    <input type="text" name="name" class="form-control" value="<?php echo  $name;?>"
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
                    <label>CNIC / B-Form </label>
                    <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'"
                    placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control"
                    autocomplete="off" required value="<?php echo  $cnic;?>">
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
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" max="<?php echo date('Y-m-d')?>" onchange="getAge()" autocomplete="off" value="<?php echo  $dob;?>" required>
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
                    <label>Relationship</label>
                    <select class="form-control" name="marital_status" required>
                      <?php if($marital_statusU == NULL OR $marital_statusU == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      // echo "<option value='$marital_statusU'>$marital_statusU</option>"; 
                    }
                      ?>
                      <option value="Father">Father</option>
                      <option value="Father">Mother</option>
                      <option value="Father">Son</option>
                      <option value="Father">Daughter</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <!-- <label>Religion</label>
                    <select class="form-control" name="religion" required>
                      <?php // if($religion == NULL OR $religion == '') {
                      //echo "<option value=''>Choose</option>";
                      //} else {
                      //echo "<option value='$religion'>$religion</option>"; }
                      ?>
                      <option value="Muslim">Muslim</option>
                      <option value="Non-Muslim">Non-Muslim</option>
                    </select>
                  </div>
                </div> -->
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label>Father's Occupation</label>
                    <input type="text" name="f_occupation" class="form-control"
                    placeholder="Father's Occupation" required value="<?php echo  $father_occup; ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Father's Contact</label>
                    <input class="form-control" type="tel" name="f_contact"
                    data-inputmask="'mask': '9999-9999999'" maxlength="12"
                    placeholder="03XX-XXXXXXX" required value="<?php echo $f_contact;?>">
                  </div>
                </div> -->
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label>City</label>
                    <select name="city" class="form-control select2" required>
                      <option value="<?php echo $ct_id ?>"><?php echo $c_name ?></option>
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
                </div> -->
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label>District</label>
                    <select name="dist_id" class="form-control select2" id="fetc_dist"
                      onchange="getzone()" required>
                      <option value="<?php echo $d_id ?>"><?php echo $d_name ?></option>
                      <?php
                      $data = "SELECT * FROM district ORDER BY dis_name ASC";
                      $run = mysqli_query($connection,$data);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['id'];
                      $district = $row['dis_name'];
                      echo "<option value='$id'>$district</option>";
                      }
                      ?> -->
                    </select>
                  </div>
                </div>

                <!-- <div class="col-md-8">
                  <div class="form-group">
                    <label>Postal Address</label>
                     <!-- <textarea class="form-control" 
                    name="postaladdress" required><?php echo  $postal_address;?></textarea> -->
                    <!-- <input type="text" class="form-control" 
                    name="postaladdress" required value= " <?php echo  $postal_address; ?>" > </input>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Personal Contact</label>
                    <input class="form-control" type="tel" required name="contact"
                    data-inputmask="'mask': '9999-9999999'" maxlength="12"
                    placeholder="03XX-XXXXXXX" value="<?php echo  $phone;?>">
                    <span class="text-red" style="font-size:15px;">(Dont give portable/converted mobile no)</span>
                  </div>
                </div> -->

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Other Contact</label>
                    <input type="phone" class="form-control" name="phone" data-inputmask="'mask': '9999-9999999'" maxlength="12" value="<?php echo  $telephone;?>" placeholder="03XX-XXXXXXX">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                    placeholder="example@gmail.com" autocomplete="off"
                    value="<?php echo  $email;?>" required>
                  </div>
                </div> -->
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

                <div class="col-md-11 text-right">
                  <input type="submit" class="btn btn-success shadow" value="Update"
                  name="saveUser1">
                  <input type="submit" class="btn btn-primary shadow" value="Update & Next"
                  name="saveUser2">
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
            $u_disability=$_POST['disability_status'];
            
            $update ="UPDATE `candidates` SET `district_id`='$u_d_name',
            `name`='$u_name',`cnic`='$u_cnic',`email`='$u_email',
            `phone`='$u_phone',`image`='$profImage',`f_name`='$u_f_name',
            `gender`='$u_gender', `dob`='$u_dob',`postal_address`='$u_postal_address',
            `telephone`='$u_telephone',`religion`='$u_religion', 
            `marital_status` = '$u_marital_status',`disability`='$u_disability', 
            father_occup = '$u_f_occupation', f_contact='$u_f_contact', 
            city = '$u_city' WHERE id = '$canddate_id'" ;

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
                  window.location.href = 'education_add.php';
                  
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