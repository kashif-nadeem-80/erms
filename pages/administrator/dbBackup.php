<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Database Backup</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Backup</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" >
  <div class="container-fluid">
    <div class="card card-dark">
      <div class="card-header">
        <div class="card-title">Databases</div>
      </div>
      <br>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 text-right">
            <a href="db_export.php" class="btn btn-primary shadow">Take Backup</a>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped datatable">
              <thead style="background: black;color: white">
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Date & Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $serial = 0;
                $backup = "SELECT * FROM backup ORDER BY id DESC";
                $run_backup = mysqli_query($connection,$backup);
                while ($row_backup = mysqli_fetch_array($run_backup))
                {
                $serial++;
                $dbName = $row_backup['name'];
                $dbId = $row_backup['id'];
                $dbDate = $row_backup['backup_date'];
                ?>
                <tr>
                  <td><?php echo $serial ?></td>
                  <td><a href="dbBackup/<?php echo $dbName ?>"> <?php echo $dbName ?></a></td>
                  <td><?php echo date('d-m-Y h:i:s a', strtotime($dbDate)); ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include "includes/footer.php"; ?>