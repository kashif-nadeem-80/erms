<?php
include "includes/header.php";
echo $canddate_id; 
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Dependet Detail</h4>
        <a href="dashboard.php?id=<?php echo $proj_id ?>" class="btn btn-warning mt-3">Back</a>
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
        <h4 class="text-success">Record Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">Error Try Again</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
          <br>
          <?php
          
          // $query = "SELECT ct.id AS ct_id, ct.c_name, p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.f_contact, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.marital_status, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file, c.father_occup FROM `candidates` AS c
          // LEFT JOIN district AS d ON d.id = c.district_id
          // LEFT JOIN zone AS z ON z.id = d.zone_id
          // LEFT JOIN province AS p ON p.id = d.pro_id
          // LEFT  JOIN city AS ct ON ct.id = c.city
          // WHERE c.id = '$canddate_id'";
          // $result = mysqli_query($connection,$query);
          // $rowData = mysqli_fetch_array($result);
          // $ct_id = $rowData['ct_id'];
          // $c_name = $rowData['c_name'];
          // $d_id = $rowData['d_id'];
          // $d_name = $rowData['dis_name'];
          // $f_contact = $rowData['f_contact'];
          // $name = $rowData['name'];
          // $marital_statusU = $rowData['marital_status'];
          // $cnic = $rowData['cnic'];
          // $father_occup = $rowData['father_occup'];
          // $email = $rowData['email'];
          // $phone = $rowData['phone'];
          // $image = $rowData['image'];
          // $f_name = $rowData['f_name'];
          // $gender = $rowData['gender'];
          // $dob = $rowData['dob'];
          // $postal_address = $rowData['postal_address'];
          // $telephone = $rowData['telephone'];
          // $religion = $rowData['religion'];
          // $disability = $rowData['disability'];
          // ?> 
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name in Full</label>
                    <input type="text" name="name" class="form-control" value=""
                    required placeholder="Name in Full">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" name="fathername" placeholder="Father Name"
                    class="form-control" value="" 
                    required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>CNIC / B-Form </label>
                    <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'"
                    placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control"
                    autocomplete="off" required value="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                      <?php if($gender == NULL OR $gender == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      //echo "<option value='$gender'>$gender</option>"; 
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
                    <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" max="<?php echo date('Y-m-d')?>" onchange="getAge()" autocomplete="off" value="" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Age</label>
                    <input type="text" placeholder="Age" name="dep_age" id="agee" class="form-control" readonly>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Relationship</label>
                    <select class="form-control" name="relation" required>
                      <?php if($relationl == NULL OR $relation == '') {
                      echo "<option value=''>Choose</option>";
                      } else {
                      // echo "<option value='$relation'>$relation</option>"; 
                    }
                      ?>
                      <option value="Father">Father</option>
                      <option value="Mother">Mother</option>
                      <option value="Son">Son</option>
                      <option value="Daughter">Daughter</option>
                      <option value="Spouse">Spouse</option>
                    </select>
                  </div>
                </div>

                

                
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Have Any Disability</label>
                    <select class="form-control" name="disability_status" required>
                      <?php if($disability == NULL OR $disability == '') {
                      //echo "<option value=''>Choose</option>";
                      } else {
                      //echo "<option value='$disability'>$disability</option>"; 
                    }
                      ?>
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>
                </div>

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
                 
                </div> -->
                <div class="col-md-11 text-right">
                  <input type="submit" class="btn btn-success shadow" value="Save Record"
                  name="saveUser1" style=" width:170px">
                  <input type="submit" class="btn btn-primary shadow" value="Update & Next"
                  name="saveUser2" style=" width:170px" >
                </div>
                <div class="card-body">
                  <br>
                  <br>

            <?php
              $query2 = "SELECT  * FROM dependents  WHERE emp_id = '$canddate_id' ";
              $runData = mysqli_query($connection,$query2);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
            ?>

              </div>
            </form>
            <div class="row">
              <div class="col-md-14 table-responsive">
                <table class="table table-striped table-bordered bg-white text-center" style="font-size: 14px">
                  <thead class="bg-cyan">
                    <tr>
                      <th>S.No</th>
                      <th>Name in Full</th>
                      <th>Father Name</th>
                      <th>CNIC/B-Form</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Age</th>
                      <th>Relationship</th>
                      <th>Disability</th>
                      
                      <th>Action</th>
                    </tr>
                    <?php
                    $count = 0;
                    
                    while($rowData = mysqli_fetch_array($runData)) {
                      $count++;
                      $id = $rowData['id'];
                      $name  = $rowData['name'];
                      $farthername  = $rowData['f_name'];
                      $cnic = $rowData['cnic'];
                      $gender = $rowData['gender'];
                      $dob  = $rowData['dob'];
                      $age   = $rowData['age'];
                      $relation   = $rowData['relationship'];
                      $disability   = $rowData['disability'];
                                            
                    ?>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $farthername; ?></td>
                       <td><?php echo $cnic;?></td>
                      <td><?php echo $gender;?></td>
                      <td><?php echo $dob; ?></td>
                      <td><?php echo $age; ?></td>
                      <td><?php echo $relation; ?></td>
                      <td><?php echo $disability; ?></td>
                      
                      
                      
                      <td>
                       <input type="hidden" id="dep_cnic<?php echo $count ?>" value="<?php echo $cnic ?>">
                       <!-- <input type="hidden" id="pathImg<?php echo $count ?>" value="<?php echo $pathImg ?>"> -->
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

<?php 
              }
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
            $u_age=  $_POST['dep_age'];
            $u_relation=  $_POST['relation'];
            echo $canddate_id;
            $u_disability=$_POST['disability_status'];
            
            $update ="insert into `dependents` (emp_id, name, cnic, image,f_name, gender, dob,age,
            relationship, disability) values ('$canddate_id','$u_name','$u_cnic','$profImage','$u_f_name',
            '$u_gender','$u_dob','$u_age','$u_relation','$u_disability')" ;

            $run = mysqli_query($connection,$update);
            if($run AND isset($_POST['saveUser1']))
            {
              echo "<!DOCTYPE html>
              <html>
                <body>
                  <script>
                  Swal.fire(
                  'Updated !',
                  'Dependet Information has been added successfully',
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
            elseif ($run AND isset($_POST['saveUser2']))
            {
              echo "<!DOCTYPE html>
              <html>
                <body>
                  <script>
                  Swal.fire(
                  'Updated !',
                  'Dependent Information has been added successfully',
                  'success'
                  ).then((result) => {
                  if (result.isConfirmed) {
                  window.location.href = 'employee_full_info.php';
                  
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

<script type="text/javascript">
  function deleteData(id)
  {
    var dep_cnic = $("#dep_cnic"+id).val();
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
      window.location.href= "dependent_information.php?deletId="+dep_cnic+"&pathImg="+pathImg;
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
  $delete = "DELETE FROM dependents WHERE cnic = '$id'";
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
                 window.location.href = 'dependent_information.php';
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