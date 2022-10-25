<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Test Center Sessions</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Test Center Sessions</li>
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
        <h4 class="text-success">Test Center Sessions Added! Successfully</h4>
        </center>
        <center id="err" style="display: none">
        <h4 class="text-danger">Test Center Sessions Not Added</h4>
        </center>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Test Center Sessions Form</div>
          </div>
          <br>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Test City</label>
                    <select class="form-control select2" name="cityId" id="city" onchange="getCenter()" required>
                      <option value="">Choose</option>
                      <?php
                      $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";
                        $result = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $c_name = $row['c_name'];
                        echo "<option value='$id'>$c_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Test Center</label>
                    <select class="form-control select2" id="center" name="centerId" required>
                      <option value="">First Select City</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Session Title</label>
                    <input type="text" class="form-control" name="session_title" placeholder="Session Title" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Reporting Date & Time</label>
                    <input type="datetime-local" min="<?php echo date("Y-m-d")."T".date("H:i"); ?>" class="form-control" name="reporting_time" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" class="form-control" name="start_date" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>End Time</label>
                    <input type="time" class="form-control" name="end_date" placeholder="Degree Level" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" class="btn btn-success shadow" value="Add" name="saveData">
                  </center>
                </div>
              </div>
            </form>
            <?php
            if(isset($_POST['saveData']))
            {
              $centerId   = $_POST['centerId'];
              $session_title = $_POST['session_title'];
              $reporting_time = $_POST['reporting_time'];
              $start_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];

              $insert = "INSERT INTO `center_session`(`center_id`, `session_title`, `reporting_date`, `start_time`, `end_time`) VALUES ('$centerId','$session_title','$reporting_time','$start_date','$end_date')";
              $run = mysqli_query($connection,$insert);
              if($run)
              {
              echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Added !',
                        'Center Session has been added successfully',
                        'success'
                      ).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href= 'center_sessions.php';
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
                        'Center Session not add, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'center_sessions.php';
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
              <th>City</th>
              <th>Center</th>
              <th>Session Title</th>
              <th>Reporting Date & Time</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Action</th>
            </tr>
            
          </thead>
          <tbody>
            <?php
            $count = 0;
            $query2 = "SELECT cs.id, c.c_name, tc.center_name, cs.session_title, cs.reporting_date,cs.start_time, cs.end_time FROM center_session AS cs INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN city AS c ON c.id = tc.city_id ORDER BY cs.id DESC";
            $runData = mysqli_query($connection,$query2);
            while($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $id  = $rowData['id'];
            $c_name  = $rowData['c_name'];
            $center_name = $rowData['center_name'];
            $session_title = $rowData['session_title'];
            $reporting_date = date('d-m-Y h:i a', strtotime($rowData['reporting_date']));
            $start_time = date('h:i a', strtotime($rowData['start_time']));
            $end_time = date('h:i a', strtotime($rowData['end_time']));
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $c_name; ?></td>
              <td><?php echo $center_name; ?></td>
              <td><?php echo $session_title; ?></td>
              <td><?php echo $reporting_date; ?></td>
              <td><?php echo $start_time; ?></td>
              <td><?php echo $end_time; ?></td>
              <td>

                <a href="center_sessions_edit.php?cent_edit=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                <input type="hidden" id="cent_id<?php echo $count ?>" value="<?php echo $id ?>">
                <a onclick="deleteData(<?php echo $count ?>)" class="btn btn-sm btn-danger title shadow text-white" title="Delete" onclick="return confirm('Are you sure you want to delete, the action cannot be undo !')"><span><i class="fa fa-trash"></i></span></a>
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
    $delete = "DELETE FROM center_session WHERE id = '$id'";
    $run = mysqli_query($connection,$delete);
    if($run)
    {
      echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Delete !',
              'The selected record has been deleted',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href= 'center_sessions.php';
              }
            });
            </script>
            </body>
          </html>";
    }
  }
  ?>
<?php include "includes/footer.php"; ?>


<script type="text/javascript">
function getCenter()
{
  var city = $("#city").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        city: city
    },
    dataType: "html",
    success:function(result){
      $("#center").html(result);
    }
  }).done(function(){
  });
}

 function deleteData(id)
  {
    var cent_id = $("#cent_id"+id).val();
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
      window.location.href= "center_sessions.php?deleteId="+cent_id;
    }
});
  }
</script>