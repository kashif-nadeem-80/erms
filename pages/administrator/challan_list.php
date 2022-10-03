<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Challan's Details</h4>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan's Details</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content" >
  <div class="container-fluid" class="text-center">

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general Card elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Challan's Details</div>
            <div class="card-tools">
              <a href="challan_add.php" class="btn btn-primary btn-sm shadow">Add New Invoice</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
          <!-- Table start -->  
            <table class="table table-striped table-bordered datatable" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th>S.No</th>
                  <th>Project ID</th>
                  <th>Project Name</th>
                  <th>Test's Amount</th>
                  <th>Amount in Word</th>
                  <th>Generate Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT * FROM challan_form ORDER BY id DESC";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
                $project_id       = $rowData['project_id'];
                $project_name       = $rowData['project_name'];
                $test_amount   = $rowData['test_amount'];
                $amount_words      = $rowData['amount_words'];

                $path1U      = "../../images/admin/bank_logo/".$rowData['logo1'];
                $path2U      = "../../images/admin/bank_logo/".$rowData['logo2'];
                $path3U      = "../../images/admin/bank_logo/".$rowData['logo3'];

                $challan_date   = date("d-m-Y",strtotime($rowData['challan_date']));
              ?>
                <tr>

                  <td><?php echo $count ?></td>
                  <td><?php echo $project_id ?></td>
                  <td><?php echo $project_name ?></td>
                  <td><?php echo $test_amount ?></td>
                  <td><?php echo $amount_words ?></td>
                  <td><?php echo $challan_date ?></td>
                  <td> 
                    <a href="challan_edit.php?challan_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow" title="Edit"><span><i class="fa fa-edit"></i></span></a>
                    <a href="challan_view.php?challan_id=<?php echo $id ?>" class="btn btn-sm btn-warning shadow" title="Details"><span><i class="fa fa-eye"></i></span></a>
                    <a href="challan_list.php?deleteId=<?php echo $id ?>&path1=<?php echo $path1U ?>&path2=<?php echo $path2U ?>&path3=<?php echo $path3U ?>" class="btn btn-sm btn-danger shadow" title="Delete" onclick="return confirm('Are you sure you want to delete, the action cannot be undo !')"><span><i class="fa fa-trash-alt"></i></span></a> 
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

<?php 
  if(isset($_GET['deleteId']))
  {
      $id = $_GET['deleteId'];
      $path1 = $_GET['path1'];
      $path2 = $_GET['path2'];
      $path3 = $_GET['path3'];
      @unlink($path1);
      @unlink($path2);
      @unlink($path3);
      $delete = "DELETE FROM challan_form WHERE id = '$id'";
      $run = mysqli_query($connection,$delete);
      if($run)
      {
          echo "<!DOCTYPE html>
            <html>
              <head>
                <title>Verfied Account</title>
              </head>
              <body> 
              <script>
                swal({
                    title: 'Challan Form',
                    text: ' Successfully Delete !',
                    icon: 'success'
                  }).then((value) => {
                     window.location.href  = 'challan_list.php';
                    }).catch(swal.noop)

              </script>
              </body>
            </html>";
      }
  }
?>