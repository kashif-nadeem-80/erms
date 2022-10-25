<?php
include "includes/db.php";

//////////Candidate List ///////////////
if(isset($_POST['proj1']) && isset($_POST['sesion1']))
{
  $proj_id1 = $_POST['proj1'];
  $sesion1 = $_POST['sesion1'];
  $query1 = "SELECT DISTINCT(cs.id), tcd.room_name, tcd.capacity FROM assigned_center AS ac INNER JOIN center_session AS cs ON cs.id = ac.session_id INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN test_center_details AS tcd ON tcd.test_center_id = tc.id WHERE session_id = '$sesion1'";
  $runData1 = mysqli_query($connection,$query1);
  $last_id = 0;
  $totalrecord = mysqli_num_rows($runData1);
  $total_candidate = 1;
  while($rowData1 = mysqli_fetch_array($runData1) AND $total_candidate > 0) {
    $room_name = $rowData1['room_name'];
    $capacity = $rowData1['capacity'];
    $totalrecord--;

?>
<u><h2 class="text-center"><?php echo $room_name ?></h2></u>

<table class="table table-hover table-bordered" style="font-size: 11px">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Roll No</th>
      <th>Name</th>
      <th>Father/Guardian</th>
      <th width="13%">CNIC No</th>
      <th>Post</th>
      <!-- <th>Picture</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $query = "SELECT cap.id AS apply_id, ac.roll_no, c.name,c.f_name, c.cnic, pp.post_name, pp.post_bps, c.image 
FROM candidate_applied_post AS cap 
    INNER JOIN projects_posts AS pp ON pp.id = cap.post_id 
    INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id 
    INNER JOIN center_session AS cs ON cs.id = ac.session_id 
    INNER JOIN test_centers AS tc ON tc.id = cs.center_id 
    INNER JOIN candidates AS c ON c.id = cap.candidate_id 
    INNER JOIN projects AS p ON p.id = pp.project_id 
WHERE p.id = '$proj_id1' AND cs.id = '$sesion1' AND ac.roll_no > $last_id ORDER BY ac.roll_no ASC LIMIT $capacity";
      $runData = mysqli_query($connection,$query);
      $totalData = mysqli_num_rows($runData);
      while($rowData = mysqli_fetch_array($runData)) {
      $count++;
      $roll_no = $rowData['roll_no'];
      $name = $rowData['name'];
      $f_name = $rowData['f_name'];
      $cnic = $rowData['cnic'];
      $post_name = $rowData['post_name'];
      $image = $rowData['image'];
      $path = "../../images/candidates/profile picture/".$image;
      $last_id = $rowData['roll_no'];
      if($totalData < $capacity)
      {
        $total_candidate = 0;
      }

      ?>
     
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $roll_no; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $f_name; ?></td>
        <td><?php echo $cnic; ?></td>
        <td><?php echo $post_name; ?></td>
        <!-- <td><img src="<?php echo $path ?>" width="100px" height="100px"></td> -->
      </tr>
      <?php } ?>
  </tbody>
</table>

<?php if($totalrecord > 0 AND $total_candidate > 0) { ?>
<div class="pagebreak"></div>

<div class="d-none d-print-block">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2 text-center">
        <a class="navbar-brand" href="https://uts.com.pk">
          <img src="../../images/uts-logo.png" alt="logo" width="200px" height="55px">
        </a>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-5 text-center mt-4">
        <h3 style="color: #00008B">Universal Testing Services</h3>
        <h5 class="text-danger">Candidate's List</h5 class="text-danger">
      </div>
    </div>
  </div>
  <hr class="shadow mt-0">
</div>

<?php } } }




