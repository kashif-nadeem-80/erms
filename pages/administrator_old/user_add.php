<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add Management Level Users</h4>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Add Management Level Users</li>
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
                <center id="succ" style="display: none">
                <h4 class="text-success">User Added Successfully</h4>
                </center>
                <center id="err" style="display: none">
                <h4 class="text-danger">User Not Added</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Add New Management Level Users</div>
                    <div class="card-tools">
                      <a href="user_list.php" class="btn btn-primary btn-sm shadow">User's List</a>
                    </div>
                  </div>
                  <br>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <label>Role</label>
                            <select class="form-control" autocomplete="off" required name="role_idd">
                              <option value="">-- Select Role --</option>
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
                          <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="namee" placeholder="Name" class="form-control" autocomplete="off" required>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-md-6">
                            <label>Username</label>
                            <input type="text" name="usernamee" id="username" onchange="ajaxCall1()" placeholder="username" class="form-control" autocomplete="off" required>
                            <p id="false" style="display: none; color: red">This username already taken</p>
                          </div>
                          <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" id="email" name="emaill" onchange="ajaxCall2()" placeholder="Email" class="form-control" autocomplete="off" required>
                            <p id="false1" style="display: none; color: red">This email already taken</p>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="passwordd" placeholder="Password" class="form-control" autocomplete="off" required>
                          </div>
                          <div class="col-md-6">
                            <label>Contact</label>
                            <input type="text" name="contactt" placeholder="Contact" class="form-control" autocomplete="off" required>
                          </div>
                          
                        </div><br>
                        <div class="row">
                          <div class="col-md-4">
                            <label>Image</label>
                            <input type="file" name="imagg" class="form-control" id="file1" accept="image/*" onchange="showImage1(event);" autocomplete="off" style="overflow: hidden;" required>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group text-center">
                              <img id="log1" class="shadow " style="border: 1px blue solid; border-radius: 10%; " width="120px;" height="130px" src="../../images/file_icon.png" alt="">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label>Address</label>
                            <textarea placeholder="Address"  name="address" class="form-control"></textarea>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-md-12">
                            <center>
                            <input type="submit" class="btn btn-success shadow" value="Add" name="saveUser">
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
                      $userImage = '';
                    }
                    else
                    {
                      $userImage = mt_rand().$image;
                    }
                    $pathImg    = "../../images/admin/management_users/".$userImage;
                    $insert = "INSERT INTO `management_users`(`role_id`, `status`, `name`, `username`, `email`, `password`, `contact`, `image`, `address`, `signupdate`) VALUES ('$role_idd','1','$namee','$usernamee','$emaill','$passwordd','$contactt','$userImage','$address','$date')";
                    $run = mysqli_query($connection,$insert);
                    if($run)
                    {
                      echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Added !',
                                'Mangement User has been added successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                  window.location.href= 'user_list.php';
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
                                  'Mangement User not add, Some error occure',
                                  'error'
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
        function ajaxCall1(){
          var user = $('#username').val();
          $.ajax({
            method:'POST',
            url:'user_add_ajax.php',
            data: {
                user: user
              },
          success:function(result){
              if(result == 0)
              {
                document.getElementById('false').style.display = 'none';
              }
              else
              {
                document.getElementById('false').style.display = 'block';
                document.getElementById('username').value = '';
              }
          }
        }).done(function(){
          setTimeout(function() {
            document.getElementById('false').style.display = 'none';
          }, 3000);
        });
        }

        ///////////////////
        function ajaxCall2(){
          var email = $('#email').val();
          $.ajax({
            method:'POST',
            url:'user_add_ajax.php',
            data: {
                email: email
              },
          success:function(data){
            if(data == 0)
            {
              document.getElementById('false1').style.display = 'none';
            }
            else
            {
              document.getElementById('false1').style.display = 'block';
              document.getElementById('email').value = '';

            }
          }
        }).done(function(){
          setTimeout(function() {
            document.getElementById('false1').style.display = 'none';
          }, 3000);
        });
        }
        </script>