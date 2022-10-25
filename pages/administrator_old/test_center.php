<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add New Test Center</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Test Center</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <a href="dashboard.php" class="btn btn-warning shadow mb-1">Back</a>
          </div>
        </div>
        <div class="card card-dark">
          <div class="card-header">
            <div class="card-title">Add New</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Test City</label>
                    <select class="form-control select2" name="city" required>
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
                    <label>Center Name</label>
                    <textarea name="center" id="centerName" placeholder="Center Name" onkeyup="check_centerName()" required class="form-control"></textarea>
                    <p id="true" style="display: none; color: red"><b>This center name already
                    exist</b></p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" placeholder="Address" class="form-control"
                    required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-bordered bg-white" id="item_table"
                    style="font-size:12px; ">
                    <thead class="bg-secondary text-white">
                      <tr style="text-align: center;">
                        <th width="50%">Room/Hall Name</th>
                        <th width="40%">Capacity of Room/Hall</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <input type="text" name="room[]" placeholder="Room/Hall Name"
                          class="form-control" required>
                          <input type="hidden" name="row[]" value="1">
                        </td>
                        <td>
                          <input type="number" name="capacity[]" placeholder="Capacity Per Room" class="form-control" onkeyup="getTotalCap(1)" id="capacity1" value="1" required>
                        </td>
                        <td><button type="button" name="add"
                          class="btn btn-success btn-sm add"><i
                          class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot class="bg-secondary text-white m-0 p-0">
                      <tr>
                        <td class="font-weight-bold text-right">Total Capacity</td>
                        <td><input type="number" name="total" placeholder="Total Capacity"
                          class="form-control" value="1" readonly id="totalCap" required>
                        </td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <center>
                  <input type="submit" id="savebtn" class="btn btn-success shadow" value="Add" name="saveData">
                  </center>
                </div>
              </div>
            </form>
            <?php
            if(isset($_POST['saveData']))
            {
              $city  = $_POST['city'];
              $center  = $_POST['center'];
              $address  = $_POST['address'];
              $total_capacity     = $_POST['total'];
              $date       = date('Y-m-d');
              $insert = "INSERT INTO `test_centers`(`city_id`, `center_name`, `total_capacity`,`address`, `create_date`) VALUES ('$city','$center','$total_capacity','$address','$date')";
              $run = mysqli_query($connection,$insert);
              $centerId = mysqli_insert_id($connection);
              $count=count($_POST['row']);
              for ($i=0; $i<$count; $i++)
              {
                $room = $_POST['room'][$i];
                $capacity = $_POST['capacity'][$i];
                $qury = "INSERT INTO `test_center_details`(`test_center_id`, `room_name`, `capacity`) VALUES ('$centerId','$room','$capacity')";
                $run = mysqli_query($connection,$qury);
              }
              if($run)
              {
                echo "<!DOCTYPE html>
                <html>
                  <body>
                    <script>
                    Swal.fire(
                    'Added !',
                    'Test Center has been added successfully',
                    'success'
                    ).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'test_center.php';
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
                    'Test Center not add, Some error occure',
                    'error'
                    ).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = 'test_center.php';
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
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered datatable text-center" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th>S.No</th>
                  <th>City</th>
                  <th>Test Center</th>
                  <th>Total Capacity</th>
                  <th>Address</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                $fetchData= "SELECT p.id,c.c_name,p.center_name,p.total_capacity,p.address,p.create_date FROM test_centers AS p LEFT JOIN city AS c ON c.id = p.city_id ORDER BY p.id DESC";
                $runData = mysqli_query($connection,$fetchData);
                while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
                $c_name       = $rowData['c_name'];
                $center_name       = $rowData['center_name'];
                $totalcapacity   = $rowData['total_capacity'];
                $address      = $rowData['address'];
                $create_date   = date("d-m-Y",strtotime($rowData['create_date']));
                ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $center_name ?></td>
                  <td><?php echo $c_name ?></td>
                  <td><?php echo $totalcapacity ?></td>
                  <td><?php echo $address ?></td>
                  <td><?php echo $create_date ?></td>
                  <td>
                    <a href="test_center_edit.php?center_edit=<?php echo $id ?>"
                      class="btn btn-sm btn-info shadow title" title="Edit"><span><i
                      class="fa fa-edit"></i></span></a>
                      <input type="hidden" id="test_id<?php echo $count ?>" value="<?php echo $id ?>">
                      <a href="test_center_details.php?proj_edit=<?php echo $id ?>" class="btn btn-sm btn-warning shadow title" title="View"><span><i
                        class="fa fa-eye"></i></span></a>
                      <a onclick="deleteData(<?php echo $count ?>)" class="btn btn-sm btn-danger title shadow text-white" title="Delete"><span><i
                          class="fa fa-trash"></i></span></a>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
</section>
<?php
  include "includes/footer.php";
  include "test_center_row.php";
?>
<?php
  if(isset($_GET['deleteId']))
  {
    $id = $_GET['deleteId'];
    $delete = "DELETE FROM test_centers WHERE id = '$id'";
    $run = mysqli_query($connection,$delete);
    if($run)
    {
      $delete = "DELETE FROM test_center_details WHERE test_center_id = '$id'";
      $run = mysqli_query($connection,$delete);
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
          window.location.href= 'test_center.php';
          }
          });
          </script>
        </body>
      </html>";
    }
  }
?>
      <script>
      function check_centerName() {
      var check = $('#centerName').val();
      $.ajax({
      url: 'admin_ajax.php',
      type: 'post',
      data: {
      check_center: check
      },
      success: function(response) {
      if (response != '0') {
        document.getElementById('true').style.display = 'block';
        $("#savebtn").attr("disabled","disabled");
      }
      else
      {
        document.getElementById('true').style.display = 'none';
        $("#savebtn").removeAttr("disabled");
      }
      }
      });
      }
      function deleteData(id) {
      var test_id = $("#test_id" + id).val();
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
      window.location.href = "test_center.php?deleteId=" + test_id;
      }
      });
      }
      function getTotalCap() {
      var cap_total = 0;
      $("input[name='row[]']").each(function() {
      var total_amount_input = "#capacity" + $(this).val();
      cap_total += parseInt($(total_amount_input).val());
      });
      $('#totalCap').val(cap_total);
      }
      </script>