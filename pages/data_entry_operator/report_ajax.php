<?php
include "includes/db.php";
session_start();
$dataEntryId = $_SESSION['DataEntryOperator'];

if(isset($_POST['projId_allPost']))
{
  $projId = $_POST['projId_allPost'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  echo "<option value='all'>All</option>";
  while ($row = mysqli_fetch_array($run))
  {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];
    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}

if(isset($_POST['proj_id']) AND isset($_POST['postId']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];

?>
<table class="table table-hover table-bordered datatable bg-white" style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark">
    <tr>
      <th width="6%">S.No</th>
      <th>Reg No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.reg_no FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE p.id = '$proj_id' AND cp.operator_id = '$dataEntryId' AND (cp.post_id = '$postId' OR 'all' = '$postId') AND (ct.id = '$city_id' OR 'all' = '$city_id') ORDER BY pp.post_name, ct.c_name, c.name ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $reg_no = $rowQ['reg_no'];
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
        <input type="hidden" id="autoInc<?php echo $count ?>" value="<?php echo $count ?>">
        <input type="hidden" id="applyId<?php echo $count ?>" value="<?php echo $applyId ?>">
        <input type="hidden" id="cand_id<?php echo $count ?>" value="<?php echo $cand_id ?>">
        <input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $rowQ['image'] ?>">
      </td>
      <td><?php echo $reg_no ?></td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <td>
        <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php }



//////////Candidate Picture///////////////
if(isset($_POST['pic_name']))
{
?>
<div class="modal-header bg-dark">
  <h5 class="modal-title">Candidate's Picture</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $pic_name = $_POST['pic_name'];
  $path = "../../images/candidates/profile picture/".$_POST['pic_name'];
?>
<div class="modal-body">
  <div class="row text-center">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "98%" height="350px">
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<?php }



if(isset($_POST['applicant_id']))
{
  $canddate_id1 = $_POST['applicant_id'];
?>
<div class="modal-header bg-dark">
  <h4 class="modal-title">Applicant's Details</h4>
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span></button>
</div>
<div class="modal-body" style="padding: 0px !important;">
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-dark" class="text-center">
        <br>
          <?php
          
          $query = "SELECT ct.id AS ct_id, ct.c_name, p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.f_contact, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.marital_status, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file, c.father_occup FROM `candidates` AS c
          LEFT JOIN district AS d ON d.id = c.district_id
          LEFT JOIN zone AS z ON z.id = d.zone_id
          LEFT JOIN province AS p ON p.id = d.pro_id
          LEFT  JOIN city AS ct ON ct.id = c.city
          WHERE c.id = '$canddate_id1'";
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
          ?>
        <div class="card-body">
          <div class="row p-0 m-0">
            <div class="col-md-12 text-center text-primary">
              <h3>Personal Information</h3>
              <hr class="shadow" style="border: 1px solid #007bff; width: 250px; ">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Name in Full</label>
                <input type="text" name="name" class="form-control" value="<?php echo  $name;?>" disabled placeholder="Name in Full">
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
                <input type="date" name="dob" id="d_o_b" placeholder="dob" class="form-control" disabled onchange="getAge()" autocomplete="off" value="<?php echo  $dob;?>">
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
                <label>Father's Occupation</label>
                <input type="text" name="f_occupation" disabled class="form-control"
                placeholder="Father's Occupation" value="<?php echo  $father_occup; ?>" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Father's Contact</label>
                <input class="form-control" type="tel" name="f_contact"
                data-inputmask="'mask': '9999-9999999'" disabled maxlength="12"
                placeholder="03XX-XXXXXXX" value="<?php echo $f_contact;?>">
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
                <label>Other Contact</label>
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
              <h3>Education's Information</h3>
              <hr class="shadow" style="border: 1px solid #007bff; width: 290px; ">
            </div>
          </div>

          <?php
            $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.percentage, e.division, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$canddate_id1' ORDER BY e.id ASC";
            $runData = mysqli_query($connection,$query2);
            $countRow = mysqli_num_rows($runData);
            if($countRow != 0)
            {
          ?>
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table class="table table-bordered text-center" style="font-size: 12px">
                <thead class="bg-dark">
                  <tr>
                    <th>S.No</th>
                    <th>Degree Name</th>
                    <th>Degree Title</th>
                    <th>Year Passing</th>
                    <th>Major Subject</th>
                    <th>Total Marks/CGPA</th>
                    <th>Obtained Marks</th>
                    <th>Percentage/Division</th>
                    <th>University/Board</th>
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
                  $percentage   = $rowData['percentage'];
                  $division   = $rowData['division'];
                  ?>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $level1; ?></td>
                    <td><?php echo $degree1; ?></td>
                    <td><?php echo $pas_year;?></td>
                    <td><?php echo $major_subject;?></td>
                    <td><?php echo $tot_marks; ?></td>
                    <td><?php echo $obt_marks; ?></td>
                    <td>
                      <?php if($percentage == 'Inprogress') { echo 'Inprogress'; }
                        else { echo $percentage."% <b>/</b> ".$division; } ?> 
                    </td>
                    <td><?php echo $Board1; ?></td>
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
          
            $fetchData= "SELECT * FROM work_experince WHERE candidate_id = '$canddate_id1'";
            $runData = mysqli_query($connection,$fetchData);
            $countRow = mysqli_num_rows($runData);
            if($countRow != 0)
            {
          ?>

          <div class="row">
            <div class="col-md-12 table-responsive">
              <table class="table table-bordered text-center" style="font-size: 12px">
                <thead class="bg-dark">
                  <tr>
                    <th>S.No</th>
                    <th>Organization/ Company</th>
                    <th>Job Title(Job Relevent Experince)</th>
                    <th>Date From </th>
                    <th>Date To</th>
                    <th>Duration</th>
                    <th>Pay Package</th>
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
                  $total_exp  = $rowData['total_exp'];
                  $date_froms   = date("d-m-Y",strtotime($rowData['date_from']));
                  if($rowData['date_to'] == '0000-00-00')
                  {
                    $date_tos = "Continue";
                  }
                  else
                  {
                    $date_tos   = date("d-m-Y",strtotime($rowData['date_to']));
                  }
                  $payment = $rowData['payment'];
                  ?>
                  <tr>
                    <td><?php echo $count ?></td>
                    <td><?php echo $names ?></td>
                    <td><?php echo $jobs ?></td>
                    <td><?php echo $date_froms ?></td>
                    <td><?php echo $date_tos ?></td>
                    <td><?php echo $total_exp ?></td>
                    <td><?php echo $payment ?></td>
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
        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

  $('.ajaxData1').click(function(){
    var disability = $(this).attr('data-id');
    $.ajax({
      method:'POST',
      url:'pic_view_ajax.php',
      data: {
          disability: disability
      },
      datatype: "html",
      success:function(result){
        $(".modal-content1").html(result);
    }
    });
  });
  getAge();
  function getAge()
  {
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

  $('.ajaxData2').click(function(){
    var widow_file = $(this).attr('data-id');
    $.ajax({
      method:'POST',
      url:'pic_view_ajax.php',
      data: {
          widow_file: widow_file
      },
      datatype: "html",
      success:function(result){
        $(".modal-content1").html(result);
    }
    });
  });
</script>
<script type="text/javascript">
  $('.Data_Ajax5').click(function() {
    var std_image1 = $(this).attr('data-id');
  $.ajax({
    method: 'POST',
    url: 'pic_view_ajax.php',
    data: {
        edu_image1: std_image1
    },
    datatype: "html",
    success: function(result) {
    $(".modal-content1").html(result);
    }
    });
  });
</script>
<script type="text/javascript">
  $('.Data_Ajax4').click(function() {
    var std_image1 = $(this).attr('data-id');
    $.ajax({
      method: 'POST',
      url: 'pic_view_ajax.php',
      data: {
            std_image1: std_image1
       },
    datatype: "html",
    success: function(result) {
    $(".modal-content1").html(result);
    }
    });
  });
</script>

<?php } ?>