<?php
include "includes/header.php";
$zone_id = $_GET['zone_id'];
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Zone Edit</h4>
         <a href="zone.php" class="mt-4 btn btn-warning shadow">Back</a>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Edit Zone</li>
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
          <h4 class="text-success">Zone Edited Successfully</h4>
        </center>
        <center id="err" style="display: none">
          <h4 class="text-danger">Zone Not Edited</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Zone Form</div>
            <div class="card-tools">
              <a href="project_list.php" class="btn btn-primary btn-sm shadow">Zone Details</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <?php
            $query = "SELECT * FROM zone WHERE id = '$zone_id'";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
                $zone_name = $row['zone_name'];
                $id = $row['id'];
          ?>
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Zone</label>
                    <input type="text" class="form-control" name="zone" value="<?php echo $zone_name; ?>">
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
              $zone   = $_POST['zone'];

              $insert = "UPDATE `zone` SET `zone_name`='$zone' WHERE id = '$zone_id';";
              $run = mysqli_query($connection,$insert);
              if($run) 
                {
                  echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Updated !',
                                'Zone has been updated successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'zone.php';
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
                                'Zone not updated, Some error occure',
                                'error'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'zone.php';
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