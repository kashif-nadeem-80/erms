<?php
include "includes/header.php";
$test_update = $_GET['proj_edit'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Test Center Details</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Test Center View</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <button class="btn btn-warning shadow mb-1" onclick="window.location.href='test_center.php'">Back</button>
  <div class="card">
    <div class="card-header bg-dark">
      <div class="card-title">Test Center Details</div>
      <div class="card-tools">
      </div>
    </div>
    <div class="card-body">
      <?php
        $query = "SELECT p.id,c.c_name,p.center_name,p.total_capacity,p.address,p.create_date FROM test_centers AS p LEFT JOIN city AS c ON c.id = p.city_id WHERE p.id = '$test_update'";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_array($result);
        $id         = $row['id'];
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
              <input type="text" name="city" placeholder="City" class="form-control"
              value="<?php echo $c_name ?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Center Name</label>
              <input type="text" name="center" placeholder="Center Name" class="form-control"
              value="<?php echo $center_name ?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Total Capacity</label>
              <input type="number" name="capacity" onkeyup="capRoom()" placeholder="Capacity"
              class="form-control" id="totalCap" value="<?php echo $totalcapacity ?>" required readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" value="<?php echo $address ?>" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Create Date</label>
              <input type="date" name="address" placeholder="Address" class="form-control"
              value="<?php echo $create_date ?>" readonly>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12 table-responsive">
          <table class="table table-striped table-bordered text-center" style="font-size: 12px">
            <thead class="bg-dark">
              <tr>
                <th>S.No</th>
                <th>Room Name</th>
                <th>Capacity</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              $fetchData= "SELECT * FROM `test_center_details` WHERE test_center_id = '$test_update'";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
              $count++;
              $room_namee = $rowData['room_name'];
              $capacityy = $rowData['capacity'];
              ?>
              <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $room_namee ?></td>
                <td><?php echo $capacityy ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include "includes/footer.php";
?>