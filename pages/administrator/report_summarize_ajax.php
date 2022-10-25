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

    echo "<option value='$postId'>$postname BPS($postbps)</option>";
  }
}


if(isset($_POST['proj_id']) && isset($_POST['postId']) && isset($_POST['city_id']) && isset($_POST['summary'])) {
    $proj_id = $_POST['proj_id'];
    $postId = $_POST['postId'];
    $city_id = $_POST['city_id'];
    ?>
    <table class="table table-hover table-bordered datatable bg-white" style="font-size: 11px" data-page-length="100" id="export_table">
        <thead class="bg-dark">
        <tr>
            <th width="6%">S.No</th>
            <th>Post</th>
            <!--      <th>City</th>-->
            <th class="text-center">Apply Male</th>
            <th class="text-center">Apply Female</th>
            <th class="text-center">Apply Other</th>
            <th class="text-center">Not Mentioned</th>
            <th class="text-center">Total Apply</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $where = "pp.project_id='$proj_id'";
        if($postId != 'all' && $postId != '') {
            $where .= " AND pp.id='$postId'";
        }
        $whereCity = '';
        if($city_id != 'all' && $city_id != '') {
            $whereCity = " AND cap.city_id='$city_id'";
        }
        $fetchData = "SELECT  pp.*,
            (SELECT count(*) FROM candidate_applied_post AS cap LEFT JOIN candidates AS c ON cap.candidate_id=c.id where post_id=pp.id AND c.gender='Male' $whereCity) AS male,
            (SELECT count(*) FROM candidate_applied_post AS cap LEFT JOIN candidates AS c ON cap.candidate_id=c.id where post_id=pp.id AND c.gender='Female' $whereCity) AS female,
            (SELECT count(*) FROM candidate_applied_post AS cap LEFT JOIN candidates AS c ON cap.candidate_id=c.id where post_id=pp.id AND c.gender='other' $whereCity) AS other,
            (SELECT count(*) FROM candidate_applied_post AS cap LEFT JOIN candidates AS c ON cap.candidate_id=c.id where post_id=pp.id AND c.gender IS NULL $whereCity ) AS not_mentioned,
            (SELECT count(*) FROM candidate_applied_post AS cap where post_id=pp.id $whereCity ) AS total
            FROM projects_posts AS pp
            
            Where $where
            GROUP BY pp.id";
        $runQ = mysqli_query($connection,$fetchData);
        $count = 0;
        while ($rowQ = mysqli_fetch_array($runQ)) {
            $count++;
            $post_name = $rowQ['post_name'];
//        $c_name = $rowQ['c_name'];
            $male = $rowQ['male'];
            $female = $rowQ['female'];
            $other = $rowQ['other'];
            $total = $rowQ['total'];
            $not_men = $rowQ['not_mentioned'];
            ?>
            <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $post_name ?></td>
                <!--      <td>--><?php //echo $c_name ?><!--</td>-->
                <td class="male text-center"><?php echo $male ?></td>
                <td class="female text-center"><?php echo $female ?></td>
                <td class="other text-center"><?php echo $other ?></td>
                <td class="notMention text-center"><?php echo $not_men ?></td>
                <td class="total text-center"><?php echo $total ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot class="bg-secondary font-weight-bold text-center">
        <tr>
            <td>&nbsp;</td>
            <!--        <td>&nbsp;</td>-->
            <td  align="right">Total</td>
            <td id="sumMale"></td>
            <td id="sumFemale"></td>
            <td id="sumOther"></td>
            <td id="sumNotMention"></td>
            <td id="sumTotal"></td>
        </tr>
        </tfoot>
    </table>
        <?php
}

if(isset($_POST['proj_id']) && isset($_POST['postId']) && isset($_POST['city_id'])  && !isset($_POST['summary']))
{
  $proj_id = $_POST['proj_id'];
  $postId = $_POST['postId'];
  $city_id = $_POST['city_id'];

        $where = "pp.project_id='$proj_id'";
        if($postId != 'all' && $postId != '') {
            $where .= " AND cap.post_id='$postId'";
        }
        if($city_id != 'all' && $city_id != '') {
            $where .= " AND cap.city_id='$city_id'";
        }
        $today = date('Y-m-d');

        $rowperpage = $_POST['length'];
        $row = $_POST['start'];

        $draw = $_POST['draw'];
        $totalRecordsSql = "SELECT  count(*) AS total
            FROM candidate_applied_post AS cap 
            LEFT JOIN candidates c ON cap.candidate_id = c.id 
            LEFT JOIN city AS cit ON cap.city_id=cit.id 
            LEFT JOIN projects_posts AS pp ON cap.post_id=pp.id 
            LEFT JOIN district AS d ON c.district_id=d.id 
            Where $where";
        $totalRecordsQ = mysqli_query($connection,$totalRecordsSql);
        $records = mysqli_fetch_assoc($totalRecordsQ);
        $totalRecords = $records['total'];



        $fetchData = "SELECT  pp.post_name, c.f_name,c.army_exper, c.simple_exper, c.name AS candidate_name, c.phone, c.email, c.cnic, c.gender, c.dob,
       c.postal_address,cit.c_name, d.dis_name AS domicile, cap.experienceInYears, c.gov_employee, cap.challan_file, 
       (SELECT GROUP_CONCAT(el.level_name SEPARATOR ', ') from education AS e LEFT JOIN degree AS deg ON e.degree_id=deg.id 
           LEFT JOIN edu_level AS el ON deg.level_id=el.id 
            WHERE c.id=e.candi_id ORDER BY e.passing_year ) AS education_level,
        (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$today')/365.28),3)) AS age
            
            FROM candidate_applied_post AS cap 
            LEFT JOIN candidates c ON cap.candidate_id = c.id 
            LEFT JOIN city AS cit ON cap.city_id=cit.id 
            LEFT JOIN projects_posts AS pp ON cap.post_id=pp.id 
            LEFT JOIN district AS d ON c.district_id=d.id 
            Where $where  LIMIT $row, $rowperpage";
        $cData = [];
        $runQ = mysqli_query($connection,$fetchData);
        $count = 0;
        while ($rowQ = mysqli_fetch_array($runQ)) {
            $count++;
            $post_name = $rowQ['post_name'];
            $name = $rowQ['candidate_name'];

            $fname = $rowQ['f_name'];
            $phone = $rowQ['phone'];
            $email = $rowQ['email'];
            $cnic = $rowQ['cnic'];
            $gender = $rowQ['gender'];
            $dob = $rowQ['dob'];
            $postal_address = $rowQ['postal_address'];
            $c_name = $rowQ['c_name'];
            $domicile = $rowQ['domicile'];
            $experienceInYears = $rowQ['experienceInYears'];
            $gov_employee = $rowQ['gov_employee'];
            $challan_file = $rowQ['challan_file'];
            $education_level = $rowQ['education_level'];
            $age = $rowQ['age'];
            $diff = null;
            if($rowQ['dob'] != '') {
                $bday = new DateTime($rowQ['dob']);
                $today = new DateTime(date('Y-m-d'));
                $diff = $today->diff($bday);

            }

            $quota = '';
            $eligible = '';
            array_push($cData, [
                'sno' => $count,
                'post_name' => $post_name,
                'name' => $name,
                'fatherName' => $fname,
                'contact_no' => $phone,
                'email' => $email,
                'cnic' => $cnic,
                'dob' => $dob,
                'age' => ($diff != null) ? $diff->y.' years, '.$diff->m.' months and '.$diff->d.' days' : '',
                'gender' => $gender,
                'city' => $c_name,
                'address' => $postal_address,
                'domicile' => $domicile,
                'quota' => $quota,
                'education' => $education_level,
                'total_exp' => $experienceInYears,
                'govt_emp' => $gov_employee,
                'eligible' => $eligible,
                'challan' => ($challan_file != '') ? 'Yes' : 'No'
            ]);
            ?>

        <?php }
    echo json_encode([
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $cData
    ]);

 }



// Total Apply Info Ajax
if(isset($_POST['proj_id2']) && isset($_POST['postId2']) && isset($_POST['city_id2']))
{
  $proj_id = $_POST['proj_id2'];
  $postId = $_POST['postId2'];
  $city_id = $_POST['city_id2'];
?>
<table class="table table-striped table-bordered datatable" style="font-size: 12px" data-page-length='100'>
  <thead class="bg-dark">
    <tr>
      <th>S.No</th>
      <th>Project</th>
      <th>Post</th>
      <th>City</th>
      <th class="text-center bg-info">Total Apply</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $count = 0;
  $fetchData= "SELECT c.id,pp.project_name, p.post_name, p.post_bps, c.c_name, COUNT(ca.id) AS total_apply
  FROM projects_posts AS p
  LEFT JOIN candidate_applied_post AS ca ON ca.post_id = p.id
  INNER JOIN city AS c ON c.id = ca.city_id
  INNER JOIN projects AS pp ON pp.id = p.project_id
  WHERE pp.id = '$proj_id' AND (p.id = '$postId' OR '$postId' = 'all') AND (c.id = '$city_id' OR '$city_id' = 'all') AND ca.status = 'Accepted' GROUP BY ca.city_id,ca.post_id ORDER BY pp.id DESC, c.c_name ASC";
  $runData = mysqli_query($connection,$fetchData);
  while($rowData = mysqli_fetch_array($runData)) {
    $count++;
    $city_id       = $rowData['id'];
    $c_name       = $rowData['c_name'];
    $project_name       = $rowData['project_name'];
    $post_name       = $rowData['post_name'];
    $post_bps       = $rowData['post_bps'];
    $total_apply       = $rowData['total_apply'];
  ?>
    <tr>
      <td><?php echo $count ?></td>
      <td><?php echo $project_name ?></td>
      <td><?php echo $post_name." (BPS-".$post_bps.")"; ?></td>
      <td><?php echo $c_name ?></td>
      <td class="total text-center bg-info"><?php echo $total_apply ?></td>
    </tr>
  <?php }?>
  </tbody>
  <tfoot>
    <tr class="bg-secondary text-center">
      <td colspan="4" class="text-right"><b>Total</b></td>
      <td colspan="1" id="sumTotal">0</td>
    </tr>
  </tfoot>
</table>
<?php } ?>