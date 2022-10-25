<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Center To Candidates</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Assigned Center</li>
        </ol>
      </div>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Center To Candidates</div>
            <div class="card-tools">
              <a href="assign_test_center.php" class="btn btn-primary btn-sm shadow">Assign New</a>
            </div>
          </div>
          <br>
          <div class="card-body table-responsive">
            <table class="table table-striped table-bordered datatable" style="font-size: 12px" data-page-length='100'>
              <thead class="bg-dark">
                <tr>
                  <th>S.No</th>
                  <th>Project</th>
                  <th>Post</th>
                  <th>City</th>
                  <th class="text-center bg-info">Total Apply</th>
                  <th class="text-center bg-success">Center Assigned for Applicants</th>
                  <th class="text-center bg-danger">Center Not Assigned for Applicants</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT c.id, p.id AS postId, pp.project_name, p.post_name, p.post_bps, c.c_name, COUNT(ca.id) AS total_apply FROM projects_posts AS p LEFT JOIN candidate_applied_post AS ca ON ca.post_id = p.id INNER JOIN city AS c ON c.id = ca.city_id INNER JOIN projects AS pp ON pp.id = p.project_id WHERE ca.status = 'Accepted' GROUP BY ca.city_id,ca.post_id ORDER BY pp.id DESC, c.c_name ASC";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $postId       = $rowData['postId'];
                $city_id       = $rowData['id'];
                $c_name       = $rowData['c_name'];
                $post_name       = $rowData['post_name'];
                $project_name       = $rowData['project_name'];
                $post_bps       = $rowData['post_bps'];
                $total_apply       = $rowData['total_apply'];

                $fetchData1 = "SELECT SUM(a.assigned_candidate) AS assign FROM assigned_center_to_cand_temp AS a WHERE a.city_id = '$city_id' AND a.post_id = '$postId'";
                $runData1 = mysqli_query($connection,$fetchData1);
                $runCount = mysqli_num_rows($runData1);
                $rowData1 = mysqli_fetch_array($runData1);
                
                if($rowData1['assign'] == '')
                {
                  $assigned = 0;
                }
                else
                {
                  $assigned = $rowData1['assign'];
                }
                
                $unassign = $total_apply-$assigned;
              ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $project_name ?></td>
                  <td><?php echo $post_name." (BPS-".$post_bps.")"; ?></td>
                  <td><?php echo $c_name ?></td>
                  <td class="total text-center bg-info"><?php echo $total_apply ?></td>
                  <td class="assign text-center bg-success"><?php echo $assigned ?></td>
                  <td class="unassign text-center bg-danger"><?php echo $unassign ?></td>
                </tr>
              <?php }?>
              </tbody>
              <tfoot>
                <tr class="bg-secondary text-center">
                  <td colspan="4" class="text-right"><b>Total</b></td>
                  <td id="sumTotal">0</td>
                  <td id="sumAssign"></td>
                  <td id="sumUnassign"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>


<script type="text/javascript">
  window.onload = function(){
    calculateSubTotal();
  }
  function calculateSubTotal()
  {
    var sum = 0;
    $(".total").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0)
        {
          sum += parseFloat(value);
        }
    });
    $('#sumTotal').text(sum);

    var sum = 0;
    $(".assign").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0)
        {
          sum += parseFloat(value);
        }
    });
    $('#sumAssign').text(sum);

    var sum = 0;
    $(".unassign").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0)
        {
          sum += parseFloat(value);
        }
    });
    $('#sumUnassign').text(sum);
  }
</script>