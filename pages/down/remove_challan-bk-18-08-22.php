<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['pbs_cand']) && !isset($_GET['post_id'])) {
    ?>
    <script>
        location.href = 'index.php';
    </script>
    <?php
}
$candidateId = $_SESSION['pbs_cand'];
$post_id = $_GET['post_id'];
$removeSql = "UPDATE candidate_applied_post SET challan_file=null, challan_upload_date=null 
             WHERE candidate_id='$candidateId' AND post_id='$post_id'";
mysqli_query($connection, $removeSql);
?>
<script>
    location.href = 'upload-challan.php';
</script>
