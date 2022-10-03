<?php
include "includes/db.php";

if(isset($_POST['candId']))
{
  $canddate_id = $_POST['candId'];
?>
<div class="row">
  <div class="col-md-12">

    <hr class="shadow" style="border: 1px solid grey;">

  <!-- Personal Information start -->
    <?php
      $query = "SELECT ct.id AS ct_id, ct.c_name, d.id AS d_id,d.dis_name, c.f_contact, c.name, c.cnic, c.email, c.phone, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper, c.widow_gov_emp, c.id FROM `candidates` AS c
      LEFT JOIN district AS d ON d.id = c.district_id
      LEFT  JOIN city AS ct ON ct.id = c.city
      WHERE c.id = '$canddate_id'";
      $result = mysqli_query($connection,$query);
      $rowData = mysqli_fetch_array($result);
      $ct_id = $rowData['ct_id'];
      $c_name = $rowData['c_name'];
      $d_id = $rowData['d_id'];
      $d_name = $rowData['dis_name'];
      $disability = $rowData['disability'];
      $name = $rowData['name'];
      $cnic = $rowData['cnic'];
      $email = $rowData['email'];
      $phone = $rowData['phone'];
      $f_name = $rowData['f_name'];
      $gender = $rowData['gender'];
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
    
    <div class="row p-0 m-0">
      <div class="col-md-12 text-center text-primary">
        <h4>Personal Information</h4>
        <hr class="shadow" style="border: 1px solid #007bff; width: 230px; ">
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
          <label>Have You any disability?</label>
          <input type="text" class="form-control" disabled value="<?php echo  $disability;?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Date of Birth</label>
          <input type="date" name="dob" id="d_o_b2" placeholder="dob" class="form-control" disabled autocomplete="off" value="<?php echo $dob; ?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Age</label>
          <input type="text" placeholder="Age" id="agee2" class="form-control" disabled>
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
          <select name="city" disabled class="form-control" required>
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
      <div class="col-md-3">
        <div class="form-group">
          <label>District</label>
          <select name="dist_id" class="form-control"
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
      <div class="col-md-3">
        <div class="form-group">
          <label>Phone No:(Res.)</label>
          <input type="phone" disabled class="form-control" name="phone"
          value="<?php echo  $telephone;?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Mobile</label>
          <input class="form-control" type="tel" name="contact"
          data-inputmask="'mask': '9999-9999999'" maxlength="12"
          placeholder="03XX-XXXXXXX" disabled value="<?php echo  $phone;?>">
        </div>
      </div>
      <div class="col-md-3">
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
      <div class="col-md-6">
        <div class="form-group">
          <label for="">Are You a Govt serving employee?</label>
          <input type="text" id="emp1" class="form-control" disabled
          value="<?php echo $gov_employee;?>">
        </div>
      </div>
      <div class="col-md-6 <?php if($gov_employee == 'Yes') {echo "d-block";} else{ echo "d-none"; } ?>">
        <div class="form-group">
          <label for="">Total Experience</label>
          <input type="text" id="emp1" class="form-control" disabled
          value="<?php echo  $simple_exper;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="">Are You retired from Pakistan Armed Forces?</label>
          <input type="text" id="emp2" class="form-control" disabled
          value="<?php echo  $retired_pak;?>">
        </div>
      </div>
      <div class="col-md-6 <?php if($retired_pak == 'Yes') {echo "d-block";} else{ echo "d-none"; } ?>" id="exp2">
        <div class="form-group">
          <label for="">Total Experince</label>
          <input type="text" id="emp2" class="form-control" disabled
          value="<?php echo  $army_exper;?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Widow/Son/Daughter of deceased Govt Employee?</label>
          <input type="text" id="test3" class="form-control" disabled
          value="<?php echo  $widow_gov_emp;?>">
        </div>
      </div>
      
    </div>
  <!-- Personal Information end -->

    <hr class="shadow" style="border: 1px solid grey;">

  <!-- Educatinal Information start -->
    <div class="row p-0 m-0">
      <div class="col-md-12 text-center text-primary">
        <h4>Education's Information</h4>
        <hr class="shadow" style="border: 1px solid #007bff; width: 250px; ">
      </div>
    </div>
    <?php
    $query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, e.percentage, e.division, e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$canddate_id' ORDER BY e.id ASC";
    $runData = mysqli_query($connection,$query2);
    $countRow = mysqli_num_rows($runData);
    if($countRow != 0)
    {
    ?>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered bg-white text-center"
          style="font-size: 12px">
          <thead class="bg-dark">
            <tr>
              <th>S.No</th>
              <th>Degree Name</th>
              <th>Degree Title</th>
              <th>Year Passing</th>
              <th>Major Subject</th>
              <th>Total Marks/CGPA</th>
              <th>Obtained Marks</th>
              <th>Percentage</th>
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
            $obt_marks  = $rowData['obtain_marks'];
            $tot_marks   = $rowData['total_marks'];
            $major_subject = $rowData['major_subject'];
            $Board1   = $rowData['university'];
            $certificate = $rowData['deg_image'];
            $pathImg    = "../../images/candidates/education/".$certificate;
            $percentage   = $rowData['percentage'];
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
                  else { echo $percentage." %"; } ?> 
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
  <!-- Educatinal Information end -->

    <hr class="shadow" style="border: 1px solid grey;">

  <!-- Experience Information start -->
    <div class="row p-0 m-0">
      <div class="col-md-12 text-center text-primary">
        <h4>Experience's Information</h4>
        <hr class="shadow" style="border: 1px solid #007bff; width: 260px; ">
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
      <div class="col-md-12">
        <table class="table table-bordered bg-white text-center" style="font-size: 12px">
          <thead class="bg-dark">
            <tr>
              <th>S.No</th>
              <th>Organization/ Company</th>
              <th>Job Title(Job Relevent Experince)</th>
              <th>Date From </th>
              <th>Date To</th>
              <th>Duration</th>
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
            $total_exp  = $rowData['total_exp'];
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
  <!-- Experience Information start -->

  </div>
</div>
<?php } ?>