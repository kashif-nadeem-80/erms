<?php
include "includes/header.php";
$pro_id = $_GET['pro_id'];
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Domicile Edit</h4>
        <div class="row">
          <div class="col-md-12">
            <a href="domicile_province.php" class="btn btn-warning shadow mt-3">Back</a>
          </div>
        </div>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Domicile Zone</li>
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
        <center id="succ" style="display: none">
          <h4 class="text-success">Domicile Edited Successfully</h4>
        </center>
        <center id="err" style="display: none">
          <h4 class="text-danger">Domicile Not Edited</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Domicile Form</div>
            <div class="card-tools">
              <a href="project_list.php" class="btn btn-primary btn-sm shadow">Domicile Details</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <?php
            $query = "SELECT * FROM province WHERE id = '$pro_id'";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
                $pro_name = $row['pro_name'];
                $id = $row['id'];
          ?>
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Domicile Province</label>
                    <input type="text" class="form-control" name="province" value="<?php echo $pro_name; ?>">
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
              $province_n   = $_POST['province'];

              $insert = "UPDATE `province` SET `pro_name`='$province_n' WHERE id = '$pro_id';";
              $run = mysqli_query($connection,$insert);
              if($run) 
                {
                  echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Updated !',
                                'Domicile Province has been updated successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'domicile_province.php';
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
                                'Domicile Province not updated, Some error occure',
                                'error'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'domicile_province.php';
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
  </div>
</section>

<?php include "includes/footer.php"; ?>