<?php 
    include('includes/db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS || Result</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="result_style.css">
  </head>
  <body style="background: #E6E6E6">
    <a class="whatsapp" id="whatsapp" href="#">
      <i class="fab fa-whatsapp"></i>
    </a>
    <div class="top-navbar bg-white" style="position: sticky;">
      <div class="container-xl row mr-auto ml-auto">
        <div class="col-sm-4">
          <div class="phone-contact d-flex">
            <div class="icon"><i class="fas fa-phone-square"></i></div>
            <div class="phone-numbers ml-3">
              Phone :
              <span class="phone-number"><a href="tel:051-111-258-369">051-111-258-369</a></span>,
              <span class="phone-number"><a href="tel:051-2152815">051-2152815</a></span>,
              <span class="phone-number"><a href="tel:051-2112240">051-2112240</a></span>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="social-contact w-25 ml-auto mr-auto d-flex">
            <div class="facebook" onclick="window.open('https://www.facebook.com/uts.com.pk/')">
              <i class="fab fa-facebook-f"></i>
            </div>
            <div class="twitter" onclick="window.open('https://twitter.com/UniversalTesti1?s=09')">
              <i class="fab fa-twitter"></i>
            </div>
            <div class="instagram" onclick="window.open('https://www.instagram.com/')">
              <i class="fab fa-instagram"></i>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="email-contact d-flex">
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <div class="email-address ml-3">
              Email :
              <span class="email"><a href="mailto:info@uts.com.pk">info@uts.com.pk</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="lower-navbar" style="background: #014073;">
      <div class="container-xl ml-auto mr-auto">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="#"><img src="images/uts_logo.png" class="w-100" alt="uts-logo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <div class="line line1"></div>
          <div class="line line2"></div>
          <div class="line line3"></div>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://uts.com.pk/about-us/">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://uts.com.pk/services/">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://uts.com.pk/scholarship/">Scholarship</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://uts.com.pk/faqs/">FAQs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://uts.com.pk/contact/">Contact</a>
              </li>
            </ul>
            <div class="my-2 my-lg-0 nav-btn">
              <button
              class="btn btn-value my-2 my-sm-0"
              onclick="window.open('https://apply.uts.com.pk/online_registration.php','_self')"
              type="submit">
              Apply Now
              </button>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <br>
    <h2 class="text-center text-info">UTS Result</h2>
    <hr class="shadow">
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 m-auto">
          <div class="card mt-4 shadow">
            <form action="" method="post">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Desire Post</label>
                      <select name="post" class="form-control shadow" style="border: 1px solid #014073" required>
                        <option value="">Choose</option>
                        <?php
                          $fetch = "SELECT DISTINCT(r.post_id) AS id, p.post_name FROM result AS r INNER JOIN projects_posts AS p ON p.id = r.post_id";
                          $run = mysqli_query($connection,$fetch);
                          while ($row = mysqli_fetch_array($run)) {
                            $id = $row['id'];
                            $post = $row['post_name'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $post; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Roll No</label>
                      <input type="text" class="form-control shadow" required name="roll_no" placeholder="Roll No" style="border: 1px solid #014073">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <br>
                      <input type="submit" class="btn mt-2 btn-success shadow" value="Search" name="search">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
        if (isset($_POST['search']))
        {
          $post = $_POST['post'];
          $roll_no = $_POST['roll_no'];
          $fetchData = "SELECT c.name, c.cnic, c.f_name, r.result FROM result AS r LEFT JOIN assigned_center AS a ON a.roll_no = r.roll_no lEFT JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id LEFT JOIN candidates AS c ON c.id = ca.candidate_id WHERE r.post_id = '$post' AND r.roll_no = '$roll_no'";
          $runData = mysqli_query($connection,$fetchData);

          $countRow = mysqli_num_rows($runData);
          if($countRow > 0)
          {
            $rowData = mysqli_fetch_array($runData);
            $name = $rowData['name'];
            $f_name = $rowData['f_name'];
            $cnic = $rowData['cnic'];
            $result = $rowData['result'];
      ?>
      <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <table class="table table-hover text-center table-bordered bg-white shadow">
            <thead class="text-white" style="background: #014073">
              <tr>
                <th>Name</th>
                <th>Father Name</th>
                <th>CNIC</th>
                <th>Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $f_name; ?></td>
                <td><?php echo $cnic; ?></td>
                <td><?php echo $result; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <?php }  else { ?>
      <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <h4 class="text-center text-danger">No Result Found With <b class="text-dark"><?php echo $roll_no; ?></b> Roll Number</h4>
        </div>
      </div>
    <?php } } ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <footer>
      <div class="footer-container">
        <div class="row">
          <div class="col-sm-3 about">
            <h2>About</h2>
            <p>Universal Testing Services (UTS) has become essential to organizations or educational institutes who wish smooth and merit-based selection as it is the sole company providing quality educational and recruitment services for its client organizations since 2014, though small in age but not in expertise.</p>
          </div>
          <div class="col-sm-3 useful-links text-center">
            <h2>Userful Links</h2>
            <ul>
              <li onclick="window.open('https://uts.com.pk/about-us/','_self')">About Us</li>
              <li onclick="window.open('https://uts.com.pk/faqs/','_self')">FAQs</li>
              <li onclick="window.open('https://uts.com.pk/services/','_self')">Services</li>
              <li onclick="window.open('https://uts.com.pk/scholarship/','_self')">Scholarship</li>
            </ul>
          </div>
          <div class="col-sm-3 contactUs">
            <h2>Address</h2>
            <div class="address d-flex">
              <div><i class="fas fa-home"></i></div>&nbsp;&nbsp;&nbsp;
              <div>Address : Universal Testing Services 278-B, Main Nazim-ud-Din Road F-10/1, Islamabad, Pakistan.</div>
            </div>
            <div class="phone d-flex">
              <div><i class="fas fa-phone-square"></i></div>&nbsp;&nbsp;&nbsp;
              <div>Phone : UAN - 051-111-258-369, 051-2152815, 051-2112240 (Mon-Fri 9am-5pm)</div>
            </div>
            <div class="email d-flex">
              <div><i class="fas fa-envelope"></i></div>&nbsp;&nbsp;&nbsp;
              <div>Email: info@uts.com.pk</div>
            </div>
            
          </div>
          <div class="col-sm-3 location">
            <h2>Location</h2>
            <div class="map">
              <div class="mapouter"><div class="gmap_canvas"><iframe width="300" height="220" id="gmap_canvas" src="https://maps.google.com/maps?q=Address:%20Universal%20Testing%20Services%20278-B,%20Main%20Nazim-ud-Din%20Road%20F-10/1,%20Islamabad,%20Pakistan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com"></a><br><style>.mapouter{position:relative;text-align:right;height:220px;width:300px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:220px;width:300px;}</style></div></div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>

<?php include 'includes/js_links.php'; ?>
<script type="text/javascript">
  let navbar = document.querySelector(".lower-navbar")

    window.onscroll = () =>{
        if(window.pageYOffset > 50) {
            navbar.classList.add("fixed-top")
        }else{
            navbar.classList.remove("fixed-top")
        }
    }
</script>