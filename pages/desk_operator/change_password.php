<?php
include "includes/header.php";
?>

  <div class="content-wrapper" style="    margin-left: 0px !important;">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="font-family: Time New Roman"><span class="text-success">C</span>HANGE <span class="text-success">P</span>ASSWORD
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <center>
          <h4 id="o_pass" style="display: none; color: red">Old password is not correct</h4>
          <h4 id="c_paas" style="display: none; color: red">New & confirm password not match</h4>
          <h4 id="succ" style="display: none; color: green">Password changed succcessfully</h4>
        </center>

        <div class="row">
          <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <div class="card-title">Change Password</div>
              </div>
              <div class="card-body">
                <form method="post">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Old Password</label>

                        <input type="password" name="oldPass" class="form-control" placeholder="Old Password" id="pass" onkeyup="ajaxCall()" required>

                        <p id="true" style="display: none; color: green"><b>Password is match</b></p>
                        <p id="false" style="display: none; color: red"><b>Password is no match</b></p>
                      </div>
                      
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="newPass" id="npass" class="form-control" placeholder="New Password" required>
                      </div>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPass" id="cpass" class="form-control" placeholder="Confirm Password" onkeyup="confirmPassword()" required>
                      </div>
                      <p id="match" style="display: none; color: green"><b>New & Confirm password match</b></p>
                      <p id="notMatch" style="display: none; color: red"><b>New & Confirm password not match</b></p>
                    </div>
                    <div class="col-md-4"></div>
                  </div><br>
                  <div class="row">
                    <div class="col-md-12">
                      <center><input type="submit" class="btn btn-success" name="update" value="Change"></center>
                    </div>
                  </div>
                </form>
                <?php
                  if(isset($_POST['update']))
                  {
                    $oldPass = $_POST['oldPass'];
                    $newPass = $_POST['newPass'];
                    $confirmPass = $_POST['confirmPass'];

                    $userID = $_SESSION['deskOperator'];
                    $query = "SELECT * FROM management_users WHERE id = '$userID'";
                    $run_query = mysqli_query($connection,$query);
                    $row_rec = mysqli_fetch_array($run_query);

                    $userPaswsord = $row_rec['password'];
                    if($userPaswsord == $oldPass)
                    {
                      if($newPass == $confirmPass)
                      {
                        $updatePass = "UPDATE management_users SET password = '$newPass' WHERE id = '$userID'";
                        $run_pass = mysqli_query($connection,$updatePass);
                        if($run_pass) {
                        echo "<script>
                          document.getElementById('o_pass').style.display = 'none';
                          document.getElementById('c_paas').style.display = 'none';
                          document.getElementById('succ').style.display = 'block';
                        </script>";
                        }
                        else {
                          echo "<center><b>Some error ocuure cannot update<b></center>";
                        }
                      }
                      else
                      {
                        echo "<script>
                          document.getElementById('o_pass').style.display = 'none';
                          document.getElementById('succ').style.display = 'none';
                          document.getElementById('c_paas').style.display = 'block';
                          
                        </script>";
                      }
                    }
                    else
                    {
                      echo "<script>
                          
                          document.getElementById('succ').style.display = 'none';
                          document.getElementById('c_paas').style.display = 'none';
                          document.getElementById('o_pass').style.display = 'block';
                          
                        </script>";
                    }
                  }

                ?>

              </div>
            </div>
            <!-- Card End -->
          </div>
          
        </div>
      </div>
    </section>
    
  </div>

</div>


<!-- REQUIRED SCRIPTS -->
<?php include "includes/footer.php"; ?>

<script type="text/javascript">
  function ajaxCall(){
  var oldPass = $('#pass').val();
  $.ajax({
    method:'POST',
    url:'checkPassword.php',
    data: {
        oldPass: oldPass
    },
    success:function(result){
      if(result == 1)
      {
        document.getElementById('pass').style.border = '2px solid green';
        document.getElementById('false').style.display = 'none';
        document.getElementById('true').style.display = 'block';
      }
      else
      {
        document.getElementById('pass').style.border = '2px solid red';
        document.getElementById('true').style.display = 'none';
        document.getElementById('false').style.display = 'block';
      }
  }
  });
}

function confirmPassword(){
  var npass = $('#npass').val();
  var cpass = $('#cpass').val();

  if(npass == cpass)
  {
    document.getElementById('cpass').style.border = '2px solid green';
    document.getElementById('notMatch').style.display = 'none';
    document.getElementById('match').style.display = 'block';
  }
  else
  {
    document.getElementById('cpass').style.border = '2px solid red';
    document.getElementById('match').style.display = 'none';
    document.getElementById('notMatch').style.display = 'block';
  }
}
</script>