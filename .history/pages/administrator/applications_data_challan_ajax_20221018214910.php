<?php
include "includes/db.php";


if(isset($_POST['postId']) && isset($_POST['cnic']))
{
  $postId = $_POST['postId'];
  // $city_id = $_POST['city_id'];
  $candCNIC = $_POST['cnic'];

?>
<table class="table table-hover datatable bg-white table-responsive"  style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
      <th>Image</th>
      <th class="printBlock">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$postId' AND c.cnic='$candCNIC' ORDER BY cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
        <input type="hidden" id="autoInc<?php echo $count ?>" value="<?php echo $count ?>">
        <input type="hidden" id="applyId<?php echo $count ?>" value="<?php echo $applyId ?>">
        <input type="hidden" id="cand_id<?php echo $count ?>" value="<?php echo $cand_id ?>">
        <input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $rowQ['image'] ?>">
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <td><b><?php echo $status ?></b></td>
      <td><?php echo $status_details ?></td>
      <td>
        
        <?php
          if($rowQ['image'] == NULL OR $rowQ['image'] == '')
          { 
            echo "Image Not Found";
          }
          else
          {
            echo '<a href="#image_view" data-toggle="modal" onclick="pic_view('.$count.')"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="'.$path.'" alt="Candidate Image"></a>';
          } 
          ?>
      </td>
      <td class="printBlock">
        <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<!-- export to csv -->
<table style="font-size: 11px; display: none" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$postId' AND c.cnic = '$candCNIC'  ORDER BY cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <td><b><?php echo $status ?></b></td>
      <td><?php echo $status_details ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php }



if(isset($_POST['postId']) && isset($_POST['city_id']))
{
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];
  $candStatus = $_POST['candStatus'];

?>
<table class="table table-hover datatable bg-white table-responsive"  style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father Name</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <!-- <th>Status Details</th>
      <th>Image</th> -->
      <th>Challan</th>
      <!-- <th class="printBlock">Action</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$postId' AND ct.id = '$city_id' AND cp.status = '$candStatus' ORDER BY cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
        <input type="hidden" id="autoInc<?php echo $count ?>" value="<?php echo $count ?>">
        <input type="hidden" id="applyId<?php echo $count ?>" value="<?php echo $applyId ?>">
        <input type="hidden" id="cand_id<?php echo $count ?>" value="<?php echo $cand_id ?>">
        <input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $rowQ['image'] ?>">
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <!-- <td><b><?php echo $status ?></b></td>
      <td><?php echo $status_details ?></td> -->
      <td>
        
        <?php
          if($rowQ['image'] == NULL OR $rowQ['image'] == '')
          { 
            echo "Image Not Found";
          }
          else
          {
            echo '<a href="#image_view" data-toggle="modal" onclick="pic_view('.$count.')"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="'.$path.'" alt="Candidate Image"></a>';
          } 
          ?>
      </td>
      <td class="printBlock">
        <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>  

<!-- export to csv -->
<table style="font-size: 11px; display: none" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$postId' AND ct.id = '$city_id' AND cp.status = '$candStatus' ORDER BY cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <td><b><?php echo $status ?></b></td>
      <td><?php echo $status_details ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php }


//all City Wise
if(isset($_POST['post_id2']))
{
  $post_id2 = $_POST['post_id2'];
  $candStatus = $_POST['candStatus'];

?>
<table  class="table table-hover datatable bg-white table-responsive"  style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father Name</th>
      <!-- <th>Gender</th> -->
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <!-- <th>Apply Date</th> -->
      <!-- <th>Application Status</th>
      <th>Status Details</th> -->
      <th>Thumbnail</th>
      <th class="printBlock">Full Challan</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$post_id2' AND cp.status = '$candStatus' ORDER BY ct.c_name, cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
         $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $path_challan = "../../images/candidates/challans/".$rowQ['challan_file'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr style="align-content:center; vertical-align:middle; text-align:center ;">
      <td>
        <?php echo $count ?>
        <input type="hidden" id="autoInc<?php echo $count ?>" value="<?php echo $count ?>">
        <input type="hidden" id="applyId<?php echo $count ?>" value="<?php echo $applyId ?>">
        <input type="hidden" id="cand_id<?php echo $count ?>" value="<?php echo $cand_id ?>">
        <input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $rowQ['image'] ?>">
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <!-- <td><?php //echo $gender ?></td> -->
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <!-- <td><?php //echo $apply_date ?></td> -->
      <!-- <td><b><?php // echo $status ?></b></td> -->
      <!-- <td><?php  //echo $status_details ?></td> -->
      <td>
        
        <?php
          if($rowQ['challan_file'] == NULL OR $rowQ['challan_file'] == '')
          { 
            echo "Image Not Found";
          }
          else
          {
            // echo '<a href="#image_view" data-toggle="modal" onclick="pic_view('.$count.')"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="90px;" height="90px"  src="'.$path.'" alt="Challan Image"></a>';
            echo '<a href="#image_view" data-toggle="modal" onclick="challan_view('.$count.')"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="130px;" height="130px"  src="'.$path_challan.'" alt="Challan Image"></a>';
            
          } 
          ?>
      </td>
      <td class="printBlock">
        <!-- <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a> -->

        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <!-- <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span> -->
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<!-- export to csv -->
<table style="font-size: 11px; display: none" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
      cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.post_id = '$post_id2' AND cp.status = '$candStatus' ORDER BY ct.c_name, cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
    ?>
    <tr>
      <td>
        <?php echo $count ?>
      </td>
      <td><?php echo $name ?></td>
      <td><?php echo $f_name ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $cnic ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $c_name ?></td>
      <td><?php echo $apply_date ?></td>
      <td><b><?php echo $status ?></b></td>
      <td><?php echo $status_details ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php }


//////////Candidate Picture///////////////
if(isset($_POST['pic_name']))
{
?>

<div class="modal-header bg-dark printColor">
  <h5 class="modal-title">Candidate's Picture</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $pic_name = $_POST['pic_name'];
  $path = "../../images/candidates/profile picture/".$_POST['pic_name'];
?>

<div class="modal-body">
  <div class="row text-center">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "98%" height="350px">
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<?php }


////////// Assiging Roll No Post Applied///////////////
if(isset($_POST['assign_roll_postId']))
{
  $postId = $_POST['assign_roll_postId'];

  $fetchData = "SELECT id FROM assigned_center WHERE post_id = '$postId' AND roll_no = '0'";
  $run = mysqli_query($connection,$fetchData);
  $assigned = mysqli_num_rows($run);
  if($assigned == '0')
  {
    $assigned = 0;
    $unassign = 0;
  }
  else
  {
    $fetchData = "SELECT id FROM candidate_applied_post WHERE post_id = '$postId' AND status = 'Accepted'";
    $run = mysqli_query($connection,$fetchData);
    $total = mysqli_num_rows($run);
    $unassign = $total - $assigned;
  }

  $data = array('assigned' => $assigned, 'unassign' => $unassign);

  echo json_encode($data);
  
}
?>