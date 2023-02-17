<?php

include "includes/header.php";
 
//$apply_id = $_GET['apply_id'];
//$proj_id = $_GET['proj_id'];


// echo $canddate_id;
// echo $apply_id;

// echo $proj_id;
?>

<div class="content-header">

  <div class="container-fluid">

    <div class="row mb-2">

      <div class="col-md-6">

        <h4 class="m-0 text-dark">Candidate Information</h4>

        <a href="dashboard.php?id=<?php echo $proj_id ?>" class="btn btn-warning mt-3">Back</a>

      </div>

      <div class="col-md-6">

        <ol class="breadcrumb float-md-right">

          <li class="breadcrumb-item active"><a href="index.php">Home /</a></li>

          <!-- <li class="breadcrumb-item active">...</li> -->

        </ol>

      </div>

    </div>

  </div>

</div>

<section class="content">

  <div class="container-fluid">

    <div class="row">

      <div class="col-md-12">

        <div class="card card-dark">

          <!-- <div class="card-header">

            <div class="card-title">Candidate Details</div>

          </div> -->

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
e.image as p_image, d.district_id as dist_id, d.district as domicile, d.province as province ,
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
$p_image = $rowData['p_image'];
// echo $p_image;
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

          <div class="card-body">

            <div class="row p-0 m-0">

              <div class="col-md-12 text-center text-primary">

                <div class="row">

                  <div class="col-md-12 table-responsive">

                   

                    
                  </div>

                </div>

                <h4>Personal Information</h4>

                <hr class="shadow" style="border: 1px solid #007bff; width: 230px; ">

              </div>

            </div>

            <div class="row">

              <div class="col-md-12 text-right">

                <div class="form-group">

                  <img id="log1" class="shadow"

                  style="border: 1px blue solid; border-radius: 10%; margin-top: -4%"

                  width="120px;" height="130px" src="../../images/candidates/profile picture/<?php

                  if($p_image == NULL OR $p_image == '')

                  {

                  echo "../../file_icon.png";

                  }

                  else

                  {

                  echo $p_image;

                  }

                  ?> " alt="">

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Name in Full</label>

                  <input type="text" name="name" class="form-control" value="<?php echo  $emp_name;?>" disabled placeholder="Name in Full">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Father's Name</label>

                  <input type="text" name="fathername" placeholder="Father Name"

                  class="form-control" value="<?php echo  $f_name;?>" autocomplete="off"

                  disabled>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group"> 

                  <label>Candidate CNIC #</label>

                  <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'"

                  placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control"

                  autocomplete="off" disabled value="<?php echo  $cnic;?>">

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label>Gender</label>

                  <select name="gender" class="form-control" disabled>

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

                  <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" disabled onchange="getAge()" autocomplete="off" value="<?php echo $dob; ?>">

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

                  <select class="form-control" name="marital_status" disabled>

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

                  <select class="form-control" name="religion" disabled>

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

                  <label>Postal Address</label>

                  <textarea class="form-control"

                  name="postaladdress" disabled><?php echo  $postal_address;?></textarea>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>City</label>

                  <select name="city" disabled class="form-control select2" required>

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

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>District</label>

                  <select name="dist_id" class="form-control select2" id="fetc_dist"

                    onchange="getzone()" disabled>

                    <option value="<?php echo $d_id ?>"><?php echo $d_name ?></option>

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

                  <input class="form-control" type="tel" name="contact"

                  data-inputmask="'mask': '9999-9999999'" maxlength="12"

                  placeholder="03XX-XXXXXXX" disabled value="<?php echo  $phone;?>">

                </div>

              </div>



              <div class="col-md-4">

                <div class="form-group">

                  <label>Phone No:(Res.)</label>

                  <input type="phone" disabled class="form-control" name="phone"

                  value="<?php echo  $telephone;?>">

                </div>

              </div>



              <div class="col-md-4">

                <div class="form-group">

                  <label>Email</label>

                  <input type="email" name="email" class="form-control"

                  placeholder="example@gmail.com" disabled autocomplete="off"

                  value="<?php echo  $email;?>" required>

                </div>

              </div>

            </div>

            <hr class="shadow" style="border: 1px solid grey;">

            <div class="row p-0 m-0">

              <div class="col-md-12 text-center text-primary">

                 

                <h4>Dependet Detail</h4>

                <hr class="shadow" style="border: 1px solid #007bff; width: 260px; ">

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

              <div class="col-md-15">

                <table class="table table-striped table-bordered bg-white text-center"

                  style="font-size: 16px">

            
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
                      
                      
                      
                      
                    </tr> 
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


              </div> 
              <!-- dependent detail end  -->

            </div>

            <?php
              }
            

            $fetchData= "SELECT * FROM work_experince WHERE candidate_id = '$canddate_id'";

            $runData = mysqli_query($connection,$fetchData);

            $countRow = mysqli_num_rows($runData);

            if($countRow != 0)

            {

            ?>

            <div class="row">

              <div class="col-md-12">

                <table class="table table-bordered bg-white text-center" style="font-size: 12px">

                  <thead class="bg-gray">

                    <tr>

                      <th>S.No</th>

                      <th>Organization/ Company</th>

                      <th>Job Title(Job Relevent Experince)</th>

                      <th>Date From </th>

                      <th>Date To</th>

                      <th>Pay Package</th>

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

                    $date_froms   = date("d-m-Y", strtotime($rowData['date_from']));

                    $date_tos   = date("d-m-Y", strtotime($rowData['date_to']));

                    $file = $rowData['file'];

                    $pathImg = "../../images/candidates/employee_experince/".$file;

                    $payment = $rowData['payment'];

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

                      <td><?php echo $payment ?></td>

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

                        <a class="Data_Ajax1" data-id="<?php echo $pathImg ?>" href="#edit"

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

getAge();

}

function getAge(){

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

$('.ajaxData1').click(function() {

var disability = $(this).attr('data-id');

$.ajax({

method: 'POST',

url: 'candidate_ajax.php',

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

url: 'candidate_ajax.php',

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

url: 'candidate_ajax.php',

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

url: 'candidate_ajax.php',

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