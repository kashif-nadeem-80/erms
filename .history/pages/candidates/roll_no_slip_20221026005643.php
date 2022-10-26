<?php
// session_start();
//include('includes/db.php');
include "includes/header.php";
$canddate_id = $_SESSION['candd_id'];
// if(!isset($_SESSION['pbs_cand']) || sizeof($_SESSION['accepted_posts']) == 0) {
//     ?>
     <script>
//         location.href = 'index.php';
//     </script>
     <?php
//}
?>
<!DOCTYPE html>
<html>
<head>
    <?php //include('header.php');?>
    <title>UTS | Roll Number Slip</title>
</head>
    <body style="background: #e6e6e6; overflow-x: hidden;">
    <div class="row bg-white">
        <div class="col-md-1"></div>
        <!-- <div class="col-md-1" class="hidden-md-down">
            <img src="../images/logo.png" width="70px" height="70px">
        </div> -->
        <!-- <div class="col-md-10 text-center"
             style="margin-top: 1%; text-shadow: 0 0 2px #0000FF; font-family: time new roman">
            <h3>Universal Testing Services</h3>
        </div> -->
    </div>
    <br>
    <style>
        @media print {
            body {
                /*-webkit-print-color-adjust: exact !important;*/
            }
            .printBlock{
                display: none;
            }
            .myDivToPrint {
                background-color: white;
                height: 100%;
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
                margin: 0;
                padding: 15px;
                font-size: 14px;
                line-height: 18px;
            }

        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h4 class="m-0 text-dark">Roll Number Slip</h4>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
    <section class="content myDivToPrint">
        <div class="row">
            <div class="col-md-12 mb-2">
                <button type="button" onclick="window.print()" class="printBlock btn btn-primary shadow float-right">Print</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark printBlock">
                        <div class="card-title">Roll No</div>
                    </div>
                    <?php
                    // $posts_id = implode(',', $_SESSION['accepted_posts']);
                    // $cand_id = $_SESSION['pbs_cand'];
                    $rollNoSql = "SELECT * FROM assigned_center";
                    $query = "SELECT p.project_name,p.project_id,c.cnic,c.name,c.f_name,c.image,ac.roll_no,pp.post_name,
                        cs.reporting_date,cs.start_time,t.center_name,c.phone, ac.post_id 
                    FROM assigned_center AS ac 
                        INNER JOIN projects_posts AS pp ON pp.id = ac.post_id 
                        INNER JOIN projects AS p ON p.id = pp.project_id 
                        INNER JOIN candidate_applied_post AS cap ON cap.id = ac.cand_applied_id 
                        INNER JOIN center_session AS cs ON cs.id = ac.session_id 
                        INNER JOIN test_centers AS t ON t.id = cs.center_id 
                        INNER JOIN candidates AS c ON c.id = cap.candidate_id 
                        WHERE  c.id = '$canddate_id'";
                        //ac.post_id IN ($posts_id) AND
                    $result = mysqli_query($connection,$query);
                    $allPosts = [];
                    while($row = mysqli_fetch_array($result)) {

                        $project_name = $row['project_name'];
                        $project_id = $row['project_id'];
                        $name = $row['name'];
                        $f_name = $row['f_name'];
                        $cnic = $row['cnic'];
                        $phone = $row['phone'];
                        $image = $row['image'];
                        if($row['post_id'] > 3) {
                            array_push($allPosts, [
                                'roll_no' => $row['roll_no'],
                                'post_name' => $row['post_name'],
                                'reporting_date' => date("d-m-Y h:i a", strtotime($row['reporting_date'])),
                                'start_time' => date("h:i a", strtotime($row['start_time'])),
                                'center_name' => $row['center_name']
                            ]);
                        }
//                        $roll_no = $row['roll_no'];
//                        $post_name = $row['post_name'];
//                        $reporting_date = date("d-m-Y h:i a", strtotime($row['reporting_date']));
//                        $start_time = date("h:i a", strtotime($row['start_time']));
//                        $center_name = $row['center_name'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    &nbsp;<img class="ml-2 mt-2" width="60px" height="60px" src="../../images/logo.png" alt="uts">
                                </div>
                                <div class="col-md-8">
                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Universal Testing Services</h4>
                                    <p>Phone: 051-111-258-369 &nbsp; Email:<a href="info@uts.com.pk"> info@uts.com.pk</a> &nbsp;Website: <a href="http://www.uts.com.pk" target="_blank">www.uts.com.pk</a></p>
                                </div>
                                <hr style="margin-top: 0;border: 2px solid black; width: 95%;">
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p class="m-0"><b>Roll No Slip</b></p>
                                    <p><b><?php echo $project_name." (".$project_id.")"; ?></b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="m-0">&nbsp;&nbsp;CNIC No: <b><?php echo $cnic; ?></b></p>
                                    <p class="m-0">&nbsp;&nbsp;Name: <b><?php echo $name; ?></b></p>
                                    <p class="m-0">&nbsp;&nbsp;Father/Guardian Name: <b><?php echo $f_name; ?></b></p>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-2">
                                    <img class="float-right" src="<?php if($image != ''){ echo '../../images/candidates/profile picture/'.$image; }else{ echo '../../images/user.png'; } ?>" height="170px" width="160px">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <table class="table table-bordered bg-white text-center border-color" >
                                        <thead >
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Post Name</th>
                                            <th>Reporting Date & Time</th>
                                            <th>Test Start Time </th>
                                            <th>Test Center</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($allPosts as $spost) {
                                        ?>
                                        <tr>
                                            <td><?php echo $spost['roll_no']; ?></td>
                                            <td><?php echo $spost['post_name']; ?></td>
                                            <td><?php echo $spost['reporting_date']; ?></td>
                                            <td><?php echo $spost['start_time']; ?></td>
                                            <td><?php echo $spost['center_name']; ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <b>&nbsp;&nbsp;INSTRUCTIONS:</b>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-12">
								<span class="m-0">1. You are required to bring this Roll No Slip along with your original Identity Card for identification. No other identification
									documents like Passport, Driving License and Original Degrees are acceptable for identification, only original CNIC is
								acceptable with Roll No Slip.</span>
								<p class="m-0">2. <strong>Candidates who applied more than one for the same post (regular & contract) will have a single paper (Except Statistical Assistant SR.(01,19,28)) .</strong></p>
								<p class="m-0">2. <strong>جن امیدواروں نے ایک ججائے گی. ان پپیے ایک سے زیادہ درخواستیں (باقاعدہ اور معاہدہ) ان کے پاس ایک ہی پیپر ہوگا (سوائے شماریاتی اسسٹنٹ SR کے۔(01,19,28))</strong></p>
								<p class="m-0">3. APPLICANT WILL NOT ALLOWED TO ENTER THE TEST CENTER PREMISES AFTER THE TEST STARTING TIME.</p>
                                    <p class="m-0">4. You are also required to bring a Clipboard and ball pen/Marker (Black or Blue) with you. Clipboard should be clean without
                                        any writing. No paper for rough work is allowed.</p>
                                    <p class="m-0">5. Mobile Phone/Calculator or any other electronic device and wearable is not allowed. Please leave it outside the test center.</p>
                                    <p class="m-0">6. Center Management is not responsible for keeping student’s belongings/valuables. No ladies hand bags are allowed in the
                                        center</p>
                                    <p class="m-0">7. Any kind of weapon is strictly prohibited in the Examination Hall.
                                    </p>
                                    <p class="m-0">8. This is a provisional test subject to verification of your original documents, any discrepancy found later at any stage you will
                                        be disqualified.</p>
                                    <p class="m-0">9. Applicant should Reach the Test Center Half an Hour Before Reporting time.</p>
                                    <p class="m-0">10. Candidates can not leave the Examination Hall before Completion of Half Time of the Test.</p>
                                    <p class="m-0">11. Candidate who is found Either copying or receving Assistance from others will be Disqualied</p>
                                    <p>12. Keep visiting UTS website <a href="http://www.uts.com.pk" target="_blank">www.uts.com.pk</a> for further information and test result
                                    </p>
                                </div>
                            </div>
                            <?php
                            $query1 = "SELECT * FROM signatures";
                            $result1 = mysqli_query($connection, $query1);
                            $row = mysqli_fetch_array($result1);
                            $signature = $row['manager_operation'];
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <img src="../../images/admin/signatures/<?php echo $signature ?>" alt="ss" height="100px" width="180px">
                                        <div class="mr-0"><b>Manager Operation</b></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <b>To</b>,<br>
                                    Name: <b><?php echo $name; ?></b>&nbsp; Guardian/Father Name: <b><?php echo $f_name; ?></b><br>
                                    CNIC No: <b><?php echo $cnic; ?></b>&nbsp; Mobile : <b><?php echo $phone; ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include "footer.php";
?>
    </body>

</html>
