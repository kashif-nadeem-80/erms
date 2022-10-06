<?php
include('includes/db.php');
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes/css_links.php'; ?>
    <title>UTS || Sign In</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
  </head>
  <body style="background: #e6e6e6; overflow-x: hidden; background-image: url(images/loginbg.jpg);">
    <div class="row bg-white">
      <div class="col-md-10"></div>
      <div class="col-md-10" class="hidden-md-down">
        <img src="images/logo.png" width="70px" height="70px">
      </div>
      <div class="col-md-10 text-left"
        style="margin-top: 1%; background-image: image() ; text-shadow: 0 1 2px #0000FF; font-family: time new roman;" >
        <h3>Universal Testing Services</h3>
      </div>
    </div>
    <br>
    <div class="row" id="signIn">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="container">
          <div class="card">
            <div class="card-body" >
              <!--<p style="margin-top: -10px; margin-bottom: 40px">Have an account | <b> Sign in </b></p>-->
              <p style="margin-top: -10px; margin-bottom: 20px">Have an account Or <a href="#" onclick="registDiv()"> Register Here </a> </p> 
              <form method="post" id="register_form">
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control shadow"
                      data-inputmask="'mask': '99999-9999999-9'" placeholder="CNIC No"
                      maxlenght="15" name="candd_cnic" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="password" class="form-control shadow" placeholder="Password"
                      name="candd_pass" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="submit" name="login" class="btn btn-info shadow" value="Sign In">
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
                $candd_pass = $_POST["candd_pass"];
                $fetchData = "SELECT * FROM candidates WHERE cnic = '$candd_cnic' AND password = '$candd_pass'";
                $runData = mysqli_query($connection,$fetchData);
                $countData = mysqli_num_rows($runData);
                if($countData != 0)
                {
                  $rowData  = mysqli_fetch_array($runData);
                  $candd_id  = $rowData['id'];
                  $status = $rowData['status'];
                  if($status == '1')
                  {
                    $_SESSION["candd_id"] = $candd_id;
                    
                    if(isset($_SESSION["candd_id"]))
                    {
                      echo "<script>window.location.href = 'pages/candidates/dashboard.php'; </script>";
                    }
                  }
                  else
                  {
                    echo "<span class='text-danger'><center><b>Please first confirm your email !</b></center></span>";
                  }
                }
                else
                {
                  echo "<span class='text-danger'><center><b>CNIC or Password is Incorrect</b></center></span>";
                }
              }
              ?>
              <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3"><a href="forgot_password.php">Forgot Password ?</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <script>
