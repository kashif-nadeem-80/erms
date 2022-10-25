<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Completed Project's Details</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Completed Project's Details</li>
        </ol>
      </div>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general Card elements -->
        <div class="card card-dark">
          <div class="card-header">
            <div class="card-title">Completed Project's Details</div>
            <div class="card-tools">
              <a href="project_add.php" class="btn btn-primary btn-sm shadow">Add New</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
          <!-- Table start -->  
            <table class="table table-striped table-bordered datatable" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th width="5%">S.No</th>
                  <th width="10%">Organization</th>
                  <th width="30%">Project Title</th>
                  <th width="10%">Project ID</th>
                  <th width="10%">Start Date</th>
                  <th width="10%">Last Date</th>
                  <th width="10%">Status</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT * FROM projects WHERE status = '0' ORDER BY id DESC";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
                $project_id       = $rowData['project_id'];
                $project_name       = $rowData['project_name'];
                
                if($rowData['status'] == '1')
                {
                  $status   = "Active";
                }
                else
                {
                  $status   = "Completed";
                }
                $organization      = $rowData['organization'];

                $start_date   = date("d-m-Y",strtotime($rowData['start_date']));
                $last_date   = date("d-m-Y",strtotime($rowData['last_date']));
              ?>
                <tr>

                  <td><?php echo $count ?></td>
                  <td><?php echo $organization ?></td>
                  <td><?php echo $project_name ?></td>
                  <td><?php echo $project_id ?></td>
                  
                  <td><?php echo $start_date ?></td>
                  <td><?php echo $last_date ?></td>
                  <td><?php echo $status ?></td>
                  <td>
                    <a onclick="activeProject(<?php echo $id ?>)" class="btn btn-sm btn-success title shadow" style="margin-top: 2px" title="Active"><span><i class="fa fa-check"></i></span></a>
                    <a href="project_view.php?proj_id=<?php echo $id ?>" class="btn btn-sm btn-warning title shadow" style="margin-top: 2px" title="Details"><span><i class="fa fa-eye"></i></span></a>
                   </td>
                </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
      </div>
    <!-- Col-12 -->
    </div>
    <!-- row -->
  </div>
</section>


 <?php include "includes/footer.php"; ?>

 <script type="text/javascript">
function activeProject(id) {
    var p_id = id;
    Swal.fire({
        title: 'Are you sure?',
        text: "To active the selected record !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, active it!'
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "project_list_inactive.php?disId=" + p_id;
        }
    });
}
</script>

<?php 
  if(isset($_GET['disId']))
  {
      $id = $_GET['disId'];

      $update = "UPDATE projects SET status = '1' WHERE id = '$id'";
      $run = mysqli_query($connection,$update);
      
      if($run)
      {
        echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Active !',
              'The selected record has been active',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href= 'project_list_inactive.php';
              }
            });
            </script>
            </body>
          </html>";
      }
  }
?>