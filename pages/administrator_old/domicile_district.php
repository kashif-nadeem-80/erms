<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add Domicile District</h4>
        </div><!-- /.col -->
        <div class="col-md-6">
          <ol class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Add Domicile District</li>
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
                <h4 class="text-success">Domicile District Created Successfully</h4>
                </center>
                <center id="err" style="display: none">
                <h4 class="text-danger">Domicile District Created</h4>
                </center>
                <!-- general form elements -->
                <div class="card card-dark" class="text-center">
                  <div class="card-header">
                    <div class="card-title">Domicile District Form</div>
                  </div>
                  <br>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-4">
                  <div class="form-group">
                    <label>Province Of Domicile</label>
                    <select  class="form-control" id="pro_domicile" name="pro_domicile" required>
                      <option value="">Choose</option>
                      <?php
                      $query = "SELECT * FROM province";
                      $result = mysqli_query($connection,$query);
                      while ($row = mysqli_fetch_array($result)) {
                      $pro_id = $row['id'];
                      $pro_name = $row['pro_name'];
                      echo "<option value='$pro_id'>$pro_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Zone</label>
                    <select  class="form-control"  name="zone"  required>
                      <option value="">Choose</option>
                      <?php
                      $query = "SELECT * FROM zone";
                      $result = mysqli_query($connection,$query);
                      while ($row = mysqli_fetch_array($result)) {
                      $pro_id = $row['id'];
                      $zone_name = $row['zone_name'];
                      echo "<option value='$pro_id'>$zone_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                     <div class="form-group">
                    <label>Domicile District</label>
                    <input type="text"  class="form-control"  name="dist_domicile" placeholder="Domicile District" required>
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
                      $pro_domicile = $_POST['pro_domicile'];
                      $zone = $_POST['zone'];
                      $dist_domicile = $_POST['dist_domicile'];

                      $check = "SELECT * FROM district WHERE pro_id ='$pro_domicile' AND dis_name = '$dist_domicile'";
                      $run_check = mysqli_query($connection,$check);
                      $countRow = mysqli_num_rows($run_check);
                      if($countRow == 0)
                      {
                        $insert = "INSERT INTO `district`(`pro_id`,`zone_id`,`dis_name`) VALUES ('$pro_domicile','$zone','$dist_domicile')";
                        $run = mysqli_query($connection,$insert);
                        if($run)
                        {
                        echo "<!DOCTYPE html>
                                <html>
                                  <body> 
                                  <script>
                                  Swal.fire(
                                    'Added !',
                                    'Domicile District has been added successfully',
                                    'success'
                                  ).then((result) => {
                                    if (result.isConfirmed) {
                                       window.location.href = 'domicile_district.php';
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
                                    'Domicile District not add, Some error occure',
                                    'error'
                                  ).then((result) => {
                                    if (result.isConfirmed) {
                                       window.location.href = 'domicile_district.php';
                                    }
                                  });
                                  </script>
                                  </body>
                                </html>";
                        }
                      }
                      else
                      {
                        echo "<!DOCTYPE html>
                                <html>
                                  <body> 
                                  <script>
                                  Swal.fire(
                                    'Error !',
                                    'Domicile District with this name already exist',
                                    'error'
                                  ).then((result) => {
                                    if (result.isConfirmed) {
                                      window.location.href = 'domicile_district.php';
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
                <table class="table table-striped table-bordered bg-white text-center datatable" style="font-size: 12px"  data-page-length="50">
                  <thead class="bg-dark">
                    <tr>
                      <th>S.No</th>
                      <th>Province</th>
                      <th>Zone</th>
                      <th>District</th>
                      <th>Action</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php
                    $count = 0;
                    $query2 = "SELECT p.pro_name,z.zone_name,d.id,d.dis_name FROM `district` AS d
                    INNER JOIN province AS p ON p.id = d.pro_id
                    LEFT JOIN zone AS z ON z.id =d.zone_id";
                    $runData = mysqli_query($connection,$query2);
                    while($rowData = mysqli_fetch_array($runData)) {
                    $count++;
                    $id = $rowData['id'];
                    $pro_name  = $rowData['pro_name'];
                    $zone_name  = $rowData['zone_name'];
                    $dis_name  = $rowData['dis_name'];
                    ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $pro_name;?></td>
                      <td><?php echo $zone_name;?></td>
                      <td><?php echo $dis_name;?></td>
                      <td>
                        <a href="domicile_district_edit.php?dist_id=<?php echo $id ?>" class="btn btn-sm btn-info title shadow" style="margin-top: 2px" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                        <input type="hidden" id="dom_id<?php echo $count ?>" value="<?php echo $id ?>">
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
          $delete = "DELETE FROM district WHERE id = '$id'";
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
                   window.location.href = 'domicile_district.php';
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
    var dom_id = $("#dom_id"+id).val();
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
        window.location.href= "domicile_district.php?deleteId="+dom_id;
      }
  });

  }
</script>