<?php 

    include('includes/db.php'); 

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UTS || Apply</title>

    <link rel="shortcut icon" href="images/logo.png" type="image/png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="result_style.css">

</head>

<body style="background: #E6E6E6">

    <!-- <a class="whatsapp" id="whatsapp" href="#">

      <i class="fab fa-whatsapp"></i>

    </a> -->

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

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">

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

                        <!-- <li class="nav-item">

                <a class="nav-link" href="https://uts.com.pk/scholarship/">Scholarship</a>

              </li> -->

                        <li class="nav-item">

                            <a class="nav-link" href="https://uts.com.pk/faqs/">FAQs</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="https://uts.com.pk/contact/">Contact</a>

                        </li>

                    </ul>

                    <div class="my-2 my-lg-0 nav-btn">

                        <button class="btn btn-value my-2 my-sm-0" onclick="window.open('online_registration.php')"
                            type="submit">

                            Apply Now

                        </button>
                        <button class="btn btn-value my-2 my-sm-0" onclick="window.open('online_registration.php')"
                            type="submit">

                            Check Status

                        </button>
                        <!-- <button

class="btn btn-value my-2 my-sm-0"


onclick="window.open('online_registration.php')"
onclick="window.open('online_registration.php')"

type="submit">

Apply Now

</button> -->

                    </div>

                </div>

            </nav>

        </div>


    </div>



    <br>

    <h2 class="text-center text-info">Recruitments</h2>

    <hr class="shadow">

    <div>
        <div class="container-fluid  " style="padding-left:10px ; align-self: center;">
            <div class="row ">

                <div class="col-md-12 table-responsive ">

                    <table class="table table-hover bg-white align-content-center" style="width:85%;">

                        <thead>

                            <tr>

                                <!-- <th width="6%">S.No</th> -->
                                <th width="6%"> </th>

                                <th>Projects/Jobs</th>

                                <th>Detail</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

      $count = 0;
      // echo "this test line";

      $query2 = "SELECT * FROM projects WHERE status = '1' AND last_date >= CURRENT_DATE() ORDER BY id ASC";

      $runData = mysqli_query($connection,$query2);

      $countData = mysqli_num_rows($runData);

      if($countData != '0' OR $countData != 0)

      {

      while($rowData = mysqli_fetch_array($runData)) {

      $count++;

      $pid = $rowData['id'];

      $encodeId = base64_encode($pid);

      $project_name  = $rowData['project_name'];

      $last_date = date("d-m-Y",strtotime($rowData['last_date']));

      $advertisement  = $rowData['advertisement'];
      

      $adver = "../../images/admin/project/advertisement/".$advertisement;

      $app_form       = $rowData['app_form'];

      $app = "../../images/admin/project/app_form/".$app_form;

      ?>



                            <tr>

                                <!-- <td><?php //echo $count; ?></td> -->
                                <td><?php   ?></td>

                                <td>

                                    <span><img src="images/news1.gif" width="40px" height="40px"></span>

                                    <b style="font-size: 18px;" class="text-primary"><?php echo $project_name; ?></b>

                                    <span style="margin-left: 8%"><b class="text-secondary">Last Date of Apply :</b> <b
                                            style="color: orangered"><?php echo $last_date; ?></b></span>

                                </td>

                                <td>

                                    <a style="margin-top: 0px"
                                        href="online_registration.php?id=<?php echo $encodeId; ?>"
                                        class="btn btn-success btn-sm">Online Apply</a>

                                    <a style="margin-top: 0px" href="<?php echo $adver ?>"
                                        class="btn btn-warning btn-sm" target="_blank">Advertisement</a>

                                    <!-- <a style="margin-top: 2px" href="<?php echo $app ?>" class="btn btn-info btn-sm">Application Form</a> -->


                                </td>


                            </tr>


                            <?php //echo "this is ...";  echo $adver;
      } }

              else

              {

            ?>

                            <tr>

                                <td colspan="3" class="text-center font-weight-bold text-danger">No Post Available For
                                    Apply
                                    <br>
                                    <hr> 
                                    FFBL, FPCL & FML Apprenticeship Program Candidates can check the Accepted /
                                    Rejected Status.
                                    <a href="online_registration.php" style="width:200px ; align-items: center;"
                                class="btn  badge-pill  badge-info shadow">Click to Check Status</a>
                                </td>

                            </tr>

                            
                            <?php } ?>

                        </tbody>

                    </table>

                </div>

                <!-- <div id="add">
<img src="<?php echo $adver ?> "  width="500" height="600"> 
</div> -->

            </div>

        </div>

    </DIV>




    </div>


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

    <br>


    <br>

    <br>



    <footer>

        <div class="footer-container">

            <div class="row">

                <div class="col-sm-3 about">

                    <h2>About</h2>

                    <p>Universal Testing Services (UTS) has become essential to organizations or educational institutes
                        who wish smooth and merit-based selection as it is the sole company providing quality
                        educational and recruitment services for its client organizations since 2014, though small in
                        age but not in expertise.</p>

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

                        <div>Address : Universal Testing Services 278-B, Main Nazim-ud-Din Road F-10/1, Islamabad,
                            Pakistan.</div>

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

                <!-- <div class="col-sm-3 location">

            <h2>Location</h2>

            <div class="map">

              <div class="mapouter"><div class="gmap_canvas"><iframe width="300" height="220" id="gmap_canvas" src="https://maps.google.com/maps?q=Address:%20Universal%20Testing%20Services%20278-B,%20Main%20Nazim-ud-Din%20Road%20F-10/1,%20Islamabad,%20Pakistan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com"></a><br><style>.mapouter{position:relative;text-align:right;height:220px;width:300px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:220px;width:300px;}</style></div></div>

            </div>

          </div> -->

            </div>

        </div>

    </footer>

</body>

</html>



<?php include 'includes/js_links.php'; ?>

<script type="text/javascript">
let navbar = document.querySelector(".lower-navbar")



window.onscroll = () => {

    if (window.pageYOffset > 50) {

        navbar.classList.add("fixed-top")

    } else {

        navbar.classList.remove("fixed-top")

    }

}
</script>