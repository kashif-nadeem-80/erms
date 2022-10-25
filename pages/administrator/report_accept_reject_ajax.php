<?php
include "includes/db.php";

if(isset($_POST['projId']))
{
  $projId = $_POST['projId'];
  $fetch = "SELECT * FROM projects_posts WHERE project_id = '$projId'";
  $run = mysqli_query($connection,$fetch);
  echo "<option value='all'>All</option>";
  while ($row = mysqli_fetch_array($run))
  {
    $postId = $row['id'];
    $postname = $row['post_name'];
    $postbps = $row['post_bps'];

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}


if(isset($_POST['proj_id']) && isset($_POST['postId']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $list_type = $_POST['list_type'];

?>
<table class="table table-hover table-bordered datatable table-responsive bg-white" style="font-size: 10px" data-page-length="9999999" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Post</th>
      <th>Picture</th>
      <th>Name</th>
      <th>Father Name</th>
      <th>Gender</th>
      <th>CNIC #</th>
      <th>D.O.B</th>
      <th>Address</th>
      <th>Personal Contact</th>
      <th>Other Contact</th>
      <th>Email</th>
      <th>Religion</th>
        <th>Experience</th>
      <th>Education</th>
      <th>Obtained/Total Marks</th>
      <th>Test City</th>
      <th>Application Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      $fetchData = "SELECT c.id,pp.post_name,c.image,c.name,c.f_name,c.gender,c.cnic,c.dob,c.postal_address,c.phone,
       c.telephone,c.email,c.religion, ct.c_name, ca.status_details, ca.experienceInYears,
       (
            SELECT GROUP_CONCAT(el.level_name SEPARATOR ', ')
            from education AS e 
            LEFT JOIN degree AS deg ON e.degree_id=deg.id 
            LEFT JOIN edu_level AS el ON deg.level_id=el.id WHERE c.id=e.candi_id 
            ORDER BY e.passing_year ) AS education_level,
            (
            SELECT GROUP_CONCAT(CONCAT(e.obtain_marks,'/',e.total_marks) SEPARATOR ', ')
            from education AS e 
             WHERE c.id=e.candi_id 
            ORDER BY e.passing_year ) AS marks
        FROM candidate_applied_post AS ca 
            INNER JOIN projects_posts AS pp ON pp.id = ca.post_id 
            INNER JOIN projects AS p ON p.id = pp.project_id 
            INNER JOIN candidates AS c ON c.id = ca.candidate_id 
            LEFT JOIN city AS ct ON ct.id = ca.city_id 
        WHERE (ca.post_id = '$postId' OR '$postId' = 'all')
          AND ca.status = '$list_type' AND p.id = '$proj_id' ORDER BY pp.post_name,c.gender,c.name ASC";
      $runData = mysqli_query($connection,$fetchData);

      $countRow = mysqli_num_rows($runData);
      if($countRow > 0)
      {
        while($rowData = mysqli_fetch_array($runData))
        {
          $count++;
          $post_name = $rowData['post_name'];
          $image = $rowData['image'];
          $imagePath = "../../images/candidates/profile picture/".$image;
          $name = $rowData['name'];
          $cand_id = $rowData['id'];
          $f_name = $rowData['f_name'];
          $gender = $rowData['gender'];
          $cnic = $rowData['cnic'];
          $dob = date("d-m-Y",strtotime($rowData['dob']));
          $postal_address = $rowData['postal_address'];
          $phone = $rowData['phone'];
          $telephone = $rowData['telephone'];
          $email = $rowData['email'];
          $religion = $rowData['religion'];
          $status_detail = $rowData['status_details'];
          $experienceInYears = $rowData['experienceInYears'];

//          $edu = "SELECT e.obtain_marks, e.total_marks, d.deg_name, el.level_name FROM education AS e INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE e.candi_id = '$cand_id' AND el.id = (SELECT max(el.id) FROM education AS e INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE e.candi_id = '$cand_id')";
//          $runEdu = mysqli_query($connection,$edu);
//          @$rowEdu = mysqli_fetch_array($runEdu);
//
//          @$deg_name = $rowEdu['deg_name'];
//          @$level_name = $rowEdu['level_name'];
//          @$obtain_marks = $rowEdu['obtain_marks'];
//          @$total_marks = $rowEdu['total_marks'];
            $level_name = $rowData['education_level'];
            $marks = $rowData['marks'];
            $education_array = explode(',', $level_name);
            $marks_array = explode(',', $marks);
          $c_name = $rowData['c_name'];
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $post_name; ?></td>
      <td>
        <?php if($image != '') { ?>
        <a href="<?php echo $imagePath; ?>" target="_blank"><img src="<?php echo $imagePath; ?>" class="rounded" width="70px" height="70px"></a>
      <?php } else { echo "Not Found"; } ?>
      </td>
      
      <td><?php echo $name; ?></td>
      <td><?php echo $f_name; ?></td>
      <td><?php echo $gender; ?></td>
      <td><?php echo $cnic; ?></td>
      <td><?php echo $dob; ?></td>
      <td><?php echo $postal_address; ?></td>
      <td><?php echo $phone; ?></td>
      <td><?php echo $telephone; ?></td>
      <td><?php echo $email; ?></td>
      <td><?php echo $religion; ?></td>
      <td><?php echo $experienceInYears; ?></td>
      <td><?php
          if(count($education_array) > 1) {
              foreach ($education_array as $e) {
                  echo $e . '<hr style="margin: 0">';
              }
          }
          ?></td>
      <td><?php
          if(count($marks_array) > 1) {
              foreach ($marks_array as $m) {
                  echo $m . '<hr style="margin: 0">';
              }
          }
          ?></td>
      <td><?php echo $c_name; ?></td>
      <td><?php echo $list_type === 'Accepted' ? 'Accepted' : 'Rejected<br>'.$status_detail; ?></td>
    </tr>
  <?php } } ?>
  </tbody>
</table>
<?php } ?>