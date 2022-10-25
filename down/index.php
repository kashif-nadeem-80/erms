<?php
include('../includes/db.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <?php include('header.php');?>
<title>UTS | Sign In</title>    
</head>
<body style="background: #8E8E8E; overflow-x: hidden;">
<div class="row bg-white">
    <div class="col-md-1"></div>
    <div class="col-md-1" class="hidden-md-down">
        <img src="../images/logo.png" width="70px" height="70px">
    </div>
    <div class="col-md-10 text-center"
         style="margin-top: 1%; text-shadow: 0 0 2px #8E8E8E; font-family: time new roman">
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
                    <!--<p style="margin-top: -10px; margin-bottom: 40px"><b> Sign in</b></p>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <span class='text-info'><center><b>Result </b></center></span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <form method="post" id="register_form">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span class='text-info'><center><b><strong><center><h1 style="color:red;"><b>Roll No Slip</b></h1></center></strong>
                                
                                <p><b><h1 style="color:green;"> </h1></b></p>
                                <h3 class="m-0">2. <strong>Candidates who applied more than one for the same post (regular & contract) will have a single paper (Except Statistical Assistant SR.(01,19,28)) .</strong></h3>
								<h3 class="m-0">2. <strong>جن امیدواروں نے ایک ججائے گی. ان پپیے ایک سے زیادہ درخواستیں (باقاعدہ اور معاہدہ) ان کے پاس ایک ہی پیپر ہوگا (سوائے شماریاتی اسسٹنٹ SR کے۔(01,19,28)</strong></h3>
								<!--<p><b><h3 style="color:green;">Keep visiting our website for futher Updates.</h3></b></p>-->
                                <!--<h2><button onclick="location.href='https://uts.com.pk'" type="button" background-color: #555555;>Click here for UTS Website</button></h2>-->
                                <!--<p style="color:black;">Answer:01 Picture and Submitted challan or Receipt if you paid online (One Receipt will be Consider Against one Post).</p>
                                <p><b><h4 style="color:green;">Question : Can we deposit the Fee online?</h4></b></p> 
                                <p style="color:black;">Answer: Yes, Applicants can also deposit the Fee directly to the UTS accounts mentioned in the Deposit Slip. The receipt of the deposited fee is to be uploaded.</p>
                                <p><b><h4 style="color:green;"> (Compulsory) Question: what we have to sent to UTS by Post?</h4></b></p>
                                <p style="color:black;">Answer: 01 Picture,01 CNIC & Submitted Challan copy or Receipt to UTS(If a challan Copy or Receipt is not received at UTS your Application will be Rejected)</p>
                                <p><b><h4 style="color:green;">Question: Can we change our Test City?</h4></b></p>
                                <p style="color:black;">Answer: Yes,you can change your Test City/choose your test city.</p>
                                <center><b><strong><center><h2 style="color:red;"><b>Announcement</b></h2></center></strong>-->
                                <!--<p><h4 style="color:black;"> Test for various posts for the recruitment of Pakistan Bureau of Statistics (PBS) of (BS-06 to BS-15) is Tentatively scheduled from 20th & 21st August 2022.</h4></p>-->
                                
                                <!--<h3 > Office Address:  H# 16/A,Main Sumbal Road, F-10/3, Islamabad.</h3>-->
                                
                                <!--<h3>Office Hours: 0800 to 1700 </h3>-->
                                <h4><button onclick="location.href='https://uts.com.pk/downloads/'" type="button" background-color: #555555;>Click here to Download the Syllabus</button></h4>
                                <!--<a href="https://uts.com.pk/downloads/" class="button"><h3 style="color:magenta">Click here to Download the Syllabus</h3></a>-->
                                <!--<a href="https://uts.com.pk/downloads/"><button> </button></a>-->
                                
                            
                                <!--<b><h4 style="color:red;">Note:Query will be Entertained From 3-Aug-2022 To 13-Aug-2022 (0800 to 1600 hours)</h4></b>-->
                                
                                </b></center></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
<!--                            <div class="col-md-4">-->
<!--                                <div class="form-group">-->
<!--                                    <select name="post_id" class="form-group select2 w-100 shadow " required>-->
<!--                                        <option value="">Select Post</option>-->
<!--                                        --><?php
//                                        $postSql = "SELECT pp.id AS post_id, pp.post_name From projects AS p LEFT JOIN projects_posts AS pp ON p.id=pp.project_id
//                                    WHERE p.project_id='PBS(01)'";
//                                        $postQ = mysqli_query($connection, $postSql);
//                                        while($postRes = mysqli_fetch_assoc($postQ)) {
//                                            ?>
<!--                                            <option value="--><?php //echo $postRes['post_id'];?><!--">-->
<!--                                                --><?php //echo $postRes['post_name'];?>
<!--                                            </option>-->
<!--                                        --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>
                            </div>-->
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                
                                    <input type="text" class="form-control shadow"
                                           data-inputmask="'mask': '99999-9999999-9'" placeholder="CNIC No"                                           
                                           maxlenght="15" name="candd_cnic" required>
                                    
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="submit" name="login" class="btn btn-info shadow" value="Download">
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </form>
                    <br>
                    <?php
                    if (isset($_POST["login"]))
                    {

                        $candd_cnic = $_POST["candd_cnic"];
//                        $post_id = $_POST['post_id'];
                        $fetchData = "SELECT c.id AS candidateId, cap.post_id, cap.status FROM candidates AS c 
                                        LEFT JOIN candidate_applied_post AS cap ON c.id=cap.candidate_id 
                                    WHERE cnic = '$candd_cnic'";
                        $runData = mysqli_query($connection,$fetchData);
                        $countData = mysqli_num_rows($runData);
                        if($countData != 0)
                        {
                            $appStatus = [];
                            $acceptedPosts = [];
                            while($rowData  = mysqli_fetch_array($runData)) {
                             array_push($appStatus, $rowData['status']);
                             if($rowData['status'] == 'Accepted') {
                                 array_push($acceptedPosts, $rowData['post_id']);
                             }
                             $candd_id  = $rowData['candidateId'];

                            }
                            if(in_array('Accepted', $appStatus)) {
                                $_SESSION["pbs_cand"] = $candd_id;
                                $_SESSION['accepted_posts'] = $acceptedPosts;
//                            $_SESSION["pbs_post_id"] = $rowData['post_id'];

                                if (isset($_SESSION["pbs_cand"])) {
                                    echo "<script>window.location.href = 'roll-no-slip.php'; </script>";
                                }
//                            }
//                            else
//                            {
//                                echo "<span class='text-danger'><center><b>Please verify your email !</b></center></span>";
//                            }
                            }
                        }
                        else
                        {
                            echo "<span class='text-danger'><center><b>Your application is not accepted. </b></center></span>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php
include('footer.php');
?>

<script type="text/javascript">
    window.onload = () => {
        const myInput = document.getElementById('myInput');
        myInput.onpaste = e => e.preventDefault();
    }
    function chechCaptcha()
    {
        const captcha = document.getElementById('captcha').value;
        const myInput = document.getElementById('myInput').value;
        if(captcha == myInput)
        {
            $("#register").attr("disabled",false);
        }
        else
        {
            $("#register").attr("disabled","disabled");
        }
    }
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
