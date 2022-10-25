<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Registered Candidates</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Candidates List</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content" >
  <div class="container-fluid">

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general Card elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Registered Candidates Details</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
          <!-- Table start -->  
            <table class="table table-striped table-bordered datatable" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>CNIC No</th>
                  <th>Father/Guardian</th>
                  <th>Gender</th>
                  <th>D.O.B</th>
                  <th>Contact</th>
                  <th>Domicile</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $query = "SELECT d.dis_name, c.id, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file FROM `candidates` AS c 
                LEFT JOIN district AS d ON d.id = c.district_id
                LEFT JOIN zone AS z ON z.id = d.zone_id
                LEFT JOIN province AS p ON p.id = d.pro_id
                WHERE c.created_by = '0' ORDER BY c.name ASC";
                $result = mysqli_query($connection,$query);
                while($rowData = mysqli_fetch_array($result))
                {
                  $count++;
                  $id = $rowData['id'];
                  $name = $rowData['name'];
                  $cnic = $rowData['cnic'];
                  $f_name = $rowData['f_name'];
                  $gender = $rowData['gender'];
                  if($rowData['dob'] != '')
                  {
                    $dob = date("d-m-Y",strtotime($rowData['dob']));
                  }
                  else
                  {
                    $dob = "";
                  }
                  
                  $phone = $rowData['phone'];
                  $dis_name = $rowData['dis_name'];
                  $password = $rowData['password'];
                  
                  
                  
                ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $name ?></td>
                  <td><?php echo $cnic ?></td>
                  <td><?php echo $f_name ?></td>
                  <td><?php echo $gender ?></td>
                  <td><?php echo $dob ?></td>
                  <td><?php echo $phone ?></td>
                  <td><?php echo $dis_name ?></td>
                  <td><?php echo $password ?></td>
                  <td> 
                    <a href="registered_users_details.php?id=<?php echo $id ?>" class="btn btn-sm btn-warning shadow title" title="Details"><span><i class="fa fa-eye"></i></span></a>

                    <!-- <a href="user_list.php?u_id=<?php echo $id ?>&path=<?php echo $pathImg ?>" class="btn btn-sm btn-danger shadow" title="Delete" onclick="return confirm('Are you sure you want to delete, the action cannot be undo !')"><span><i class="fa fa-trash-alt"></i></span></a>  -->
                   </td>
                </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


 <?php include "includes/footer.php"; ?>

 <?php 
    // if(isset($_GET['u_id']))
    // {
    //   $id = $_GET['u_id'];
    //   $path = $_GET['path'];
    //   unlink($path);
    //   $delete = "DELETE FROM management_users WHERE id = '$id'";
    //   $run = mysqli_query($connection,$delete);
    //   if($run)
    //   {
    //       echo "<script>window.location.href = 'user_list.php'; </script>";
    //   }
    // }
 ?>