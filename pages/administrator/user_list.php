<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Management Level Users</h4>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Users List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content" >
  <div class="container-fluid" class="text-center">

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general Card elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Management Level Users Details</div>
            <div class="card-tools">
              <a href="user_add.php" class="btn btn-primary btn-sm shadow">Add New</a>
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
                  <th>Role</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Contact</th>
                  <th>Image</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT u.id,r.role_name,u.name,u.username,u.email,u.password,u.contact,u.image,u.address,u.status FROM management_users AS u LEFT JOIN roles AS r ON r.id = u.role_id ORDER BY u.id DESC";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
                $name       = $rowData['name'];
                $role       = $rowData['role_name'];
                $username   = $rowData['username'];
                $email      = $rowData['email'];
                $password   = $rowData['password'];
                $contact    = $rowData['contact'];
                $image      = $rowData['image'];
                $pathImg    = "../../images/admin/management_users/".$image;
                $address    = $rowData['address'];
                $status1     = $rowData['status'];
                if($status1 == '1')
                {
                  $status = 'Approved';
                }
                else
                {
                  $status = 'Not Approved';
                }

              ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $name ?></td>
                  <td><?php echo $role ?></td>
                  <td><?php echo $username ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $password ?></td>
                  <td><?php echo $contact ?></td>
                  <td>
                    <?php
                    if($image != '')
                      { ?>
                    <img src="<?php echo $pathImg ?>" width="70px" height="70px" style="border-radius: 10%" >
                  <?php }
                  else
                  {
                    echo "Image Not Uploaded";
                  }
                  ?>
                  </td>
                  <td><?php echo $address ?></td>
                  <td><?php echo $status ?></td>
                  <td> 
                    <a href="user_edit.php?user_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                    <!-- <a href="user_list.php?u_id=<?php echo $id ?>&path=<?php echo $pathImg ?>" class="btn btn-sm btn-danger shadow" title="Delete" onclick="return confirm('Are you sure you want to delete, the action cannot be undo !')"><span><i class="fa fa-trash-alt"></i></span></a>  -->
                   </td>
                </tr>
              <?php }?>
              </tbody>
            </table>
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