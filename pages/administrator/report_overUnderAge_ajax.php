<?php
include "includes/db.php";

if(isset($_POST['projId']))
{
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  echo "<option value='all'>All</option>";
  while ($row = mysqli_fetch_array($run)) {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];
    $age_lower = $row['age_lower'];
    $age_upper = $row['age_upper'];

    echo "<option value='$postId'>$postname BPS($postbps) - Age($age_lower - $age_upper)</option>";
  }
}



if(isset($_POST['Overage']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];
  $uptoDate = $_POST['uptoDate'];

?>
<table class="table table-hover datatable bg-white table-responsive" style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Age</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $fetchData = "SELECT (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AS age, pp.age_upper, cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE pp.age_upper < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AND p.id = '$proj_id' AND (cp.post_id = '$postId' OR 'all' = '$postId') AND (ct.id = '$city_id' OR 'all' = '$city_id') ORDER BY pp.post_name, ct.c_name, c.name ASC";
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
        $age = FLOOR($rowQ['age'])." +";
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
      <td><?php echo $age ?></td>
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
      <td>
        <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php }


if(isset($_POST['Underage']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];
  $uptoDate = $_POST['uptoDate'];

?>
<table class="table table-hover datatable bg-white table-responsive" style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC NO</th>
      <th>Age</th>
      <th>Contact No</th>
      <th>Test City</th>
      <th>Apply Date</th>
      <th>Application Status</th>
      <th>Status Details</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $fetchData = "SELECT (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AS age, pp.age_upper, cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE pp.age_lower > (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AND p.id = '$proj_id' AND (cp.post_id = '$postId' OR 'all' = '$postId') AND (ct.id = '$city_id' OR 'all' = '$city_id') ORDER BY pp.post_name, ct.c_name, c.name ASC";
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
        $age = FLOOR($rowQ['age'])." +";
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
      <td><?php echo $age ?></td>
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
      <td>
        <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

        <a style="margin-top: 2px" href="#info_appl" onclick="applicant_view(<?php echo $count ?>)" class="detail btn btn-sm btn-warning shadow title" data-toggle='modal' title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
        </a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php } ?>