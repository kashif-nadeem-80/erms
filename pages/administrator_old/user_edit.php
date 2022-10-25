<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Edit Users</h4>
        <div class="row">
          <a href="user_list.php" class="mt-4 btn btn-warning shadow">Back</a>
        </div>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Edit Users</li>
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
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Edit Users</div>
            <div class="card-tools">
              <a href="user_list.php" class="btn btn-primary btn-sm shadow">User's List</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
              $userId = $_GET['user_id'];
              $fetchData= "SELECT r.id,r.role_name,u.name,u.username,u.email,u.password,u.contact,u.image,u.address,u.status FROM management_users AS u LEFT JOIN roles AS r ON r.id = u.role_id WHERE u.id = '$userId'";
              $runData = mysqli_query($connection,$fetchData);
              $rowData = mysqli_fetch_array($runData);

                $nameU       = $rowData['name'];
                $roleU       = $rowData['role_name'];
                $roleId       = $rowData['id'];
                $usernameU   = $rowData['username'];
                $emailU      = $rowData['email'];
                $passwordU   = $rowData['password'];
                $contactU    = $rowData['contact'];
                $imageU      = $rowData['image'];
                $pathImgU    = "../../images/admin/management_users/".$imageU;
                $addressU    = $rowData['address'];
                $status1U    = $rowData['status'];
                if($status1U == '1')
                {
                  $statusU = 'Approved';
                }
                else
                {
                  $statusU = 'Not Approve';
                }

            ?>
          <!-- form start -->
          <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <label>Role</label>
                  <select class="form-control select2" required name="role_idd">
                    <option value="<?php echo $roleId ?>"><?php echo $roleU ?></option>
                    <?php
                    $data = "SELECT * FROM roles";
                    $run = mysqli_query($connection,$data);
                    while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $role = $row['role_name'];
                    echo "<option value='$id'>$role</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Name</label>
                  <input type="text" name="namee" placeholder="Name" class="form-control" autocomplete="off" value="<?php echo $nameU ?>" required>
                </div>
                <div class="col-md-4">
                  <label>Status</label>
                  <select class="form-control select2" required name="status">
                    <option value="<?php echo $status1U ?>"><?php echo $statusU ?></option>
                    <option value="1">Approve</option>
                    <option value="0">Disapprove</option>
                  </select>
                </div>
              </div><br>
              <div class="row">
                <div class="col-md-4">
                  <label>Username</label>
                  <input type="text" name="usernamee" placeholder="username" class="form-control" autocomplete="off" value="<?php echo $usernameU ?>" required>
                </div>
                <div class="col-md-4">
                  <label>Email</label>
                  <input type="email" name="emaill" placeholder="Email" class="form-control" autocomplete="off" value="<?php echo $emailU ?>" required>
                </div>
                <div class="col-md-4">
                  <label>Password</label>
                  <input type="text" name="passwordd" placeholder="Password" class="form-control" autocomplete="off" value="<?php echo $passwordU ?>" required>
                </div>
              </div><br>
              <div class="row">
                
                <div class="col-md-4">
                  <label>Contact</label>
                  <input type="text" name="contactt" placeholder="Contact" class="form-control" autocomplete="off" value="<?php echo $contactU ?>" required>
                </div>
                <div class="col-md-4">
                  <label>Image</label>
                  <input type="file" name="imagg" accept="image/*" class="form-control" id="file1" onchange="showImage1(event);" style="overflow: hidden;" autocomplete="off">
                </div>
                <div class="col-md-4">
                  <div class="form-group text-center">
                    <img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="100px" src="<?php
                    if($imageU == NULL OR $imageU == '')
                    { 
                      echo "../../images/file_icon.png";
                    }
                    else
                    {
                      echo $pathImgU;
                    } 
                    ?>" style="height:50px">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label>Address</label>
                  <textarea placeholder="Address" name="address" class="form-control"><?php echo $addressU ?></textarea>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <input type="submit" class="btn btn-success shadow" value="Update" name="saveUser">
                    <a href="user_list.php" class="btn btn-danger shadow">Cancel</a>
                  </center>
                </div>
              </div>
            </div>
          </form>
          <?php
          if(isset($_POST['saveUser']))
          {
            $role_idd   = $_POST['role_idd'];
            $namee      = $_POST['namee'];
            $status     = $_POST['status'];
            $usernamee  = $_POST['usernamee'];
            $emaill     = $_POST['emaill'];
            $passwordd  = $_POST['passwordd'];
            $address    = $_POST['address'];
            $contactt   = $_POST['contactt'];
            $email      = $_POST['emaill'];
            $date       = date('Y-m-d');
            $image      = $_FILES['imagg']['name'];
            $temp_img   = $_FILES['imagg']['tmp_name'];

            if($image == '')
            {
              $userImage = $imageU;
            }
            else
            {
              $userImage = mt_rand().$image;
              unlink($pathImgU);
              $pathImg    = "../../images/admin/management_users/".$userImage;
              move_uploaded_file($temp_img,$pathImg);
            }
            

            $update = "UPDATE `management_users` SET `role_id` ='$role_idd', `status` = '$status', `name` = '$namee', `username` = '$usernamee', `email` = '$emaill', `password` = '$passwordd', `contact` = '$contactt', `image` = '$userImage', `address` = '$address' WHERE id = '$userId'";
            $run = mysqli_query($connection,$update);
            if($run)
            {
              echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Updated !',
                        'Management User has been Updated successfully',
                        'success'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'user_list.php';
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
    if (uploadField.files[0].size > 150000) {
      Swal.fire(
                'Error !',
                'File is too big! Upload File under 150kB !',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                    uploadField.value = "";
                }
              });
    } else {
      var logoId = document.getElementById('log1');
      logoId.src = URL.createObjectURL(event.target.files[0]);
    }
    }
 </script>