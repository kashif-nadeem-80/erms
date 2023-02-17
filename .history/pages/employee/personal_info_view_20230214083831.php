<?php
include "includes/header.php";

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Employee Information</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Employee Information</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
<div class="card card-dark" class="text-center">
          <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark" class="text-center">
          
          <!-- <div class="card-header">
           
          <div class="card-title ">Candidate Details</div>
          </div> -->
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
                $dob = date("d-m-Y",strtotime($rowData['dob']));
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
            <div class="row">
              <div class="col-md-5">
              </div>
              <div class="col-md-7">
                <div class="form-group  mr-3 mt-0 float-right">
                  <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="130px"  src="../../images/candidates/profile picture/<?php
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
              <div class="col-md-3">
                <div class="form-group">
                  <label>Name in Full</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $name;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $f_name;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Candidate CNIC #</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $cnic;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Gender</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $gender;?>">
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
                  <input type="text" class="form-control" disabled value="<?php echo  $disability;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $dob;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $email;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Province Of Domicile</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $pro_namee;?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>District</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $d_name;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Zone</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $zone_name;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Postal Address</label>
                  <textarea class="form-control" disabled><?php echo  $postal_address;?></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Phone No:(Res.)</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $telephone;?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Mobile(mandatory)</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $phone;?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Religion</label>
                  <input type="text" class="form-control" disabled value="<?php echo  $religion;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Are You a Govt serving employee?</label>
                  <input type="text" id="emp1" class="form-control" disabled value="<?php echo  $gov_employee;?>">
                </div>
              </div>
              <div class="col-md-6" id="exp1">
                <div class="form-group">
                  <label for="">Total Experience</label>
                  <input type="text" id="emp1" class="form-control" disabled value="<?php echo  $simple_exper;?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Are You retired from Pakistan Armed Forces?</label>
                  <input type="text" id="emp2" class="form-control" disabled value="<?php echo  $retired_pak;?>">
                </div>
              </div>
              <div class="col-md-6" id="exp2">
                <div class="form-group">
                  <label for="">Total Experince</label>
                  <input type="text" id="emp2" class="form-control" disabled value="<?php echo  $army_exper;?>">
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
                  <input type="text" id="test3" class="form-control" disabled value="<?php echo  $widow_gov_emp;?>">
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include "includes/footer.php"; ?>

<script type="text/javascript">
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