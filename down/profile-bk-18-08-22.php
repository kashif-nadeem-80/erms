<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['pbs_cand'])) {
    ?>
    <script>
        location.href = 'index.php';
    </script>
    <?php
}
include('header.php');
$candidateID = $_SESSION['pbs_cand'];
$imageError = false;
$errorMessage = '';
$error = false;
$success = false;
if (isset($_POST["update"]))
{
    $maxFileSize = 500;
    $name = $_POST["name"];
    $f_name = $_POST["fname"];
    $cnic = $_POST["cand_cnic"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $postal_address = $_POST["postal_address"];
    $phone = $_POST["phone"];
    $cand_image = $_FILES["cand_image"]['name'];
    $ext = pathinfo($cand_image, PATHINFO_EXTENSION);
    $image_exist = $_POST['image_exist'];
    if($cand_image != '') {
        $sizeKB = round($_FILES['cand_image']['size']/1024);
        if($sizeKB > $maxFileSize) {
            $imageError = true;
            $errorMessage = 'File too large. Maximum allowed size is 500Kb';
        }
        if(!in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
            $imageError = true;
            $errorMessage = 'Please upload a valid picture (png, jpg or jpeg).';
        }
        if (!$imageError) {
            $newFileName = $candidateID . '-' . time() . '.' . $ext;
            $targetPath = '../images/candidates/profile picture/' . $newFileName;
            move_uploaded_file($_FILES['cand_image']['tmp_name'], $targetPath);
        }
    } else {
        $newFileName = $image_exist;
    }
    if(!$imageError) {
        $candUpdate = "UPDATE candidates SET image='$newFileName' 
                        WHERE id='$candidateID'";
        $upateQ = mysqli_query($connection, $candUpdate) or die(mysqli_error($connection));
        $city = $_POST['city'];
        $updateCitySql = "Update candidate_applied_post SET city_id='$city' where candidate_id='$candidateID'";
        mysqli_query($connection, $updateCitySql);
        $success = true;


    }

}
$userSql = "SELECT c.*, cap.city_id from candidates AS c LEFT JOIN candidate_applied_post AS cap ON c.id=cap.candidate_id WHERE c.id='$candidateID'";
$userQ = mysqli_query($connection, $userSql);
if(mysqli_num_rows($userQ) == 0) {
    ?>
    <script>
        location.href = 'index.php';
    </script>
    <?php
}
$userRes = mysqli_fetch_assoc($userQ);
?>

<body style="background: #e6e6e6; overflow-x: hidden;">
<div class="row bg-white">
    <div class="col-md-1"></div>
    <div class="col-md-1" class="hidden-md-down">
        <img src="../images/logo.png" width="70px" height="70px">
    </div>
    <div class="col-md-10 text-center"
         style="margin-top: 1%; text-shadow: 0 0 2px #0000FF; font-family: time new roman">
        <h3>Universal Testing Services</h3>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <p style="margin-top: -10px; margin-bottom: 40px"><strong>User Detail</strong></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="upload-challan.php" class="">Upload Challan</a> |
                        <a href="challans.php" class="">Download Challan</a> |
                        <a href="profile.php" class="">Profile</a>
                    </div>
                    </div>
                    <form method="post" id="register_form" enctype="multipart/form-data">
                        <?php
                        if($imageError) {
                        ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span class='text-danger'><center><b><?php echo $errorMessage;?> </b></center></span>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if($success) {
                            ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span class='text-success'><center><b>Your information has been updated successfully. </b></center></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if($error) {
                            ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span class='text-danger'><center><b>Unable to update your information. </b></center></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" readonly value="<?php echo $userRes['name'];?>" class="form-control shadow" placeholder="Full Name" name="name" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" readonly value="<?php echo $userRes['f_name'];?>" class="form-control shadow" placeholder="Father Name" name="fname">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input readonly type="text" class="form-control shadow"
                                           value="<?php echo $userRes['cnic'];?>" name="cand_cnic" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input readonly type="text" value="<?php echo $userRes['email'];?>" class="form-control shadow" placeholder="Email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input readonly type="text" value="<?php echo $userRes['phone'];?>" class="form-control shadow" placeholder="Contact #" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control shadow w-50"  name="city" required>
                                        <option value="">Please select Test city</option>
                                        <?php
                                            $citySql = "SELECT id, c_name FROM city WHERE c_name IN ('Rawalpindi', 'LAHORE' , 'QUETTA' , 'PESHAWAR' , 'KARACHI', 'Multan', 'Sukkur', 'Muzaffarabad', 'Gilgit') ORDER BY c_name";
                                            $cityQ = mysqli_query($connection, $citySql);
                                            while($cityRow = mysqli_fetch_assoc($cityQ)) {
                                                ?>
                                                <option value="<?php echo $cityRow['id'];?>" <?php if($userRes['city_id'] == $cityRow['id']) {?> selected <?php } ?>>
                                                    <?php echo $cityRow['c_name'] ?>
                                                </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="<?php echo $userRes['dob'];?>" placeholder="YYYY-MM-DD" readonly name="dob" class="form-control shadow">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input readonly type="text" value="<?php echo $userRes['postal_address'];?>" placeholder="Postal Address" name="postal_address" class="form-control shadow">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Please select your picture</label>
                                    <input type="file" name="cand_image" <?php if($userRes['image'] == ''){ ?>required<?php } ?>>

                                    <input type="hidden" name="image_exist" value="<?php echo $userRes['image'];?>">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <?php
                                if($userRes['image'] != '') {
                                    ?>
                                    <img src="../images/candidates/profile%20picture/<?php echo $userRes['image'];?>" width="150">
                                    <?php
                                }

                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" >
                                <input type="submit" name="update" class="btn btn-info shadow" value="Update">
                            </div>
                        </div>
                    </form>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php
include('footer.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
</script>
<script type="text/javascript">
    // window.onload = () => {
    //     const myInput = document.getElementById('myInput');
    //     myInput.onpaste = e => e.preventDefault();
    // }
    // function chechCaptcha()
    // {
    //     const captcha = document.getElementById('captcha').value;
    //     const myInput = document.getElementById('myInput').value;
    //     if(captcha == myInput)
    //     {
    //         $("#register").attr("disabled",false);
    //     }
    //     else
    //     {
    //         $("#register").attr("disabled","disabled");
    //     }
    // }
</script>
<?php
if(isset($_POST['register']))
{
    $cand_name      = $_POST['cand_name'];
    $cand_cnic      = $_POST['cand_cnic'];
    $cand_email     = $_POST['cand_email'];
    $cand_contact   = $_POST['cand_contact'];
    $cand_password  = $_POST['cand_password'];
    $today          = date("Y-m-d");
    $fetch = "SELECT * FROM candidates WHERE cnic = '$cand_cnic'";
    $run = mysqli_query($connection,$fetch);
    $countRec = mysqli_num_rows($run);
    if($countRec > 0)
    {
        echo "<!DOCTYPE html>
      <html>
        <body> 
        <script>
        Swal.fire(
          'Account !',
          'Account with this cnic # already exist !',
          'error'
        ).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('cnicmsg').style.display = 'block';
          }
        });
        </script>
        </body>
      </html>";
    }
    else
    {
        echo "<script>document.getElementById('cnicmsg').style.display = 'none';</script>";
        $insert = "INSERT INTO `candidates`(`name`, `cnic`,`email`, `phone`, `password`, `status`, `signUpDate`) VALUES ('$cand_name','$cand_cnic','$cand_email','$cand_contact','$cand_password', '1','$today')";
        $run = mysqli_query($connection,$insert);
        $candID = mysqli_insert_id($connection);
        $encodId = base64_encode($candID);
        if($run)
        {
            $_SESSION["candd_id"] = $candID;
            if(isset($_SESSION["candd_id"]))
            {
                echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Account !',
            'Account successfully created !',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
               window.location.href = '../pages/candidates/dashboard.php';
            }
          });
          </script>
          </body>
        </html>";
            }
        }
    }
}
?>

<script>
    $('#cnic, #cnic_c').on('keyup', function() {
        if ($('#cnic').val() || $('#cnic').val()) {
            if ($('#cnic').val() == $('#cnic_c').val()) {
                $('#message').html('<b>CNIC Match</b>').css('color', 'green');
            }
            else {
                $('#message').html('<b>CNIC not Match</b>').css('color', 'red');
            }
        }
        else {
            $('#message').html('');
        }
    });
    ///////////////////////

</script>

</body>
</html>
