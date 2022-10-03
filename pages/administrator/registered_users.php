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

<section class="content">
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
            <table class="table table-striped table-bordered datatable text-center" style="font-size: 12px" >
              <thead class="bg-dark" >
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
                  <th>Email Verfication</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                $query = "SELECT d.dis_name, c.id, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file,c.status FROM `candidates` AS c 
                LEFT JOIN district AS d ON d.id = c.district_id
                LEFT JOIN zone AS z ON z.id = d.zone_id
                LEFT JOIN province AS p ON p.id = d.pro_id
                WHERE c.created_by = '0' ORDER BY c.name ASC";
                $result = mysqli_query($connection, $query);
                while ($rowData = mysqli_fetch_array($result)) {
                  $count++;
                  $id = $rowData['id'];
                  $name = $rowData['name'];
                  $cnic = $rowData['cnic'];
                  $f_name = $rowData['f_name'];
                  $gender = $rowData['gender'];
                  if ($rowData['dob'] != '') {
                    $dob = date("d-m-Y", strtotime($rowData['dob']));
                  } else {
                    $dob = "";
                  }

                  $phone = $rowData['phone'];
                  $dis_name = $rowData['dis_name'];
                  $password = $rowData['password'];
                  $status = $rowData['status'];
                  $status = $rowData['status'];
                  $pathImg = "../../images/candidates/profile picture/"
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
                        <?php
                        if($status == 1)
                        {
                            echo "<i class='fa fa-check text-success'></i> Verified";
                        }
                        else
                        {
                            echo "<i class='fa fa-times text-danger'></i> Not Verified";
                        }
                        ?>
                    </td>
                    <td width="10%">
                      <a href="registered_users_details.php?id=<?php echo $id ?>" class="btn btn-xs btn-warning shadow title" title="Details"><span><i class="fa fa-plus"></i></span></a>

                      <a style="margin-top:3px" href="registered_user_update.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                      <a href="registered_add_education.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-primary title shadow" style="margin-top: 2px" title="Add Education"><span><i class="fa fa-plus"></i></span></a>

                      <a href="registered_add_experience.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-success title shadow" style="margin-top: 2px" title="Add Experience"><span><i class="fa fa-plus"></i></span></a>

                      <a onclick="deleteData(<?php echo $id ?>)" class="btn btn-xs btn-danger title shadow" style="margin-top: 2px" title="Delete"><span><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include "includes/footer.php"; ?>




<script>
function deleteData(id)
{
  var deg_id = $("#deg_id"+id).val();
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
      window.location.href= "registered_users.php?deletId="+deg_id;
    }
});

}
</script>


<?php
  if(isset($_GET['deletId']))
  {
    $id = $_GET['deletId'];
    $delete = "DELETE FROM edu_level WHERE id = '$id'";
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
             window.location.href = 'registered_users.php';
          }
        });
        </script>
        </body>
      </html>";
    }
  }
  ?>