function registDiv() {
  var x = document.getElementById("newRegist");
  var y = document.getElementById("signIn");
  if (x.style.display === "none") {
    y.style.display = "none";
    x.style.display = "block";
    
  } else {
    y.style.display = "block";
    x.style.display = "none";
  }
}
</script>


    <div class="row" id="newRegist" style="display: none;" >
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="container">
          <center class="m-2 p-3 bg-danger rounded" style="display: none" id="cnicmsg"><b>Account with this cnic # already created</b>
          </center>
          <center class="bg-success rounded m-2 p-3" style="display: none" id="signUpMsg"><b>Account successfully created, please go to your email to verify your account</b></center>
          <div class="card shadow">
            <div class="card-body">
              <p style="margin-top: -10px; margin-bottom: 40px">New User | <b> <a onclick="registDiv()"> Register Here </a></b></p>
              <form method="post" id="captcha_form">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" name="cand_name" placeholder="Full Name" class="form-control"
                      required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select type="text" name="cand_district" class="form-control select2" required>
                        <option value="">District of Domicile</option>
                        <?php
                        $fetchData = "SELECT * FROM district ORDER BY dis_name ASC";
                        $runData = mysqli_query($connection,$fetchData);
                        while ($rowData = mysqli_fetch_array($runData)) {
                        $dis_id   = $rowData['id'];
                        $dis_name = $rowData['dis_name'];
                        ?>
                        <option value="<?php echo $dis_id ?>"><?php echo $dis_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="email" name="cand_email" placeholder="Email"  class="form-control"
                      required>
                      <span class="text-danger">Very important </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" name="cand_cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="CNIC No" maxlenght="15" id="cnic" class="form-control"
                      required>
                      <span class="text-danger">Give CNIC # Carefully</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" name="confirm_cnic"
                      data-inputmask="'mask': '99999-9999999-9'"
                      placeholder="CNIC Confirmation No" maxlenght="15" id="cnic_c" class="form-control" required>
                      <span id='message'></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" name="cand_contact" data-inputmask="'mask': '9999-9999999'"
                      maxlength="12" placeholder="Contact No" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="password" name="cand_password" placeholder="Password" class="form-control" id="password" onkeyup="checkPasswordStrength()"
                      required>
                      <span id="password-strength-status"></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="password" name="cand_password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                      <span id="message_p"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input placeholder="Capta" style="font-size: 30px; font-family: Blackadder ITC; background: orange;" value="<?php echo mt_rand(0,9999) ?>" id="captcha" class="form-control" readonly required>
                      <label>CAPTCHA</label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" id="myInput" onkeyup="chechCaptcha()" placeholder="Please Enter CAPTCHA" class="form-control" required>

                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div class="form-group">
                      <input type="submit" style="width:230px ;" name="register" id="register" class="btn btn-info"
                      value="Register" disabled>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </body>
</html>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>

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
  $cand_district  = $_POST['cand_district'];
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
    $insert = "INSERT INTO `candidates`(`district_id`, `name`, `cnic`,`email`, `phone`, `password`, `status`, `signUpDate`) VALUES ('$cand_district','$cand_name','$cand_cnic','$cand_email','$cand_contact','$cand_password', '1','$today')";
    $run = mysqli_query($connection,$insert);
    $candID = mysqli_insert_id($connection);
    $encodId = base64_encode($candID);
    if($run)
    {
      // send the email verification
      // $verificationLink = "http://apply.uts.com.pk/confirm_email.php?id=$encodId";
      $htmlStr = "";
      $htmlStr .= "Hi " . $cand_name . ",<br /><br />";
      $htmlStr .= "Please click the button below to verify your registration.<br /><br /><br />";
      $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color: #007bff; color:#fff; border-radius:2%'>VERIFY EMAIL</a><br /><br />";
      $htmlStr .= "<br />Universal Testing Services (UTS) is an innovative and secure testing services provider company with a sound track record in testing and quality confirmation. Although new, UTS has earned a reputation of offering fool-proof, transparent and cost-effective solutions to its esteemed clients. UTS is Pakistan’s one of the leading self-sustained testing services company. Our primary focus is to promote merit and meticulous recruiting by using its testing systems for the purpose to form the fool-proof process. We are proud to follow transparent and corruption-free testing framework to support talent within the nation. Our test centers are spread within the 80 distinctive cities of Pakistan to cater more than 5,000 candidates a city per day. With experienced management at the helm and inspired by the confidence of its clients, UTS intends to grow by more than 50 percent per year through building sound relationship with its clients from all over the country.";

      $htmlStr .= "<br /><br /><br />Regards UTS,<br />";

      $htmlStr .= "<a href='http://www.uts.com.pk' target='_blank'>www.uts.com.pk</a><br />";
      $name = "Universal Testing Services";
      $email_sender = "info@uts.com.pk";
      $subject = "UTS Sign Up | Confirmation of Email";
      $recipient_email = $cand_email;
      $headers  = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "From: {$name} <{$email_sender}> \n";
      $body = $htmlStr;
      //send email using the mail function, you can also use php mailer library if you want
      // mail($recipient_email, $subject, $body, $headers);
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
            document.getElementById( 'signUpMsg' ).style.display = 'block';
          }
        });
        </script>
        </body>
      </html>";
    }
  }
}
?>
<?php include 'includes/js_links.php'; ?>

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
$('#password, #confirm_password').on('keyup', function() {
  if ($('#password').val() || $('#password').val()) {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#message_p').html('<b>Password Match</b>').css('color', 'green');
    } else {
      $('#message_p').html('<b>Password not Match</b>').css('color', 'red');
    }
  } else {
    $('#message_p').html('');
  }
});

function checkPasswordStrength() {
  var number = /([0-9])/;
  var alphabets = /([a-zA-Z])/;
  var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  if ($('#password').val().length < 6) {
    $('#password-strength-status').removeClass();
    $('#password-strength-status').addClass('weak-password');
    $('#password-strength-status').html("<b>Weak (should be atleast 6 characters.)</b>").css("color", "red");
  }
  else {
    if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(
    special_characters)) {
      $('#password-strength-status').removeClass();
      $('#password-strength-status').addClass('strong-password');
      $('#password-strength-status').html("<b>Password is Strong</b>").css("color", "green");
    }
    else {
      $('#password-strength-status').removeClass();
      $('#password-strength-status').addClass('medium-password');
      $('#password-strength-status').html(
      "<b>Medium (should include alphabets, numbers and special characters.)</b>").css("color", "orange");
    }
  }
}
</script>