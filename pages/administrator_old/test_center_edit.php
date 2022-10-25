<?php
include "includes/header.php";
$test_update = $_GET['center_edit'];
?>
<input type="hidden" value="<?php echo $test_update ?>" id="cent_id">
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
<section class="content">

  <a href="test_center.php" class="btn btn-warning shadow mb-1">Back</a>

  <div class="card">
    <div class="card-header bg-dark">
      <div class="card-title">Test Center Edit</div>
      <div class="card-tools">
      </div>
    </div>
    <div class="card-body">
      <?php
      $query = "SELECT p.id,c.id AS c_id,c.c_name,p.center_name,p.total_capacity,p.address,p.create_date FROM test_centers AS p LEFT JOIN city AS c ON c.id = p.city_id WHERE p.id = '$test_update'";
      $result = mysqli_query($connection,$query);
      $row = mysqli_fetch_array($result);
      $id         = $row['id'];
      $c_id       = $row['c_id'];
      $c_name       = $row['c_name'];
      $center_name       = $row['center_name'];
      $totalcapacity   = $row['total_capacity'];
      $address      = $row['address'];
      $create_date      = $row['create_date'];
      
      ?>
      <form method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>City</label>
              <input type="hidden" id="totalCapic" value="<?php echo $totalcapacity ?>">
              <select class="form-control select2" name="city" required>
                <option value="<?php echo $c_id ?>"><?php echo $c_name ?></option>
                <?php
                $fetchData = "SELECT * FROM city ORDER BY c_name ASC";
                $run = mysqli_query($connection,$fetchData);
                while ($row = mysqli_fetch_array($run)) {
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
              <label>Center Name</label>
              <input type="text" name="centerName" placeholder="Center Name" class="form-control"
              value="<?php echo $center_name ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="address"><?php echo $address ?></textarea>
            </div>
          </div>
          
        </div>
        <br>
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table table-striped table-bordered text-center" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th width="10%">S.No</th>
                  <th width="45%">Room Name</th>
                  <th width="30%">Capacity</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                $fetchData= "SELECT * FROM `test_center_details` WHERE test_center_id = '$test_update'";
                $runData = mysqli_query($connection,$fetchData);
                while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id = $rowData['id'];
                $room_namee = $rowData['room_name'];
                $capacityy = $rowData['capacity'];
                ?>
                <tr>
                  <td>
                    <?php echo $count ?>
                    <input type="hidden" value="<?php echo $id ?>" id="test_id<?php echo $count ?>">
                    <input type="hidden" value="<?php echo $capacityy ?>" id="capty<?php echo $count ?>">
                  </td>
                  <td><?php echo $room_namee ?></td>
                  <td class="total"><?php echo $capacityy ?></td>
                  <td>
                    <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>
                    <?php if($count != '1') { ?>
                      <a onclick="deleteData(<?php echo $count ?>)" class="btn btn-sm btn-danger title shadow text-white" title="Delete"><span><i class="fa fa-trash"></i></span></a>
                    <?php } ?>
                  </td>
                </tr>
                <?php }?>
              </tbody>
              <tfoot class="bg-secondary text-white m-0 p-0">
                <tr>
                  <td class="font-weight-bold text-right" colspan="2">Total Capacity</td>
                  <td><input type="number" name="total" placeholder="Total Capacity"
                    class="form-control text-center" value="1" readonly id="totalCap" required>
                  </td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class=" row">
          <div class="col-md-12">
            <center>
            <input type="submit" class="btn btn-success shadow" value="Update" name="UpdateCeter">
            </center>
          </div>
        </div>
      </form>
      <?php
      if(isset($_POST['UpdateCeter']))
      {
        $city        = $_POST['city'];
        $centerName  = $_POST['centerName'];
        $address  = $_POST['address'];
        $total_capacity     = $_POST['total'];
        $date       = date('Y-m-d');

        $update = "UPDATE `test_centers` SET `city_id` = '$city', `center_name` = '$centerName', `total_capacity` = '$total_capacity', `address` = '$address', `update_date` = '$date' WHERE id = '$test_update'";
        $run = mysqli_query($connection,$update);
        if($run)
        {
          echo "<!DOCTYPE html>
          <html>
            <body>
              <script>
              Swal.fire(
              'Updated !',
              'Test Center has been updated successfully',
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
              'Test Center not update, Some error occure',
              'error'
              ).then((result) => {
              if (result.isConfirmed) {
              window.location.href= 'test_center_edit.php?center_edit=$test_update';
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
</section>
<?php
  include "includes/footer.php";
?>

<?php
  if(isset($_GET['deleteId']))
  {
    $id = $_GET['deleteId'];
    $cap = $_GET['cap'];
    $center_id = $_GET['center_edit'];
    $totalCapic = $_GET['totalCapic'];
    $newTotal = $totalCapic - $cap;
    $delete = "DELETE FROM test_center_details WHERE id = '$id'";
    $run = mysqli_query($connection,$delete);
    if($run)
    {
      $update = "UPDATE test_centers SET total_capacity = '$newTotal' WHERE id = '$center_id'";
      $run2 = mysqli_query($connection,$update);
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
          window.location.href= 'test_center_edit.php?center_edit=$center_id';
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
        'Hall/Room not delete, Some error occure',
        'error'
        ).then((result) => {
        if (result.isConfirmed) {
        window.location.href= 'test_center_edit.php?center_edit=$center_id';
        }
        });
        </script>
      </body>
    </html>";
    }
  }
?>


<script type="text/javascript">
  function deleteData(id)
  {
    var test_id = $("#test_id" + id).val();
    var capty = $("#capty" + id).val();
    var cent_id = $("#cent_id").val();
    var totalCapic = $("#totalCapic").val();
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
      window.location.href = "test_center_edit.php?center_edit="+cent_id+"&totalCapic="+totalCapic+"&deleteId="+test_id+"&cap="+capty;
    }
    });
  }
  window.onload = function(){
    calculateSubTotal();
  }
  function calculateSubTotal()
  {
    var sum = 0;
    $(".total").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0)
        {
          sum += parseFloat(value);
        }
    });
    $('#totalCap').val(sum);
  }
