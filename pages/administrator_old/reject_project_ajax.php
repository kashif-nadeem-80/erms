      <?php
      include "includes/db.php";
      ?>
      <?php
      // Challan Emty AND challan iS fULL
      if(isset($_POST['postId']))
      {
      $postId = $_POST['postId'];
      $fetchData = "SELECT COUNT(case when cp.challan_file is not null then 1 end) AS challan,COUNT(case when cp.challan_file is null then 0 end) AS no_challan FROM candidate_applied_post AS cp
      RIGHT JOIN candidates AS c ON c.id = cp.candidate_id
      INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
      INNER JOIN projects AS p ON p.id = pp.project_id
      WHERE pp.id = '$postId' ORDER BY cp.id ASC";
      $runQ = mysqli_query($connection,$fetchData);
      $rowQ = mysqli_fetch_array($runQ);
      $challan = $rowQ['challan'];
      $no_challan = $rowQ['no_challan'];
      }


      // Education Uper AND  Lower
      if(isset($_POST['postId']) && isset($_POST['edu_level']))
      {
      $postId = $_POST['postId'];
      $edu_level = $_POST['edu_level'];
      ?>
      <?php
      $fetchData = "SELECT COUNT(DISTINCT (c.id)) AS edu FROM edu_level AS edu
      LEFT JOIN degree AS d On d.level_id =edu.id
      INNER JOIN education AS e ON e.degree_id = d.id
      RIGHT JOIN candidates AS c ON c.id = e.candi_id
      INNER JOIN candidate_applied_post AS ca ON ca.candidate_id = c.id
      INNER JOIN projects_posts AS pp ON pp.id = ca.post_id
      INNER JOIN projects AS p ON p.id = pp.project_id WHERE edu.id < '$edu_level' AND ca.post_id = '$postId'";
      
      $runQ = mysqli_query($connection,$fetchData);
      $rowQ = mysqli_fetch_array($runQ);
      $mini_edu = $rowQ['edu'];

      $fetchData_edu = "SELECT COUNT(DISTINCT (c.id)) AS edu FROM edu_level AS edu
      LEFT JOIN degree AS d On d.level_id = edu.id
      INNER JOIN education AS e ON e.degree_id = d.id
      RIGHT JOIN candidates AS c ON c.id = e.candi_id
      INNER JOIN candidate_applied_post AS ca ON ca.candidate_id = c.id
      INNER JOIN projects_posts AS pp ON pp.id = ca.post_id
      INNER JOIN projects AS p ON p.id = pp.project_id WHERE edu.id >= '$edu_level' AND ca.post_id = '$postId'";
      $runQ_edu = mysqli_query($connection,$fetchData_edu);
      $rowQ_edu = mysqli_fetch_array($runQ_edu);
      $max_edu = $rowQ_edu['edu'];
      }
      // Lower AND uPPER Age
      if(isset($_POST['postId']) && isset($_POST['uptoDate']))
      {
      $postId = $_POST['postId'];
      $uptoDate = $_POST['uptoDate'];
      ?>
      <table class="table table-hover bg-white" data-page-length="100" style="font-size: 11px">
        <thead class="bg-dark">
          <tr>
            <th>Challan</th>
            <th>Wthout Challan</th>
            <th>Minimum Education Total</th>
            <th>Maximum Education Total</th>
            <th>Under Age Total</th>
            <th>Eligible Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $fetchData1 = "SELECT COUNT(pp.id) AS total FROM candidate_applied_post AS cp
          INNER JOIN candidates AS c ON c.id = cp.candidate_id
          INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
          INNER JOIN projects AS p ON p.id = pp.project_id
          WHERE  pp.age_lower BETWEEN (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3))  and pp.age_lower AND cp.post_id = '$postId'";
          $runQ1 = mysqli_query($connection,$fetchData1);
          $rowQ1 = mysqli_fetch_array($runQ1);
          $lower_age = $rowQ1['total'];

          $fetchData = "SELECT COUNT(pp.id) AS max_total FROM candidate_applied_post AS cp
          INNER JOIN candidates AS c ON c.id = cp.candidate_id
          INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
          INNER JOIN projects AS p ON p.id = pp.project_id
          WHERE pp.age_lower < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) AND cp.post_id = '$postId'";
          $runQ = mysqli_query($connection,$fetchData);
          $rowQ = mysqli_fetch_array($runQ);
          $max_age = $rowQ['max_total'];
          ?>
          <tr>
            <td><?php echo $challan ?></td>
            <td><?php echo $no_challan ?></td>
            <td><?php echo $mini_edu ?></td>
            <td><?php echo $max_edu ?></td>
            <td><?php echo $lower_age ?></td>
            <td><?php echo $max_age ?></td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-12">
          <center>
          <input type="submit" class="btn btn-danger shadow" value="Reject" name="Update_All">
          </center>
        </div>
      </div>
      <?php }
      ?>