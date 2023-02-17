<?php
  include('includes/db.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes/css_links.php'; ?>
    <title>PBM | Forgot Password</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">  
  </head>
  <body style="background: #e6e6e6; overflow-x: hidden;">

    <div class="row bg-white">
      <div class="col-md-1"></div>
      <div class="col-md-1" class="hidden-md-down">
        <a href="online_registration.php"><img src="images/logo.png" width = "70px" height="70px" ></a>
      </div>
      <div class="col-md-10 text-left" style= " margin-top: 1%; text-shadow: 0 2 2px #0000FF; font-family: time new roman"><h3>Pakistan Bait ul Mal</h3></div>
    </div>

    <br>
    <div class="row">
        <center>
              <a href="online_registration.php" class="btn btn-warning shadow mb-1 offset-11" title="">Back</a>
            </center></div>
    <div class="row">
      
      <div class="col-md-2"></div>

      <div class="col-md-8">
        <div class="container">
          <div class="card shadow" style='border: 1px solid blue'>
            
            <div class="card-body">
              <p style="margin-top: -10px; margin-bottom: 40px"></p>
              <form method="post">
                <div class="row">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label>Please Enter Your CNIC Number</label>
                      <input type="text" class="form-control shadow" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" name="candd_cnic" required>
                      <p class="text-primary mt-2">Your password will be send to your register email</p>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <br>
                    <div class="form-group mt-2">
                      <input type="submit" name="login" class="btn btn-success shadow" value="Send Password">
                    </div>
                  </div>
                </div>
              </form>
              <br>
              <?php
                if (isset($_POST["login"]))
                {                    
                  $candd_cnic = $_POST["candd_cnic"];

                  $fetchData = "SELECT * FROM candidates WHERE cnic = '$candd_cnic'";
                  $runData = mysqli_query($connection,$fetchData);
                  $countData = mysqli_num_rows($runData);
                  if($countData != 0)
                  {
                    $rowData  = mysqli_fetch_array($runData);
                    $candd_id  = $rowData['id'];
                    $candd_name  = $rowData['name'];
                    $password = $rowData['password'];
                    $email = $rowData['email'];

                    // send the password 

                    $htmlStr = "";
                    $htmlStr .= "Hi " . $candd_name . ",<br /><br />";

                    $htmlStr .= "Your password is : <b>$password</b><br /><br /><br />";
                    $htmlStr .= "Pakistan Bait ul Mal (PBM) is an innovative and secure testing services provider company with a sound track record in testing and quality confirmation. Although new, UTS has earned a reputation of offering fool-proof, transparent and cost-effective solutions to its esteemed clients. UTS is Pakistan’s one of the leading self-sustained testing services company. Our primary focus is to promote merit and meticulous recruiting by using its testing systems for the purpose to form the fool-proof process. We are proud to follow transparent and corruption-free testing framework to support talent within the nation. Our test centers are spread within the 80 distinctive cities of Pakistan to cater more than 5,000 candidates a city per day. With experienced management at the helm and inspired by the confidence of its clients, UTS intends to grow by more than 50 percent per year through building sound relationship with its clients from all over the country.";

                    $htmlStr .= "<br /><br />Regards PBM,<br />";
                    $htmlStr .= "<a href='http://www.pbm.gov.pk/' target='_blank'>www.pbm.gov.pk</a><br />";


                    $name = "Pakistan Bait ul Mal";
                    $email_sender = "kashif.nadeem3@gmail.com";
                    $subject = "PBM | Forgot Password";
                    $recipient_email = $email;

                    $headers  = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= "From: {$name} <{$email_sender}> \n";

                    $body = $htmlStr;

                    //send email using the mail function, you can also use php mailer library if you want
                    mail($recipient_email, $subject, $body, $headers);

                    echo "<!DOCTYPE html>
                      <html>
                        <body> 
                        <script>
                        Swal.fire(
                          'Password !',
                          'Password has been sent to Your email $email',
                          'success'
                        ).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'online_registration.php';
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
                          'CNIC !',
                          'CNIC # doesn\'t exist!. Please Signup for a new account',
                          'error'
                        ).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'online_registration.php';
                          }
                        });
                        </script>
                        </body>
                      </html>";
                    }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="container">
          <div class="card shadow" style='border: 1px solid blue'>
            <div class="card-header bg-light">
              <div class="card-title"><b>CONTACT US</b></div>
            </div>
            <div class="card-body">
              <p><span class="text-primary"><i class="fa fa-phone"></i></span> 0800-66666<b>,</b> 051-9269639</p>

              <p><span class="text-primary"><i class="fa fa-envelope"></i></span> info@pbm.gov.pk</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </body>
</html>

<?php include 'includes/js_links.php'; ?>