</script>


<script type="text/javascript">
  function Data_Ajax1(id) {
    $("#preloader").fadeIn(100);
    var test_id = $("#test_id"+id).val();
    var cent_id = $("#cent_id").val();
    var totalCapic = $("#totalCapic").val();
    $.ajax({
      method: 'POST',
      url: 'test_center_ajax.php',
      data: {
        test_room_id: test_id,
        cent_id: cent_id,
        totalCapic: totalCapic
      },
      datatype: "html",
      success: function(data) {
        $(".modal_data").html(data);
        $("#preloader").fadeOut(10);
      }
    });
  }
</script>


<!-- Modal Start-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal_data">

    </div>
  </div>
</div>
<!-- Modal end -->

<?php

//////////Update status///////////
if(isset($_POST['updateRoom']))
{
  $room_id = $_POST['room_id'];
  $room2 = $_POST['room2'];
  $capNew = $_POST['capNew'];
  $capOld = $_POST['capOld'];
  $centerId = $_POST['centerId'];
  $OldtotalCap = $_POST['OldtotalCap'];
  $newTotalCap = ($OldtotalCap - $capOld) + $capNew;

  $query1 = "UPDATE `test_center_details` SET `room_name` = '$room2',`capacity` = '$capNew' WHERE id = '$room_id'";
  $result1 = mysqli_query($connection, $query1);
  if($result1)
  {
    $query2 = "UPDATE `test_centers` SET `total_capacity` = '$newTotalCap' WHERE id = '$centerId'";
    $result2 = mysqli_query($connection, $query2);
    echo "<!DOCTYPE html>
      <html>
        <body>
          <script>
          Swal.fire(
          'Updated !',
          'The selected record has been updated',
          'success'
          ).then((result) => {
          if (result.isConfirmed) {
          window.location.href= 'test_center_edit.php?center_edit=$centerId';
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
        'Hall/Room not update, Some error occure',
        'error'
        ).then((result) => {
        if (result.isConfirmed) {
        window.location.href= 'test_center_edit.php?center_edit=$centerId';
        }
        });
        </script>
      </body>
    </html>";
  }
  
}


?>