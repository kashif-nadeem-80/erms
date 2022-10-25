<?php
include "includes/db.php";


if(isset($_POST['proj']))
{
  $proj_id = $_POST['proj'];
  $city_id = $_POST['city_id'];
  $status = $_POST['status'];

?>
<table class="table table-bordered table-striped datatable bg-white table-responsive" id="export_table" style="font-size: 11px" data-page-length="100">
  <thead class="bg-dark printColor">
    <tr>
      <th width="6%">S.No</th>
      <th>Name</th>
      <th>Father/Guardian Name</th>
      <th>Gender</th>
      <th>CNIC No</th>
      <th>Contact No</th>
      <th class="printBlock">Image</th>
      <th class="text-center">Apply Info</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($status != 'all')
      {
        $fetchData = "SELECT c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE p.id = '$proj_id' AND (cp.city_id = '$city_id' OR 'all' = '$city_id') AND cp.status = '$status' GROUP BY cp.candidate_id HAVING COUNT(cp.candidate_id) > 1 ORDER BY c.name ASC";
      }
      else
      {
        $fetchData = "SELECT c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image FROM candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE p.id = '$proj_id' AND (cp.city_id = '$city_id' OR 'all' = '$city_id') AND (cp.status = 'Accepted' OR cp.status = 'Rejected') GROUP BY cp.candidate_id HAVING COUNT(cp.candidate_id) > 1 ORDER BY c.name ASC";
      }
      $runQ = mysqli_query($connection,$fetchData);
      $count = 0;
      while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        
        $cand_id = $rowQ['cand_id'];
        $name = $rowQ['name'];
        $cnic = $rowQ['cnic'];
        $phone = $rowQ['phone'];
        $f_name = $rowQ['f_name'];
        $gender = $rowQ['gender'];
        $path = "../../images/candidates/profile picture/".$rowQ['image'];
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
      <td class="printBlock">
        <?php
          if($rowQ['image'] == NULL OR $rowQ['image'] == '')
          { 
            echo "Image Not Found";
          }
          else
          {
            echo '<a href="'.$path.'" target="_blank"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="'.$path.'" alt="Candidate Image"></a>';
          } 
          ?>
      </td>
      <td>
        <table class="bg-white">
          <tr>
            <th>S.No</th>
            <th>Post</th>
            <th>Test Center</th>
            <th>Apply Date</th>
            <th>Application Status</th>
            <th>Status Details</th>
            <th class="printBlock">Action</th>
          </tr>
          <?php
            $fetchData2 = "SELECT cp.id AS apply_id, ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date, pp.post_name, cp.candidate_id FROM candidate_applied_post AS cp INNER JOIN projects_posts AS pp ON pp.id = cp.post_id INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE cp.candidate_id = '$cand_id' AND p.id = '$proj_id' ORDER BY pp.post_name ASC";
            $runQ2 = mysqli_query($connection,$fetchData2);
            $s_no = 0;
          while ($rowQ2 = mysqli_fetch_array($runQ2)) {
            $s_no++;
            $post_name = $rowQ2['post_name'];
            $applyId = $rowQ2['apply_id'];
            $cand_id = $rowQ2['candidate_id'];
            $c_name = $rowQ2['c_name'];
            $status = $rowQ2['status'];
            $status_details = $rowQ2['status_details'];
            $apply_date = date("d-m-Y",strtotime($rowQ2['apply_date']));
            $challan_file = $rowQ2['challan_file'];
            $challan_upload_date = date("d-m-Y",strtotime($rowQ2['challan_upload_date']));
          ?>
          <tr>
            <td>
              <?php echo $s_no ?>
              <input type="hidden" id="autoInc<?php echo $applyId ?>" value="<?php echo $applyId ?>">
              <input type="hidden" id="applyId<?php echo $applyId ?>" value="<?php echo $applyId ?>">
              <input type="hidden" id="cand_id<?php echo $applyId ?>" value="<?php echo $cand_id ?>">
              <input type="hidden" id="pic_name<?php echo $applyId ?>" value="<?php echo $rowQ['image'] ?>">
            </td>
            <td><?php echo $post_name ?></td>
            <td><?php echo $c_name ?></td>
            <td><?php echo $apply_date ?></td>
            <td><b><?php echo $status ?></b></td>
            <td><?php echo $status_details ?></td>
            <td class="printBlock">
              <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $applyId ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

              <a style="margin-top: 2px" onclick="challan_view(<?php echo $applyId ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

              <a style="margin-top: 2px" href="personal_info_view.php?can_id=<?php echo $cand_id ?>" class="detail btn btn-sm btn-warning shadow title" title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
              </a>
            </td>
          </tr>
        <?php } ?>
        </table>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<?php } ?>