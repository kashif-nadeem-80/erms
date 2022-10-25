<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Result Uploading Section</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Upload</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" >
  <div class="container-fluid">
    <div class="card card-dark">
      <div class="card-header">
        <div class="card-title">Upload Result</div>
        <div class="card-tools">
          <a href="../../images/admin/Result Template.csv" class="btn btn-success shadow">Download Template</a>
        </div>
      </div>
      <br>
      <!-- /.card-header -->
      <div class="card-body">
        
        <form  method="POST"  enctype="multipart/form-data">
          <div class="row">
            <!-- Form Name -->
            <div class="col-md-3"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Select File</label>
                <input type="file" name="file" id="file" required class="form-control" accept=".csv" style="overflow:hidden">
              </div>
            </div>
            <!-- Button -->
            <div class="col-md-4">
              <div class="form-group mt-2">
                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading mt-4" data-loading-text="Loading...">Import</button>
              </div>
            </div>
          </div>
        </form>
        <?php
        if(isset($_POST["Import"]))
        {
          $filename=$_FILES["file"]["tmp_name"];
          if($_FILES["file"]["size"] > 0)
          {
          $file = fopen($filename, "r");
          while (($getData = fgetcsv($file)) !== FALSE)
          {
            $upload = "INSERT INTO result(`roll_no`, `written_result`)
            values ('$getData[0]','$getData[1]')";
            $result = mysqli_query($connection,$upload);
          }
          echo"
          <!DOCTYPE html>
          <html>
            <body>
              <script>
              Swal.fire(
              'Uploaded !',
              'Result has been uploaded successfully',
              'success'
              ).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'result_upload.php';
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
</section>
<?php include "includes/footer.php"; ?>