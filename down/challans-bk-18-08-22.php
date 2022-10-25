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
$userSql = "SELECT cap.post_id, pp.post_name, pc.id AS challan_id FROM candidate_applied_post AS cap 
            LEFT JOIN projects_posts AS pp ON cap.post_id = pp.id
            LEFT JOIN projects_challans AS pc ON pp.proj_challan_id=pc.id
            WHERE cap.candidate_id='$candidateID' AND pp.project_id='4'";
$userQ = mysqli_query($connection, $userSql);
if(mysqli_num_rows($userQ) == 0) {
    ?>
    <script>
        // location.href = 'index.php';
    </script>
    <?php
}
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
                            <p style="margin-top: -10px; margin-bottom: 40px"><strong>Download Challan</strong></p>
                        </div>
                        <div class="col-md-6 text-right">
                            
                            <a href="upload-challan.php" class="">Upload Challan</a> |
                            <a href="profile.php" class="">Profile</a>
                        </div>
                    </div>

                    <table class="table">
                            <tr>
                                <th>S.No</th>
                                <th>Post Name</th>
                                <th>Download Challan</th>
                            </tr>

                        <?php
                        $i = 1;
                        while($userRes = mysqli_fetch_assoc($userQ)) {
                            ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $userRes['post_name'];?></td>
                                <td>
                                    <button onclick="downloadChallan('<?php echo $userRes['challan_id'];?>')" class="btn btn-info">Download Challan</button>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </table>

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
