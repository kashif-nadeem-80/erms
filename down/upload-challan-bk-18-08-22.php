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
    $candidateID = $_SESSION['pbs_cand'];
    $error = false;
    $message = '';
    if(isset($_POST['upload_challan'])) {
        $postId = $_POST['post_id'];
        $challanForm = $_FILES['challan_doc']['name'];
        if($postId != '' && $challanForm !='') {
            $ext = strtolower(pathinfo($challanForm, PATHINFO_EXTENSION));
            $sizeKB = round($_FILES['challan_doc']['size']/1024);
            if($sizeKB > 500) {
                $error = true;
                $message = 'File too large. Maximum allowed size is 500Kb';
            }
            if(!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $error = true;
                $message = 'Invalid challan image type. Only jpg, png or jpeg files allowed!';
            }

            if(!$error) {
                $newFileName = $candidateID . '-' . time() . '.' . $ext;
                $targetPath = '../images/candidates/challans/' . $newFileName;
                move_uploaded_file($_FILES['challan_doc']['tmp_name'], $targetPath);
                $today = date('Y-m-d');
                $challanSql = "UPDATE candidate_applied_post SET challan_file='$newFileName', challan_upload_date='$today', status='Pending', status_details='Inquiry'
                                WHERE candidate_id='$candidateID' AND post_id='$postId'";
                mysqli_query($connection, $challanSql) or die(mysqli_error());
                $message = 'Challan uploaded successfully for the selected post.';
            }
        } else {
            $error = true;
            $message = 'All fields are required!';
        }
    }


include('header.php');
$userSql = "SELECT c.name, c.f_name, cap.post_id, pp.post_name, pc.id AS challan_id FROM candidate_applied_post AS cap 
            LEFT JOIN candidates AS c ON cap.candidate_id=c.id
            LEFT JOIN projects_posts AS pp ON cap.post_id = pp.id
            LEFT JOIN projects_challans AS pc ON pp.proj_challan_id=pc.id
            WHERE cap.candidate_id='$candidateID' AND (cap.challan_file='' OR cap.challan_file IS NULL) AND pp.project_id=4";
$userQ = mysqli_query($connection, $userSql);
if(mysqli_num_rows($userQ) == 0) {
    ?>
    <script>
        // location.href = 'index.php';
    </script>
    <?php
}
$userChallansSql = "SELECT c.name, c.f_name, cap.status, ci.c_name, cap.status_details, cap.post_id, pp.post_name, pc.id AS challan_id, cap.challan_file FROM candidate_applied_post AS cap 
             LEFT JOIN candidates AS c ON cap.candidate_id=c.id
            LEFT JOIN projects_posts AS pp ON cap.post_id = pp.id
            LEFT JOIN projects_challans AS pc ON pp.proj_challan_id=pc.id
            LEFT JOIN city AS ci ON cap.city_id=ci.id
            WHERE cap.candidate_id='$candidateID' AND pp.project_id=4 ";
$userChallanQ = mysqli_query($connection, $userChallansSql);
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
                            <p style="margin-top: -10px; margin-bottom: 40px"><strong>Upload Challan</strong></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="upload-challan.php" class="">Upload Challan</a> |
                            <a href="challans.php" class="">Download Challan</a> |
                            <a href="profile.php" class="">Profile</a>
                        </div>

                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php
                        if($message != '') {
                            ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span class='<?php echo ($error === true) ? 'text-danger': 'text-success';?>'>
                                        <center><b><?php echo $message;?> </b></center>
                                    </span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="post_id" class="select2" required>
                                        <option value="">Select a post</option>
                                        <?php
                                        while($userRes = mysqli_fetch_assoc($userQ)) {
                                        ?>
                                            <option value="<?php echo $userRes['post_id'];?>">
                                                <?php echo $userRes['post_name']; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="challan_doc" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-success" name="upload_challan" value="Upload">
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>S.No</th>
                                    <th>Post Title</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    <th>Test City</th>
                                    <th>Status</th>
                                    <th>Uploaded</th>
                                </tr>
                                <?php
                                $c = 1;
                                while($challan = mysqli_fetch_array($userChallanQ)) {
                                    ?>
                                    <tr>
                                        <td>
                                       <?php echo $c;?>
                                        </td>
                                        <td>
                                            <?php echo $challan['post_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $challan['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $challan['f_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $challan['c_name']; ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $challan['status'];
                                            if($challan['status'] === 'Rejected') {
                                                echo '<br>'.$challan['status_details'];
                                            }
                                            ?>
                                        </td>
                                        <td>

                                            <?php
                                            if($challan['challan_file'] != ''){
                                                ?>
                                                <img width="200" height="200" src="../images/candidates/challans/<?php echo $challan['challan_file'];?>" />
                                                <?php
                                            }

                                            if($challan['challan_file'] != ''){
                                            ?>
                                                <br>
                                            <a onclick="return confirm('Are you sure you want to remove?')" href="remove_challan.php?post_id=<?php echo $challan['post_id'];?>">
                                                Delete Challan
                                            </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php
                                    $c++;
                                }
                                ?>
                            </table>
                        </div>
                    </div>


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
    function downloadChallan(id) {
        window.open('print_challan.php?id='+id);
    }
</script>


</body>
</html>
