<?php
include "includes/header.php";
$upd_id = $_GET['upd_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Degree Level Edit</h4>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Degree Level Edit</li>
          </ol>
          </div><!-- /.col -->

          </div><!-- /.row -->
          <div class="col-md-12">
            <a href="add_degree_level.php" class="btn btn-warning shadow mb-1">Back</a>
          </div>
          </div><!-- /.container-fluid -->
        </div>
        <section class="content" >
          <div class="container-fluid" class="text-center">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Degree Level  Form</div>
                  </div>
                  <br>
                  <?php 
                    $query = "SELECT * FROM edu_level WHERE id = '$upd_id'";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      $level_name = $row['level_name'];
                    }
                  ?>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Degree Level</label>
                            <input type="text" class="form-control" name="degree_level" placeholder="Degree Level" value="<?php echo $level_name ?>" required>
                          </div>
                        </div>
                        <div class="col-md-3"></div>
                      </div>
                      <br>
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
                      $degree_level   = $_POST['degree_level'];
                      $insert = "UPDATE `edu_level` SET `level_name`='$degree_level' WHERE id = '$upd_id'";
                      $run = mysqli_query($connection,$insert);
                      if($run)
                      {
                      echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Updated !',
                                'Degree Level has been updated successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'add_degree_level.php';
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
                                'Degree Level not updated, Some error occure',
                                'error'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'add_degree_level.php';
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
            

          
<?php include "includes/footer.php"; ?>