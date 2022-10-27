<?php
include "includes/db.php";


if(isset($_POST['cnic']))
{
  //$postId = $_POST['postId'];
  //$city_id = $_POST['city_id'];
  $cnic = $_POST['cnic'];
?>

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-striped table-bordered datatable bg-white text-center" style="font-size: 12px" data-page-length="50">
							<thead class="bg-dark">
								<tr>
									<th>S.No</th>
									<th>Roll No</th>
									<th>Name</th>
									<th>F/G Name</th>
									<th>Gender</th>
									<th>CNIC</th>
									<th>Image</th>
									<th>Post</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								$query = "SELECT c.id AS cand_id, ac.roll_no,c.name,c.f_name,c.gender,c.cnic,c.image,
                                    pp.post_name,pp.post_bps, BIN(roll_no) AS roll_binary 
                                    FROM assigned_center AS ac 
                                        INNER JOIN projects_posts AS pp ON pp.id = ac.post_id 
                                        LEFT JOIN projects AS pr ON pr.id = pp.project_id
                                        INNER JOIN candidate_applied_post AS cap ON cap.id = ac.cand_applied_id 
                                        INNER JOIN candidates AS c ON c.id = cap.candidate_id 
                                    WHERE ac.roll_no != '0' AND pr.status = '1' and c.id > 39500
                                    ORDER BY ac.roll_no ASC
                                    limit 700";
								$runData = mysqli_query($connection,$query);
								while($rowData = mysqli_fetch_array($runData)) {
								$count++;
								$roll_no = $rowData['roll_no'];
								$cand_id = $rowData['cand_id'];
								$name = $rowData['name'];
								$f_name = $rowData['f_name'];
								$gender = $rowData['gender'];
								$cnic = $rowData['cnic'];
								$image = $rowData['image'];
								$path = "../../images/candidates/profile picture/".$image;
								$post = $rowData['post_name'];
								$bps = $rowData['post_bps'];
								?>
								
								
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $roll_no; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $f_name; ?></td>
									<td><?php echo $gender; ?></td>
									<td><?php echo $cnic; ?></td>
									<td>
										
										<?php if($image == NULL OR $image == '')
										{
										echo "Image Not Found";
										}
										else
										{ ?>
										<input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $image ?>">
										<a href="#image_view" data-toggle="modal" onclick="pic_view(<?php echo $count ?>)"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="<?php echo $path ?>" alt="Candidate Image"></a>
										<?php } ?>
									</td>
									<td><b><?php echo $post." (BPS-".$bps.")"; ?></b></td>
									<td><a href="roll_no_view.php?roll_no=<?php echo $roll_no ?>&cand_id=<?php echo $cand_id ?>" class="btn btn-sm btn-warning title shadow"><i class="fa fa-eye"></i></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



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
      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, 
            ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date 
            FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id 
            INNER JOIN projects_posts AS pp ON pp.id = cp.post_id 
            LEFT JOIN city AS ct ON ct.id = cp.city_id 
            WHERE cp.post_id = '$postId' AND ct.id = '$city_id' AND cp.status = '$candStatus' ORDER BY cp.id ASC";
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

        <a style="margin-top: 2px" href="personal_info_view.php?can_id=<?php echo $cand_id ?>" class="detail btn btn-sm btn-warning shadow title" title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
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
    $rowperpage = $_POST['length'];
    $row = $_POST['start'];
    $candStatus = $_POST['candStatus'];
    $draw = $_POST['draw'];
    $totalRecordsSql = "SELECT count(*) AS total
            FROM candidate_applied_post AS cp 
            WHERE cp.post_id = '$post_id2' AND cp.status = '$candStatus'";
    $totalRecordsQ = mysqli_query($connection,$totalRecordsSql);
    $records = mysqli_fetch_assoc($totalRecordsQ);
    $totalRecords = $records['total'];
    $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, 
            ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date 
            FROM candidate_applied_post AS cp 
            INNER JOIN candidates AS c ON c.id = cp.candidate_id 
            INNER JOIN projects_posts AS pp ON pp.id = cp.post_id 
            LEFT JOIN city AS ct ON ct.id = cp.city_id 
            WHERE cp.post_id = '$post_id2' AND cp.status = '$candStatus' ORDER BY ct.c_name, cp.id ASC LIMIT $row, $rowperpage";
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      $cData = [];
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $applyId = $rowQ['apply_id'];
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $f_name = $rowQ['f_name'];
        $image = '';
        if($rowQ['image']) {
            $path = "../../images/candidates/profile picture/" . $rowQ['image'];
            $image = "<img src='$path' width='80' height='80' />";
        }
        $gender = $rowQ['gender'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $c_name = $rowQ['c_name'];
        $status = $rowQ['status'];
        $status_details = $rowQ['status_details'];
        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
        $challan_file = $rowQ['challan_file'];
        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
        array_push($cData, [
           'sno' => $count,
           'name' => $rowQ['name'],
            'fatherName' => $rowQ['f_name'],
            'gender' => $rowQ['gender'],
            'cnic' => $rowQ['cnic'],
            'contact_no' => $rowQ['phone'],
            'test_city' => '',
            'apply_date' => $apply_date,
            'status' => $status,
            'status_detail' => $status_details,
            'image' => $image,
            'action' => '<a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1('. $count .')" title="Update Status" href="#edit" data-toggle="modal"><i class="fa fa-edit"></i></a>

        <a style="margin-top: 2px" onclick="challan_view('. $count .')" href="#edit" data-toggle="modal" title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <a style="margin-top: 2px" href="personal_info_view.php?can_id='.$cand_id.'" class="detail btn btn-sm btn-warning shadow title" title="Cadidate\'s Details"><span><i class="fa fa-eye"></i></span>
        </a>
        <input type="hidden" id="autoInc'. $count .'" value="'.$count.'">
        <input type="hidden" id="applyId'. $count .'" value="'.$applyId.'">
        <input type="hidden" id="cand_id'. $count .'" value="'.$cand_id.'">
        <input type="hidden" id="pic_name'. $count .'" value="'.$rowQ['image'].'">
        '
        ]);
    }
    echo json_encode([
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecords,
        "aaData" => $cData
    ]);
}


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
        <a href="<?php echo $path ?>" target="_blank"><img src="<?php echo $path ?>" width = "98%" height="350px"></a>
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