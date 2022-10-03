<?php
include "includes/header.php";
$cent_id = $_GET['cent_edit'];
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Test Center Edit</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Test Center Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid">
    <div class="container-fluid" class="text-center">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Test Center Sessions Form</div>
          </div>
          <br>
          <?php 
            $query ="SELECT  cs.center_id, cs.session_title, cs.reporting_date, cs.start_time, cs.end_time, cs.create_time, tc.center_name, tc.id, c.id AS c_id, c.c_name FROM center_session AS cs LEFT JOIN test_centers AS tc ON tc.id = cs.center_id
              LEFT JOIN city AS c ON c.id = tc.city_id WHERE cs.id = '$cent_id'";
            $run = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($run)) {
              $t_id = $row['id'];
              $c_id = $row['c_id'];
              $city = $row['c_name'];
              $t_center = $row['center_name'];
              $session_title = $row['session_title'];
              $reporting_date = date("Y-m-d\TH:i:s", strtotime($row['reporting_date']));
              $start_time = $row['start_time'];
              $end_time = $row['end_time'];
            }
          ?>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control select2" name="cityId" id="city" onchange="getCenter()" required>
                      <option value="<?php echo $c_id ?>"><?php echo $city ?></option>
                      <?php
                      $fetchData = "SELECT * FROM city ORDER BY c_name ASC";
                      $run1 = mysqli_query($connection,$fetchData);
                      while ($row = mysqli_fetch_array($run1)) {
                        $id = $row['id'];
                        $name = $row['c_name'];
                      ?>
                      <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Test Center</label>
                    <select class="form-control select2" id="center" name="centerId" required>
                      <option value="<?php echo $t_id ?>"> <?php echo $t_center ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Session Title</label>
                    <input type="text" class="form-control" name="session_title" placeholder="Session Title" value="<?php echo $session_title ?>" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Reporting Date & Time</label>
                    <input type="datetime-local" min="<?php echo date("Y-m-d")."T".date("H:i"); ?>" class="form-control" name="reporting_time" value="<?php echo $reporting_date ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" class="form-control" name="start_date" value="<?php echo $start_time ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>End Time</label>
                    <input type="time" class="form-control" name="end_date" placeholder="Degree Level" value="<?php echo $end_time ?>" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" class="btn btn-success shadow" value="Update" name="saveData">
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

              $insert = "UPDATE `center_session` SET `center_id`='$centerId',`session_title`='$session_title',`reporting_date`= '$reporting_time',`start_time`='$start_date',`end_time`='$end_date' WHERE id = '$cent_id'";
              $run = mysqli_query($connection,$insert);
              if($run)
              {
              echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Updated !',
              'Center Session has been updated successfully',
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
                        'Center Session not updated, Some error occure',
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
  </div>
</section>

<?php 
 include "includes/footer.php";
?>

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