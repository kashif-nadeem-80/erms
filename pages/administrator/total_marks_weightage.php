<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Total Marks & Weightage</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Total Marks & Weightage</li>
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
            <div class="card-title">Weightage Form</div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Project</label>
                    <select name="prject_id" class="form-control">
                      <option value="">Select Project</option>
                      <?php
                      $query = "SELECT * FROM projects";
                      $result=mysqli_query($connection,$query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                      $id = $row['id'];
                      $project_name = $row['project_name'];
                      echo "<option value='$id'>$project_name</option>";
                      }
                      
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Written Test Marks</label>
                    <input type="number" step="any" class="form-control" placeholder="Enter Written Test Marks" name="written_marks">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Written Test Weightage</label>
                    <input type="number" step="any" class="form-control" placeholder="Enter Written Test Weightage" name="written_weightage">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Typing Test Marks</label>
                    <input type="number" step="any" placeholder="Enter Typing Test Marks" class="form-control" name="typing_marks">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Typing Test Weightage</label>
                    <input type="number" step="any" class="form-control" placeholder="Enter Typing Test Weightage" name="typing_weightage">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Short-Hand Test Marks</label>
                    <input type="number" step="any" placeholder="Enter Short-Hand Test Marks" class="form-control" name="short_marks">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Short-Hand Test Weightage</label>
                    <input type="number" step="any" class="form-control" placeholder="Enter Short-Hand Test Weightage" name="short_weightage">
                  </div>
                </div>
              </div>
              <br>
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
              $prject_id   = $_POST['prject_id'];
              // Check Project
              $fetch = "SELECT * FROM project_weightage WHERE project_id = '$prject_id'";
              $runData = mysqli_query($connection,$fetch);
              echo $countRow = mysqli_num_rows($runData);
              if($countRow > 0)
              {
                echo "<!DOCTYPE html>
                <html>
                  <body>
                    <script>
                    Swal.fire(
                    'Error !',
                    'Total Marks & Weightage of the selected project already exist',
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
              else
              {
                $written_marks   = $_POST['written_marks'];
                $written_weightage   = $_POST['written_weightage'];
                $typing_marks   = $_POST['typing_marks'];
                $typing_weightage   = $_POST['typing_weightage'];
                $short_marks   = $_POST['short_marks'];
                $short_weightage   = $_POST['short_weightage'];
                $insert = "INSERT INTO `project_weightage`(`project_id`, `written_marks`, `written_weightage`, `typing_marks`, `typing_weightage`, `shorthand_marks`, `shorthand_weightage`) VALUES ('$prject_id','$written_marks','$written_weightage','$typing_marks','$typing_weightage','$short_marks','$short_weightage')";
                $run = mysqli_query($connection,$insert);
                if($run)
                {
                echo "<!DOCTYPE html>
                <html>
                  <body>
                    <script>
                    Swal.fire(
                    'Added !',
                    'Total Marks & Weightage has been added successfully',
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
                    'Total Marks & Weightage not add, Some error occure',
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
              <th>Project Name</th>
              <th>Written Test Marks</th>
              <th>Written Test Weightage</th>
              <th>Typing Test Marks</th>
              <th>Typing Test Weightage</th>
              <th>Short-Hand Test Marks</th>
              <th>Short-Hand Test Weightage</th>
              <th>Action</th>
            </tr>
            
          </thead>
          <tbody>
            <?php
            $count = 0;
            $query2 = "SELECT p.project_name,pw.id,pw.project_id, pw.written_marks, pw.written_weightage, pw.typing_marks, pw.typing_weightage, pw.shorthand_marks, pw.shorthand_weightage FROM project_weightage AS pw LEFT JOIN projects AS p ON p.id=pw.project_id ORDER BY pw.id DESC";
            $runData = mysqli_query($connection,$query2);
            while($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $project_name   = $rowData['project_name'];
            $id   = $rowData['id'];
            $written_marks   = $rowData['written_marks'];
            $written_weightage   = $rowData['written_weightage'];
            $typing_marks   = $rowData['typing_marks'];
            $typing_weightage   = $rowData['typing_weightage'];
            $short_marks   = $rowData['shorthand_marks'];
            $short_weightage   = $rowData['shorthand_weightage'];
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $project_name; ?></td>
              <td><?php echo $written_marks; ?></td>
              <td><?php echo $written_weightage; ?></td>
              <td><?php echo $typing_marks; ?></td>
              <td><?php echo $typing_weightage; ?></td>
              <td><?php echo $short_marks; ?></td>
              <td><?php echo $short_weightage; ?></td>
              <td>
                <a href="total_marks_weightage_edit.php?marks_weightage_id=<?php echo $id ?>" class="btn btn-sm btn-info title shadow" style="margin-top: 2px" title="Edit"><span><i class="fa fa-edit"></i></span></a>
                <input type="hidden" id="marks_weightage_id<?php echo $count ?>" value="<?php echo $id ?>">
                <a class="btn btn-sm btn-danger shadow text-white" title="Delete"
                  onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
                </td>
              </tr>
              <?php
              }
              ?>
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
  $delete = "DELETE FROM project_weightage WHERE id = '$id'";
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
      window.location.href = 'total_marks_weightage.php';
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
  var marks_weightage_id = $("#marks_weightage_id"+id).val();
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
  window.location.href= "total_marks_weightage.php?deleteId="+marks_weightage_id;
  }
  });
  }
  </script>