<?php
include "includes/header.php";
$deg_id = $_GET['deg_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Edit Degree/Certificate</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Edit Degree Certificate</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="col-md-12">
            <a href="add_degree.php" class="btn btn-warning shadow mb-1">Back</a>
          </div>
</div>
<section class="content" >
  <div class="container-fluid" class="text-center">
    <div class="row">
      <div class="col-md-12">
        <center id="succ" style="display: none">
        <h4 class="text-success">Degree Certificate Create! Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">Degree Certificate Not Created</h4>
        </center>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Degree Certificate Form</div>
          </div>
          <br>
          <?php
            $query = "SELECT d.id, d.deg_name, ed.id AS e_id, ed.level_name FROM degree AS d
            LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE d.id = '$deg_id'";
            $result = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($result)) {
              $id = $row['id'];
              $e_id = $row['e_id'];
              $deg_name = $row['deg_name'];
              $level_name = $row['level_name'];
            }
          ?>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Degree Level</label>
                    <select class="form-control select2" name="degree_level" required>
                      <option value='<?php echo $e_id?>'> <?php echo $level_name ?></option>;
                      <?php
                      $fetchData = "SELECT * FROM edu_level";
                      $run = mysqli_query($connection,$fetchData);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['id'];
                      $level_namee = $row['level_name'];
                       ?>
                      <option value='<?php echo $id ?>'> <?php echo $level_namee ?></option>
                    <?php 
                     }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Degree/Certificate</label>
                    <input type="text" class="form-control" name="degree_certif" placeholder="Degree Level" value="<?php echo $deg_name ?>" required>
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
             $degree_level   = $_POST['degree_level'];
             $degree_c = $_POST['degree_certif'];
             $insert = "UPDATE degree SET `level_id`='$degree_level',`deg_name`='$degree_c' WHERE id = '$deg_id'";

              $run = mysqli_query($connection,$insert);
              if($run)
              {
              echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Updated !',
                        'Degree/Certificate has been updated successfully',
                        'success'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'add_degree.php';
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
                        'Degree/Certificate not updated, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'add_degree.php';
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