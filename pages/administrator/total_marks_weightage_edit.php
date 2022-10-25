<?php
include "includes/header.php";
$marks_weightage_id = $_GET['marks_weightage_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Total Marks & Weightage</h4>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Total Marks & Weightage</li>
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
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Weightage Form</div>
                  </div>
                  <br>
                  <?php
                    $query2 = "SELECT p.project_name,pw.id,pw.project_id, pw.written_marks, pw.written_weightage, pw.typing_marks, pw.typing_weightage, pw.shorthand_marks, pw.shorthand_weightage FROM project_weightage AS pw LEFT JOIN projects AS p ON p.id=pw.project_id WHERE pw.id='$marks_weightage_id'";
                    $runData = mysqli_query($connection,$query2);
                    $rowData = mysqli_fetch_array($runData);
                    $project_id   = $rowData['project_id'];
                    $project_name   = $rowData['project_name'];
                    $id   = $rowData['id'];
                    $written_marks   = $rowData['written_marks'];
                    $written_weightage   = $rowData['written_weightage'];
                    $typing_marks   = $rowData['typing_marks'];
                    $typing_weightage   = $rowData['typing_weightage'];
                    $short_marks   = $rowData['shorthand_marks'];
                    $short_weightage   = $rowData['shorthand_weightage'];
                    ?>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Project</label>
                            <select name="project_id" readonly class="form-control">
                              <option value="<?php echo $project_id?>"><?php echo $project_name?></option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                  <label for="">Written Test Marks</label>
                                  <input type="text" class="form-control" placeholder="Enter Written Test Marks" name="written_marks" value="<?php echo $written_marks?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                  <label for="">Written Test Weightage</label>
                                  <input type="text" class="form-control" placeholder="Enter Written Test Weightage" name="written_weightage" value="<?php echo $written_weightage?>">
                            </div>
                          </div>
                          
                      </div>
                      <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Typing Test Marks</label>
                                  <input type="text" placeholder="Enter Typing Test Marks" class="form-control" name="typing_marks" value="<?php echo $typing_marks?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Typing Test Weightage</label>
                                  <input type="text" class="form-control" placeholder="Enter Typing Test Weightage" name="typing_weightage" value="<?php echo $typing_weightage?>">
                              </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Short-Hand Test Marks</label>
                                  <input type="text" placeholder="Enter Short-Hand Test Marks" class="form-control" name="short_marks" value="<?php echo $short_marks?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Short-Hand Test Weightage</label>
                                  <input type="text" class="form-control" placeholder="Enter Short-Hand Test Weightage" name="short_weightage" value="<?php echo $short_weightage?>">
                              </div>
                            </div>
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
                      $project_id   = $_POST['project_id'];
                      $written_marks   = $_POST['written_marks'];
                      $written_weightage   = $_POST['written_weightage'];
                      $typing_marks   = $_POST['typing_marks'];
                      $typing_weightage   = $_POST['typing_weightage'];
                      $short_marks   = $_POST['short_marks'];
                      $short_weightage   = $_POST['short_weightage'];
                      $insert = "UPDATE `project_weightage` SET `project_id`='$project_id',`written_marks`='$written_marks',`written_weightage`='$written_weightage',`typing_marks`='$typing_marks',`typing_weightage`='$typing_weightage',`shorthand_marks`='$short_marks',`shorthand_weightage`='$short_weightage' WHERE id='$marks_weightage_id'";
                      $run = mysqli_query($connection,$insert);
                      if($run)
                      {
                      echo "<!DOCTYPE html>
                            <html>
                              <body> 
                              <script>
                              Swal.fire(
                                'Updated !',
                                'Total Marks & Weightage has been updated successfully',
                                'success'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'total_marks_weightage.php';
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
                                'Total Marks & Weightage not updated, Some error occure',
                                'error'
                              ).then((result) => {
                                if (result.isConfirmed) {
                                   window.location.href = 'total_marks_weightage.php';
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

