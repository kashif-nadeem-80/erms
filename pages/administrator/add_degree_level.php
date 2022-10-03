<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add Degree Level</h4>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Add Degree Level</li>
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
                <h4 class="text-success">Degree Level Create! Successfully</h4>
                </center>
                <center id="err" style="display: none">
                <h4 class="text-danger">Degree Level Not Created</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Degree Level  Form</div>
                  </div>
                  <br>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Degree Level</label>
                            <input type="text" class="form-control" name="degree_level" placeholder="Degree Level" required>
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
                      $degree_level   = $_POST['degree_level'];
                      $insert = "INSERT INTO `edu_level`(`level_name`) VALUES ('$degree_level')";
                      $run = mysqli_query($connection,$insert);
                      if($run)
                      {
                      echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Added !',
                                'Degree Level has been added successfully',
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
                                'Degree Level not add, Some error occure',
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
            
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped table-bordered bg-white text-center datatable" style="font-size: 12px">
                  <thead class="bg-dark">
                    <tr>
                      <th>S.No</th>
                      <th>Degree/Level</th>
                      <th>Action</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php
                    $count = 0;
                    $query2 = "SELECT level_name,id FROM `edu_level`";
                    $runData = mysqli_query($connection,$query2);
                    while($rowData = mysqli_fetch_array($runData)) {
                    $count++;
                    $id = $rowData['id'];
                    $level_name  = $rowData['level_name'];
                    ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $level_name;?></td>
                      <td>
                        <a href="add_degree_level_edit.php?upd_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                        <input type="hidden" id="deg_id<?php echo $count ?>" value="<?php echo $id ?>">
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
          if(isset($_GET['deletId']))
          {
          $id = $_GET['deletId'];
          $delete = "DELETE FROM edu_level WHERE id = '$id'";
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
                                   window.location.href = 'add_degree_level.php';
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
    var deg_id = $("#deg_id"+id).val();
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
        window.location.href= "add_degree_level.php?deletId="+deg_id;
      }
  });

  }
</script>