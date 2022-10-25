<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add City & Test City</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Add City & Test City</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" >
  <div class="container-fluid" class="text-center">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">City & Test City Form</div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>City & Test City</label>
                    <input type="text" name="test_city" placeholder="City/Test City's Name" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" name="status">
                    <label>Test Center Status</label>
                    <select class="form-control" name="status">
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" class="btn btn-success shadow" value="Add" name="saveUser">
                  </center>
                </div>
              </div>
            </form>
            <?php
            if(isset($_POST['saveUser']))
            {
            $test_city = $_POST['test_city'];
            $status = $_POST['status'];
            $check = "SELECT * FROM city WHERE c_name = '$test_city'";
            $run_check = mysqli_query($connection,$check);
            $countRow = mysqli_num_rows($run_check);
            if($countRow == 0 OR $countRow == '0')
            {
            $insert = "INSERT INTO `city`(`c_name`, `test_center_status`) VALUES ('$test_city', '$status')";
            $run = mysqli_query($connection,$insert);
            if($run)
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Added !',
                'City / Test City has been added successfully',
                'success'
                ).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'test_city.php';
                }
                });
                </script>
              </body>
            </html>";
            }
            else
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Error !',
                'City / Test City not add, Some error occure',
                'error'
                ).then((result) => {
                if (result.isConfirmed) {
                window.location.href = 'test_city.php';
                }
                });
                </script>
              </body>
            </html>";
            }
          }
            else{
                        echo "<!DOCTYPE html>
                                <html>
                                  <body> 
                                  <script>
                                  Swal.fire(
                                    'Error !',
                                    'City / Test City with this name already exist',
                                    'error'
                                  ).then((result) => {
                                    if (result.isConfirmed) {
                                      window.location.href = 'test_city.php';
                                    }
                                  });
                                  </script>
                                  </body>
                                </html>";
                      }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-bordered bg-white text-center datatable" style="font-size: 12px" data-page-length="50">
          <thead class="bg-dark">
            <tr>
              <th>S.No</th>
              <th>City / Test City</th>
              <th>Test City Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $count = 0;
              $query2 = "SELECT c_name,id,test_center_status FROM `city`";
              $runData = mysqli_query($connection,$query2);
              while($rowData = mysqli_fetch_array($runData)) {
              $count++;
              $id = $rowData['id'];
              $c_name  = $rowData['c_name'];
              if($rowData['test_center_status'] == '0')
              {
                $test_center_status  = "Inactive";
              }
              else
              {
                $test_center_status  = "Active";
              }
              
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $c_name;?></td>
              <td><?php echo $test_center_status;?></td>
              <td>
                <a href="test_city_edit.php?c_id=<?php echo $id ?>" class="btn btn-sm btn-info title shadow" style="margin-top: 2px" title="Edit"><span><i class="fa fa-edit"></i></span></a>
                <input type="hidden" id="test_id<?php echo $count ?>" value="<?php echo $id ?>">
                <a class="btn btn-sm btn-danger shadow text-white" title="Delete"
                  onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
  <?php
  if(isset($_GET['deleteId']))
  {
  $id = $_GET['deleteId'];
  $delete = "DELETE FROM city WHERE id = '$id'";
  $run = mysqli_query($connection,$delete);
  if($run)
  {
  echo "<!DOCTYPE html>
  <html>
    <body>
      <script>
      Swal.fire(
      'Deleted !',
      'The selected record has been deleted',
      'success'
      ).then((result) => {
      if (result.isConfirmed) {
      window.location.href = 'test_city.php';
      }
      });
      </script>
    </body>
  </html>";
  }
  }
  ?>
  <?php include "includes/footer.php"; ?>
  <script>
  function deleteData(id)
  {
  var test_id = $("#test_id"+id).val();
  Swal.fire({
  title: 'Are you sure?',
  text: "To delete the selected record !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
  if (result.isConfirmed) {
  window.location.href= "test_city.php?deleteId="+test_id;
  }
  });
  }
  </script>