<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Assigned Center</h4>
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
            <div class="card-title">Test Centers Details</div>
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
                  <th>City</th>
                  <th>Test Center Name</th>
                  <th>Session</th>
                  <th class="text-center bg-info">Total Capacity</th>
                  <th class="bg-success text-center">Assigned Capacity</th>
                  <th class="bg-danger text-center">Un-Assigned Capacity</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT DISTINCT(cs.id), cs.session_title, c.c_name, tc.center_name, tc.total_capacity, a.assigned_capacity FROM center_session AS cs LEFT JOIN test_centers AS tc ON tc.id = cs.center_id LEFT JOIN assigned_center_capacity_temp AS a ON a.session_id = cs.id INNER JOIN city AS c ON c.id = tc.city_id ORDER BY c.c_name";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $c_name         = $rowData['c_name'];
                $center_name    = $rowData['center_name'];
                $session_title    = $rowData['session_title'];
                $capacity       = $rowData['total_capacity'];
                
                if($rowData['assigned_capacity'] == '')
                {
                  $assigned   = 0;
                }
                else
                {
                  $assigned   = $rowData['assigned_capacity'];
                }
                $unassign = $capacity-$assigned;
              ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $c_name ?></td>
                  <td><?php echo $center_name ?></td>
                  <td><?php echo $session_title ?></td>
                  <td class="total text-center bg-info"><?php echo $capacity ?></td>
                  <td class="assign bg-success text-center"><?php echo $assigned ?></td>
                  <td class="unassign bg-danger text-center"><?php echo $unassign ?></td>
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