//////////Candidate Attendance List ///////////////
if(isset($_POST['proj']) && isset($_POST['sesion2']))
{
  $proj_id1 = $_POST['proj'];
  $sesion1 = $_POST['sesion2'];
  $query1 = "SELECT DISTINCT(cs.id), tcd.room_name, tcd.capacity, cs.reporting_date, cs.start_time, cs.end_time, 
                cs.session_title, tc.center_name 
        FROM assigned_center AS ac 
            INNER JOIN center_session AS cs ON cs.id = ac.session_id 
            INNER JOIN test_centers AS tc ON tc.id = cs.center_id 
            INNER JOIN test_center_details AS tcd ON tcd.test_center_id = tc.id 
        WHERE session_id = '$sesion1'";
  $runData1 = mysqli_query($connection,$query1);
  $last_id = 0;
  $totalrecord = mysqli_num_rows($runData1);
  $total_candidate = 1;
  while($rowData1 = mysqli_fetch_array($runData1) AND $total_candidate > 0) {
    $room_name = $rowData1['room_name'];
    $capacity = $rowData1['capacity'];
    $reporting_date = $rowData1['reporting_date'];
    $start_time = $rowData1['start_time'];
    $end_time = $rowData1['end_time'];
    $session_title = $rowData1['session_title'];
    $center_name = $rowData1['center_name'];
    $totalrecord--;

       $queryPost = "SELECT pp.post_name FROM candidate_applied_post AS cap 
    INNER JOIN projects_posts AS pp ON pp.id = cap.post_id 
    INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id 
    INNER JOIN center_session AS cs ON cs.id = ac.session_id 
INNER JOIN projects AS p ON p.id = pp.project_id
     WHERE p.id = '$proj_id1' AND cs.id = '$sesion1' AND ac.roll_no > $last_id ORDER BY ac.roll_no ASC LIMIT $capacity";
      $runDataPosts = mysqli_query($connection,$queryPost);
      $allPosts = [];
      while($rowDataPost = mysqli_fetch_array($runDataPosts)) {
          if(!in_array($rowDataPost['post_name'], $allPosts))
            array_push($allPosts, $rowDataPost['post_name']);
      }


?>
<b><p class="m-0">Session: <?php echo $session_title." - ".$center_name; ?></p>
    <p class="m-0">Post(s): <?php echo implode(', ', $allPosts); ?></p>
<p class="m-0">Reporting Date/Time : <?php echo date("d-m-Y h:i a", strtotime($reporting_date)); ?></p>
<p class="m-0">Start Time : <?php echo date("h:i a", strtotime($start_time)); ?></p>
<p class="m-0">End Time : <?php echo date("h:i a", strtotime($end_time)); ?></p></b>

<u><h2 class="text-center"><?php echo $room_name ?></h2></u>

<table class="table table-hover table-bordered" style="font-size: 11px">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Roll No</th>
      <th>Name</th>
      <th>Father/Guardian</th>
      <th width="13%">CNIC No</th>
      <th>Post</th>
      <th>Picture</th> 
      <th width="15%">Signature</th>
 <!--       <th>Thumb impression</th>-->
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $query = "SELECT cap.id AS apply_id, ac.roll_no, c.name,c.f_name, c.cnic, pp.post_name, pp.post_bps, c.image 
FROM candidate_applied_post AS cap 
    INNER JOIN projects_posts AS pp ON pp.id = cap.post_id 
    INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id 
    INNER JOIN center_session AS cs ON cs.id = ac.session_id 
    INNER JOIN test_centers AS tc ON tc.id = cs.center_id 
    INNER JOIN candidates AS c ON c.id = cap.candidate_id 
    INNER JOIN projects AS p ON p.id = pp.project_id WHERE p.id = '$proj_id1' AND cs.id = '$sesion1' AND ac.roll_no > $last_id ORDER BY ac.roll_no ASC LIMIT $capacity";
      $runData = mysqli_query($connection,$query);
      $totalData = mysqli_num_rows($runData);
      while($rowData = mysqli_fetch_array($runData)) {
      $count++;
      $roll_no = $rowData['roll_no'];
      $name = $rowData['name'];
      $f_name = $rowData['f_name'];
      $cnic = $rowData['cnic'];
      $post_name = $rowData['post_name'];
      $image = $rowData['image'];
      $path = "../../images/candidates/profile picture/".$image;
      $last_id = $rowData['roll_no'];
      if($totalData < $capacity)
      {
        $total_candidate = 0;
      }

      ?>
     
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $roll_no; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $f_name; ?></td>
        <td><?php echo $cnic; ?></td>
        <td><?php echo $post_name; ?></td>
        <td>
            <?php if($image == '') { echo "Not Found"; } else { ?>
            <img src="<?php echo $path ?>" width="40px" height="40px">
            <?php } ?>
        </td> 
        <td></td>
          <td></td>
      </tr>
      <?php } ?>
  </tbody>
</table>

<?php if($totalrecord > 0 AND $total_candidate > 0) { ?>
<div class="pagebreak"></div>

<div class="d-none d-print-block">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2 text-center">
        <a class="navbar-brand" href="https://uts.com.pk">
          <img src="../../images/uts-logo.png" alt="logo" width="200px" height="55px">
        </a>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-5 text-center mt-4">
        <h3 style="color: #00008B">Universal Testing Services</h3>
        <h5 class="text-danger">Candidate's List</h5 class="text-danger">
      </div>
    </div>
  </div>
  <hr class="shadow mt-0">
</div>

<?php } } } ?>