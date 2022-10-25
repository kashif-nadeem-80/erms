<?php
include "includes/header.php";
$dist_id = $_GET['dist_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Domicile District Edit</h4>
        <div class="row">
          <div class="col-md-12">
            <a href="domicile_district.php" class="btn btn-warning shadow mt-3">Back</a>
          </div>
        </div>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Domicile District</li>
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
                <h4 class="text-success">Domicile District Edited Successfully</h4>
                </center>
                <center id="err" style="display: none">
                <h4 class="text-danger">Domicile District Not Edited</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Domicile District Form</div>
                    <div class="card-tools">
                      <a href="project_list.php" class="btn btn-primary btn-sm shadow">Domicile District Details</a>
                    </div>
                  </div>
                  <br>
                  <!-- /.card-header -->
                  <?php
                  $query = "SELECT d.id AS did, d.dis_name, p.id AS p_id, p.pro_name, z.id AS z_id, z.zone_name FROM district AS d
                  LEFT JOIN province AS p ON p.id = d.pro_id
                  LEFT JOIN zone AS z ON z.id = d.zone_id WHERE d.id = '$dist_id'";
                  $result = mysqli_query($connection,$query);
                  while ($row = mysqli_fetch_array($result)) {
                    $dis_id = $row['did'];
                    $dis_name = $row['dis_name'];
                    $pro_id = $row['p_id'];
                    $pro_name = $row['pro_name'];
                    $z_id = $row['z_id'];
                    $zone_name = $row['zone_name'];
                  }
                  ?>
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Province</label>
                            <select name="province" class="form-control">
                              <option value="<?php echo $pro_id; ?>"><?php echo $pro_name; ?></option>
                              <?php
                                $query = "SELECT * FROM province";
                                $result = mysqli_query($connection,$query);
                                while ($row = mysqli_fetch_array($result)) {
                                $pro_id = $row['id'];
                                $pro_name = $row['pro_name'];
                                echo "<option value='$pro_id'>$pro_name</option>";
                                }
                              ?>

                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Zone</label>
                            <select name="zone" class="form-control">
                              <option value="<?php echo $z_id; ?>"><?php echo $zone_name; ?></option>
                              <?php
                                $query = "SELECT * FROM zone";
                                $result = mysqli_query($connection,$query);
                                while ($row = mysqli_fetch_array($result)) {
                                $pro_id = $row['id'];
                                $zone_name = $row['zone_name'];
                                echo "<option value='$pro_id'>$zone_name</option>";
                                }
                               ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">District</label>
                            <input type="text" class="form-control" name="district_n" value="<?php echo $dis_name; ?>">
                              
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
                       $province_n   = $_POST['province'];
                       $zone_n   = $_POST['zone'];
                       $district_n   = $_POST['district_n'];
                      
                      $insert = "UPDATE `district` SET `pro_id`='$province_n',`zone_id`='$zone_n', `dis_name`='$district_n'  WHERE id = '$dist_id';";
                      $run = mysqli_query($connection,$insert);
                      if($run)
                      {
                      echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Updated !',
                                'Domicile District has been updated successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'domicile_district.php';
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
                                'Domicile District not add, Some error occure',
                                'error'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'domicile_district.php';
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