<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add Degree/Certificate</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Add Degree Certificate</li>
        </ol>
      </div>
    </div>
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
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Degree Level</label>
                    <select class="form-control select2" name="degree_level" required>
                      <option value="">Choose</option>
                      <?php
                      $fetchData = "SELECT * FROM edu_level";
                      $run = mysqli_query($connection,$fetchData);
                      while ($row = mysqli_fetch_array($run)) {
                      $id = $row['id'];
                      $level_name = $row['level_name'];
                      echo "<option value='$id'>$level_name</option>";
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Degree/Certificate</label>
                    <input type="text" class="form-control" name="degree_certif" placeholder="Degree Level" required>
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
            $degree_c = $_POST['degree_certif'];
            $insert = "INSERT INTO `degree`(`level_id`,`deg_name`) VALUES ('$degree_level','$degree_c')";
            $run = mysqli_query($connection,$insert);
            if($run)
            {
            echo "<!DOCTYPE html>
                  <html>
                    <body> 
                    <script>
                    Swal.fire(
                      'Added !',
                      'Degree/Certificate has been added successfully',
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
                      'Degree/Certificate not add, Some error occure',
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
    
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-bordered bg-white text-center datatable" style="font-size: 12px">
          <thead class="bg-dark">
            <tr>
              <th>S.No</th>
              <th>Degree/Level</th>
              <th>Degree/Certificate</th>
              <th>Action</th>
            </tr>
            
          </thead>
          <tbody>
            <?php
            $count = 0;
            $query2 = "SELECT d.id, d.deg_name, ed.level_name FROM `degree` AS d
            LEFT JOIN edu_level as ed ON ed.id = d.level_id";
            $runData = mysqli_query($connection,$query2);
            while($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $id = $rowData['id'];
            $level_name  = $rowData['level_name'];
            $deg_name = $rowData['deg_name'];
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $level_name;?></td>
              <td><?php echo $deg_name;?></td>
              <td>
                <a href="add_degree_edit.php?deg_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

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
  if(isset($_GET['deleteId']))
  {
    $id = $_GET['deleteId'];
    $delete = "DELETE FROM degree WHERE id = '$id'";
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
                   window.location.href = 'add_degree.php';
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
        window.location.href= "add_degree.php?deleteId="+deg_id;
      }
  });

  }
</script>