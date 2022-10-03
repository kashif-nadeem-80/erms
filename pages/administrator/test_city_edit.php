<?php
include "includes/header.php";
$ct_id = $_GET['c_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Test City Edit</h4>
        <div class="row">
          <div class="col-md-12">
            <a href="test_city.php" class="btn btn-warning shadow mt-3">Back</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Test City Edit</li>
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
        <center id="succ" style="display: none">
        <h4 class="text-success">Test City Update Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">Test City Not Updated</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Test City Form</div>
          </div>
          <br>
          <!-- /.card-header -->
          <?php
          $query = "SELECT * FROM city WHERE id = '$ct_id'";
          $result = mysqli_query($connection,$query);
          $row = mysqli_fetch_array($result);
          $c_id = $row['id'];
          $c_name = $row['c_name'];
          $status = $row['test_center_status'];
          ?>
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Test City</label>
                    <input type="text" class="form-control" name="test_city" placeholder="Zone" value="<?php echo $c_name; ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" name="status">
                    <label>Test Center Status</label>
                    <select class="form-control" name="status">
                      <option <?php if($status == '0') { echo "selected"; } ?> value="0">Inactive</option>
                      <option <?php if($status == '1') { echo "selected"; } ?> value="1">Active</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" class="btn btn-success shadow" value="Update" name="saveUser">
                  </center>
                </div>
              </div>
            </form>
            <?php
            if(isset($_POST['saveUser']))
            {
            $test_city   = $_POST['test_city'];
            $status   = $_POST['status'];
            
            $insert = "UPDATE city SET c_name = '$test_city', test_center_status = '$status' WHERE id= '$ct_id' ";
            $run = mysqli_query($connection,$insert);
            if($run)
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Updated !',
                'Test City has been updated successfully',
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
                'Test City not updated, Some error occure',
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
  </section>
</div>
<?php include "includes/footer.php"; ?>