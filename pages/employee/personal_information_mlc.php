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
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Personal Information</li>
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
            <div class="card-title">Personal Information</div>
          </div>
          <br>
          <?php
          
          $query = "SELECT p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file FROM `candidates` AS c
          LEFT JOIN district AS d ON d.id = c.district_id
          LEFT JOIN zone AS z ON z.id = d.zone_id
          LEFT JOIN province AS p ON p.id = d.pro_id
          WHERE c.id = '$canddate_id'";
          $result = mysqli_query($connection,$query);
          $rowData = mysqli_fetch_array($result);
          $d_id = $rowData['d_id'];
          $d_name = $rowData['dis_name'];
          $name = $rowData['name'];
          $cnic = $rowData['cnic'];
          $email = $rowData['email'];
          $phone = $rowData['phone'];
          $password = $rowData['password'];
          if($rowData['zone_name'] == '')
          {
            $zone_name =  "Zone Not Add";
          }
          else
          {
            $zone_name = $rowData['zone_name'];
          }
          $pro_namee = $rowData['pro_name'];
          $pro_idd = $rowData['pro_id'];
          $disable_file = $rowData['disable_file'];
          $widow_file = $rowData['widow_file'];
          $image = $rowData['image'];
          $signupdate = $rowData['signUpDate'];
          $f_name = $rowData['f_name'];
          $gender = $rowData['gender'];
          $disability = $rowData['disability'];
          $dob = $rowData['dob'];
          $postal_address = $rowData['postal_address'];
          $telephone = $rowData['telephone'];
          $religion = $rowData['religion'];
          $gov_employee = $rowData['gov_employee'];
          $simple_exper = $rowData['simple_exper'];
          $retired_pak = $rowData['retired_pak'];
          $army_exper = $rowData['army_exper'];
          $widow_gov_emp = $rowData['widow_gov_emp'];
          ?>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Profile Image</label>
                    <input id="file1" name="logo1" onchange="showImage1(event)" type="file"
                    accept="image/*" class="form-control" style="overflow: hidden;"
                    placeholder="Insert Your Image">
                  </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-7">
                  <div class="form-group mr-3 mt-0">
                    <img id="log1" class="shadow"
                    style="border: 1px blue solid; border-radius: 10%; margin-top: -4%"
                    width="120px;" height="130px" src="../../images/candidates/profile picture/<?php
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
                    <label>Candidate CNIC #</label>
                    <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'"
                    placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control"
                    autocomplete="off" required value="<?php echo  $cnic;?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
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
                    <label>Have You any disability?</label>
                    <select name="disability" id="test0" class="form-control" onchange="showDiv()">
                      <?php if($disability == NULL OR $disability == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$disability'>$disability</option>"; }
                      ?>
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                    <span class="text-danger" style="font-size:11px;">(If Yes Then Please Attach Disability Certificate)</span>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Disability Certificate</label>
                    <input type="file" accept="image/*" onchange="showImage2(event)"
                    style="overflow: hidden;" name="disbl_file"
                    <?php if($disability == NULL OR $disability == '' OR $disability == 'No') { echo "disabled"; } ?>
                    id="hidden_div" class="form-control">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group text-center m-1">
                    <img id="log2" class="shadow"
                    style="border: 1px blue solid; border-radius: 10%; margin-top: -4%"
                    width="120px;" height="130px" src="../../images/candidates/disability certificate/<?php
                    if($disability == NULL OR $disability == '' OR $disability == 'No')
                    {
                      echo "../../file_icon.png";
                    }
                    else
                    {
                      echo $disable_file;
                    }
                    ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" id="d_o_b" name="dob" placeholder="dob" class="form-control"
                    autocomplete="off" onchange="getAge()" value="<?php echo  $dob;?>" required>
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
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                    placeholder="example@gmail.com" autocomplete="off"
                    value="<?php echo  $email; ?>" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Province Of Domicile</label>
                    <select class="form-control" id="pro_domicile" name="pro_domicile"
                      onchange="getdist()" required>
                      <option value="<?php echo $pro_idd ?>"><?php echo $pro_namee ?></option>
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
                <div class="col-md-3">
                  <div class="form-group">
                    <label>District</label>
                    <select name="dist_id" class="form-control select2" id="fetc_dist"
                      onchange="getzone()" required>
                      <option value="<?php echo $d_id ?>"><?php echo $d_name ?></option>
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
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Zone</label>
                    <input type="text" class="form-control" id="zone" value="<?php echo $zone_name ?>" disabled>
                  </div>
                </div>
                <!-- <div class="col-md-3">
                  <div class="form-group">
                    <label>Urban/Rural</label>
                    <select class="form-control" required>
                      <option value="">Choose</option>
                      <option value="Urban">Urban</option>
                      <option value="Rural">Rural</option>
                    </select>
                  </div>
                </div> -->
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Postal Address</label>
                    <textarea class="form-control"
                    name="postaladdress"><?php echo  $postal_address;?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Phone No:(Res.)</label>
                    <input type="phone" class="form-control" name="phone"
                    value="<?php echo  $telephone;?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Mobile(mandatory)</label>
                    <input class="form-control" type="tel" name="contact"
                    data-inputmask="'mask': '9999-9999999'" maxlength="12"
                    placeholder="03XX-XXXXXXX" value="<?php echo  $phone;?>">
                    <span class="text-danger" style="font-size:12px;">(DO NOT give your portable
                      /converted
                    mobile)</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Religion</label>
                    <select class="form-control" name="religion">
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
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Are You a Govt serving employee?</label>
                    <select class="form-control" name="govt" id="emp1" onchange="checkEmpl()">
                      <?php if($gov_employee == NULL OR $gov_employee == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$gov_employee'>$gov_employee</option>"; }
                      ?>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id="exp1">
                  <div class="form-group">
                    <label for="">Total Experience</label>
                    <select type="text" class="form-control select2" name="experince1">
                      <?php if($simple_exper == NULL OR $simple_exper == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$simple_exper'>$simple_exper</option>"; }
                      ?>
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
                    <label for="">Are You retired from Pakistan Armed Forces?</label>
                    <select class="form-control" name="retired" id="emp2" onchange="checkEmpl2()">
                      <?php if($retired_pak == NULL OR $retired_pak == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$retired_pak'>$retired_pak</option>"; }
                      ?>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id="exp2">
                  <div class="form-group">
                    <label for="">Total Experince</label>
                    <select type="text" class="form-control select2" name="experince2">
                      <?php if($army_exper == NULL OR $army_exper == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$army_exper'>$army_exper</option>"; }
                      ?>
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
                      <?php if($widow_gov_emp == NULL OR $widow_gov_emp == '') {
                      // echo "<option value=''>Choose</option>";
                      } else {
                      echo "<option value='$widow_gov_emp'>$widow_gov_emp</option>"; }
                      ?>
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                    <span class="text-danger" style="font-size:12px">(If yes, then attach relevant
                      document
                    concerned department)</span>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Attach File</label>
                    <input type="file" accept="image/*" onchange="showImage3(event)"
                    style="overflow: hidden;" name="widow_file"
                    <?php if($widow_gov_emp == NULL OR $widow_gov_emp == '' OR $widow_gov_emp == 'No') { echo "disabled"; } ?>
                    id="hidden_div3" class="form-control">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group text-center m-1">
                    <img id="log3" class="shadow"
                    style="border: 1px blue solid; border-radius: 10%; margin-top: -4%"
                    width="120px;" height="130px" src="../../images/candidates/death certificate/<?php
                    if($widow_gov_emp == NULL OR $widow_gov_emp == '' OR $widow_gov_emp == 'No')
                    {
                    echo "../../file_icon.png";
                    }
                    else
                    {
                    echo $widow_file;
                    }
                    ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <input type="submit" class="btn btn-success shadow" value="Update"
                  name="saveUser1">
                  <input type="submit" class="btn btn-primary shadow" value="Update & Next"
                  name="saveUser2">
                </div>
              </div>
            </div>
          </form>
          <?php
          if(isset($_POST['saveUser1']) OR isset($_POST['saveUser2']))
          {
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
          $path2    = "../../images/candidates/disability certificate/".$disable_file;
          @unlink($path2);
          $disabl = '';
          }
          else
          {
          if($_FILES['disbl_file']['name'] == '')
          {
          $disabl = $disable_file;
          }
          else
          {
          $disabl = mt_rand().$_FILES['disbl_file']['name'];
          $temp_disabl  = $_FILES['disbl_file']['tmp_name'];
          $disblImg1U    = "../../images/candidates/disability certificate/".$disabl;
          move_uploaded_file($temp_disabl,$disblImg1U);
          $path3    = "../../images/candidates/disability certificate/".$disable_file;
          @unlink($path3);
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
          $path4    = "../../images/candidates/death certificate/".$widow_file;
          @unlink($path4);
          $widow = '';
          }
          else
          {
          if($_FILES['widow_file']['name'] == '')
          {
          $widow = $widow_file;
          }
          else
          {
          $widow = mt_rand().$_FILES['widow_file']['name'];
          $temp_widow  = $_FILES['widow_file']['tmp_name'];
          $widowImg1U    = "../../images/candidates/death certificate/".$widow;
          move_uploaded_file($temp_widow,$widowImg1U);
          $path5    = "../../images/candidates/death certificate/".$widow_file;
          @unlink($path5);
          }
          }
          if($_FILES['logo1']['name'] == '')
          {
          $profImage = $image;
          }
          else
          {
          $profImage = mt_rand().$_FILES['logo1']['name'];
          
          $temp_profImage  = $_FILES['logo1']['tmp_name'];
          $pathImg1U    = "../../images/candidates/profile picture/".$profImage;
          move_uploaded_file($temp_profImage,$pathImg1U);
          $path1    = "../../images/candidates/profile picture/".$image;
          @unlink($path1);
          }
          $update = "UPDATE `candidates` SET `district_id`='$u_d_name',`name`='$u_name',`cnic`='$u_cnic',`email`='$u_email',`phone`='$u_phone',`image`='$profImage',`f_name`='$u_f_name',`gender`='$u_gender',`disability`='$u_disability',`disable_file` ='$disabl',`dob`='$u_dob',`postal_address`='$u_postal_address',`telephone`='$u_telephone',`religion`='$u_religion',`gov_employee`='$u_gov_employee',`simple_exper`='$u_simple_exper',`retired_pak`='$u_retired_pak',`army_exper`='$u_army_exper',`widow_gov_emp`='$widow_gov_emp',`widow_file`='$widow' WHERE id = '$canddate_id'";
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
</script>