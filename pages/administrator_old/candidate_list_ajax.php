<?php
include "includes/db.php";

//////////Candidate List Details///////////////
if(isset($_POST['post']) && isset($_POST['sesion']))
{
  $post_id = $_POST['post'];
  $sesion_id = $_POST['sesion'];
?>

<table class="table table-hover datatable table-bordered" style="font-size: 12px">
  <thead>
    <tr>
      <th>S.No</th>
      <th>Roll No</th>
      <th>Name</th>
      <th>Father/Guardian</th>
      <th>CNIC No</th>
      <th>Post</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $query = "SELECT ac.roll_no, c.name,c.f_name, c.cnic, pp.post_name, pp.post_bps FROM candidate_applied_post AS cap INNER JOIN projects_posts AS pp ON pp.id = cap.post_id INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id INNER JOIN center_session AS cs ON cs.id = ac.session_id INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN candidates AS c ON c.id = cap.candidate_id WHERE pp.id = '$post_id' AND cs.id = '$sesion_id' ORDER BY ac.roll_no ASC";
      $runData = mysqli_query($connection,$query);
      while($rowData = mysqli_fetch_array($runData)) {
      $count++;
      $roll_no = $rowData['roll_no'];
      $name = $rowData['name'];
      $f_name = $rowData['f_name'];
      $cnic = $rowData['cnic'];
      $post_name = $rowData['post_name'];
      $post_bps = $rowData['post_bps'];
      ?>
    
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $roll_no; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $f_name; ?></td>
        <td><?php echo $cnic; ?></td>
        <td><?php echo $post_name." (BPS-".$post_bps.")"; ?></td>      </tr>
      <?php } ?>
  </tbody>
</table>
<?php }




//////////Candidate List Details Project Wise///////////////
if(isset($_POST['proj']) && isset($_POST['sesion2']))
{
  $proj_id = $_POST['proj'];
  $sesion2 = $_POST['sesion2'];
  $query1 = "SELECT DISTINCT(cs.id), tcd.room_name, tcd.capacity FROM assigned_center AS ac INNER JOIN center_session AS cs ON cs.id = ac.session_id INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN test_center_details AS tcd ON tcd.test_center_id = tc.id WHERE session_id = '1'";
  $runData1 = mysqli_query($connection,$query1);
  $last_id = 0;
  $totalrecord = mysqli_num_rows($runData1);
  while($rowData1 = mysqli_fetch_array($runData1)) {
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
      <th>Picture</th>
      <th width="13%">Signature</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $query = "SELECT cap.id AS apply_id, ac.roll_no, c.name,c.f_name, c.cnic, pp.post_name, pp.post_bps, c.image, BIN(roll_no) AS roll_binary FROM candidate_applied_post AS cap INNER JOIN projects_posts AS pp ON pp.id = cap.post_id INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id INNER JOIN center_session AS cs ON cs.id = ac.session_id INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN candidates AS c ON c.id = cap.candidate_id INNER JOIN projects AS p ON p.id = pp.project_id WHERE p.id = '$proj_id' AND cs.id = '$sesion2' AND BIN(roll_no) > $last_id ORDER BY roll_binary ASC LIMIT $capacity";
      $runData = mysqli_query($connection,$query);
      while($rowData = mysqli_fetch_array($runData)) {
      $count++;
      $roll_no = $rowData['roll_no'];
      $name = $rowData['name'];
      $f_name = $rowData['f_name'];
      $cnic = $rowData['cnic'];
      $post_name = $rowData['post_name'];
      $image = $rowData['image'];
      $path = "../../images/candidates/profile picture/".$image;
      $last_id = $rowData['roll_binary'];
      ?>
     
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $roll_no; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $f_name; ?></td>
        <td><?php echo $cnic; ?></td>
        <td><?php echo $post_name; ?></td>
        <td><img src="<?php echo $path ?>" width="100px" height="100px"></td>
        <td></td>
      </tr>
      <?php } ?>
  </tbody>
</table>

<?php if($totalrecord > 0) { ?>
<div class="pagebreak"></div>

<div class="d-none d-print-block">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2 text-center">
        <a class="navbar-brand" href="https://uts.com.pk">
          <img src="../../images/logo.png" alt="logo" width="90" height="85">
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