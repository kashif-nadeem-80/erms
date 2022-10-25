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
  $disId = $_POST['disId'];
  $gender = $_POST['gender'];
  $top_list = $_POST['top_list'];

?>
<table class="table table-hover table-bordered datatable table-responsive bg-white" style="font-size: 10px" data-page-length="100" id="export_table">
  <thead class="bg-dark printColor">
    <tr>
      <th>S.No</th>
      <th>Picture</th>
      <th>Post</th>
      <th>Roll #</th>
      <th>Name</th>
      <th class="printBlock">Father Name</th>
      <th>CNIC #</th>
      <th class="printBlock">Gender</th>
      <th class="printBlock">Domocile's Province</th>
      <th class="printBlock">Domocile's District</th>
      <th class="printBlock">Test City</th>
      <th class="printBlock">Qualification</th>
      <th>Contact</th>
      <th class="printBlock">Email</th>
      <th class="printBlock">D.O.B</th>
      <th class="printBlock">Marital Status</th>
      <th class="printBlock">Religion</th>
      <th class="printBlock">Address</th>
      <th class="printBlock">Father Occupation</th>
      <th class="printBlock">Father Contact</th>
      <th>Written Test</th>
      <!-- <th>Typing Test</th>
      <th>Short-Hand Test</th>
      <th>Physical Test</th> -->
      <th>Total Aggregate</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
      if($gender == 'Male')
      {
        $fetchData = "SELECT prov.pro_name, ct.c_name, c.id, pw.`written_marks`, pw.`written_weightage`, pw.`typing_marks`, pw.`typing_weightage`, pw.`shorthand_marks`, pw.`shorthand_weightage`, c.`name`, c.`cnic`, c.`email`, c.`phone`, c.`password`, c.`image`, c.`status`, c.`signUpDate`, c.`f_name`, c.`gender`, c.`disability`, c.`disable_file`, c.`dob`, c.`city`, c.`postal_address`, c.`telephone`, c.`religion`, c.`gov_employee`, c.`simple_exper`, c.`retired_pak`, c.`army_exper`, c.`widow_gov_emp`, c.`widow_file`, c.`created_by`, c.`marital_status`, c.`father_occup`, c.`f_contact`, d.dis_name, r.roll_no, r.written_result, r.typing_result, r.shorthand_result, r.physical_result, pp.post_name FROM result AS r INNER JOIN assigned_center AS a ON a.roll_no = r.roll_no INNER JOIN projects_posts AS pp ON pp.id = a.post_id INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN project_weightage AS pw ON pw.project_id = p.id INNER JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id INNER JOIN candidates AS c ON c.id = ca.candidate_id LEFT JOIN district AS d ON d.id = c.district_id LEFT JOIN province AS prov ON prov.id = d.pro_id LEFT JOIN city AS ct ON ct.id = ca.city_id WHERE (ca.post_id = '$postId' OR '$postId' = 'all') AND c.gender = 'Male' AND (d.id = '$disId' OR '$disId' = 'all') AND p.id = '$proj_id' ORDER BY r.written_result DESC, pp.post_name, ca.id ASC LIMIT $top_list";
      }
      elseif($gender == 'Female')
      {
        $fetchData = "SELECT prov.pro_name, ct.c_name, c.id, pw.`written_marks`, pw.`written_weightage`, pw.`typing_marks`, pw.`typing_weightage`, pw.`shorthand_marks`, pw.`shorthand_weightage`, c.`name`, c.`cnic`, c.`email`, c.`phone`, c.`password`, c.`image`, c.`status`, c.`signUpDate`, c.`f_name`, c.`gender`, c.`disability`, c.`disable_file`, c.`dob`, c.`city`, c.`postal_address`, c.`telephone`, c.`religion`, c.`gov_employee`, c.`simple_exper`, c.`retired_pak`, c.`army_exper`, c.`widow_gov_emp`, c.`widow_file`, c.`created_by`, c.`marital_status`, c.`father_occup`, c.`f_contact`, d.dis_name, r.roll_no, r.written_result, r.typing_result, r.shorthand_result, r.physical_result, pp.post_name FROM result AS r INNER JOIN assigned_center AS a ON a.roll_no = r.roll_no INNER JOIN projects_posts AS pp ON pp.id = a.post_id INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN project_weightage AS pw ON pw.project_id = p.id INNER JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id INNER JOIN candidates AS c ON c.id = ca.candidate_id LEFT JOIN district AS d ON d.id = c.district_id LEFT JOIN province AS prov ON prov.id = d.pro_id LEFT JOIN city AS ct ON ct.id = ca.city_id WHERE (ca.post_id = '$postId' OR '$postId' = 'all') AND c.gender = 'Female' AND (d.id = '$disId' OR '$disId' = 'all') AND p.id = '$proj_id' ORDER BY r.written_result DESC, pp.post_name, ca.id ASC LIMIT $top_list";
      }
      else
      {
        $fetchData = "SELECT prov.pro_name, ct.c_name, c.id, pw.`written_marks`, pw.`written_weightage`, pw.`typing_marks`, pw.`typing_weightage`, pw.`shorthand_marks`, pw.`shorthand_weightage`, c.`name`, c.`cnic`, c.`email`, c.`phone`, c.`password`, c.`image`, c.`status`, c.`signUpDate`, c.`f_name`, c.`gender`, c.`disability`, c.`disable_file`, c.`dob`, c.`city`, c.`postal_address`, c.`telephone`, c.`religion`, c.`gov_employee`, c.`simple_exper`, c.`retired_pak`, c.`army_exper`, c.`widow_gov_emp`, c.`widow_file`, c.`created_by`, c.`marital_status`, c.`father_occup`, c.`f_contact`, d.dis_name, r.roll_no, r.written_result, r.typing_result, r.shorthand_result, r.physical_result, pp.post_name FROM result AS r INNER JOIN assigned_center AS a ON a.roll_no = r.roll_no INNER JOIN projects_posts AS pp ON pp.id = a.post_id INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN project_weightage AS pw ON pw.project_id = p.id INNER JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id INNER JOIN candidates AS c ON c.id = ca.candidate_id LEFT JOIN district AS d ON d.id = c.district_id LEFT JOIN province AS prov ON prov.id = d.pro_id LEFT JOIN city AS ct ON ct.id = ca.city_id WHERE (ca.post_id = '$postId' OR '$postId' = 'all') AND (d.id = '$disId' OR '$disId' = 'all') AND p.id = '$proj_id' ORDER BY r.written_result DESC, pp.post_name, ca.id ASC LIMIT $top_list";
      }
      $runData = mysqli_query($connection,$fetchData);

      $countRow = mysqli_num_rows($runData);
      if($countRow > 0)
      {
        while($rowData = mysqli_fetch_array($runData))
        {
          $count++;
          $pro_name = $rowData['pro_name'];
          $c_name = $rowData['c_name'];
          $cand_id = $rowData['id'];

          $edu = "SELECT d.deg_name FROM education AS e INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE e.candi_id = '$cand_id' AND el.id = (SELECT max(el.id) FROM education AS e INNER JOIN degree AS d ON d.id = e.degree_id INNER JOIN edu_level AS el ON el.id = d.level_id WHERE e.candi_id = '$cand_id')";
          $runEdu = mysqli_query($connection,$edu);
          @$rowEdu = mysqli_fetch_array($runEdu);
          @$deg_name = $rowEdu['deg_name'];

          $roll_no = $rowData['roll_no'];
          $post_name = $rowData['post_name'];
          $name = $rowData['name'];
          $f_name = $rowData['f_name'];
          $cnic = $rowData['cnic'];
          $dis_name = $rowData['dis_name'];
          $gender = $rowData['gender'];
          $email = $rowData['email'];
          $phone = $rowData['phone'];
          $image = $rowData['image'];
          $imagePath = "../../images/candidates/profile picture/".$image;
          $dob = date("d-m-Y",strtotime($rowData['dob']));
          $postal_address = $rowData['postal_address'];
          $religion = $rowData['religion'];
          $marital_status = $rowData['marital_status'];
          $father_occup = $rowData['father_occup'];
          $f_contact = $rowData['f_contact'];

          $written_marks   = $rowData['written_marks'];
          $written_weightage   = $rowData['written_weightage'];
          $typing_marks   = $rowData['typing_marks'];
          $typing_weightage   = $rowData['typing_weightage'];
          $short_marks   = $rowData['shorthand_marks'];
          $short_weightage   = $rowData['shorthand_weightage'];

          $result = $rowData['written_result'];

          if($result == NULL OR $result == 0 OR $result == '')
          {
            $result = 0;
          }

          $typing_result = $rowData['typing_result'];
          if($typing_result == NULL OR $typing_result == 0 OR $typing_result == '')
          {
            $typing_result = 0;
          }

          $shorthand_result = $rowData['shorthand_result'];
          if($shorthand_result == NULL OR $shorthand_result == 0 OR $shorthand_result == '')
          {
            $shorthand_result = 0;
          }
 
          if($rowData['physical_result'] != 0 OR $rowData['physical_result'] != '')
          {
          
            $physical_result = $rowData['physical_result'];
          }
          else
          {
            $physical_result = "N/A";
          }

          $aggregate = (($result/$written_marks)*$written_weightage) + (($typing_result/$typing_marks)*$typing_weightage) + (($shorthand_result/$short_marks)*$short_weightage);
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td>
        <?php if($image != '') { ?>
        <img src="<?php echo $imagePath; ?>" class="rounded" width="70px" height="70px">
      <?php } else { echo "Not Found"; } ?>
      </td>
      <td><?php echo $post_name; ?></td>
      <td><?php echo $roll_no; ?></td>
      <td><?php echo $name; ?></td>
      <td class="printBlock"><?php echo $f_name; ?></td>
      <td><?php echo $cnic; ?></td>
      <td class="printBlock"><?php echo $gender; ?></td>
      <td class="printBlock"><?php echo $pro_name; ?></td>
      <td class="printBlock"><?php echo $dis_name; ?></td>
      <td class="printBlock"><?php echo $c_name; ?></td>
      <td class="printBlock"><?php echo $deg_name; ?></td>
      <td><?php echo $phone; ?></td>
      <td class="printBlock"><?php echo $email; ?></td>
      <td class="printBlock"><?php echo $dob; ?></td>
      <td class="printBlock"><?php echo $marital_status; ?></td>
      <td class="printBlock"><?php echo $religion; ?></td>
      <td class="printBlock"><?php echo $postal_address; ?></td>
      <td class="printBlock"><?php echo $father_occup; ?></td>
      <td class="printBlock"><?php echo $f_contact; ?></td>
      <td><?php echo $result."/".$written_marks; ?></td>
      <!-- <td><?php echo $typing_result."/".$typing_marks; ?></td>
      <td><?php echo $shorthand_result."/".$short_marks; ?></td>
      <td><?php echo $physical_result; ?></td> -->
      <td><?php echo $aggregate; ?></td>
    </tr>
  <?php } } ?>
  </tbody>
</table>
<?php } ?>