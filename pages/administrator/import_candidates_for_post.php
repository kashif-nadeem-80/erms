<?php
include('includes/header.php');
?>
<style type="text/css">
  .inner:hover {
opacity: 0.6;
}
</style>
<?php
if(isset($_SESSION['import_success'])) {
    echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Success !',
                'Candidates imported successfully!',
                'success'
                );
                </script>
              </body>
            </html>";
    unset($_SESSION['import_success']);
}
?>
<br>
<section class="content">
  <div class="container-fluid">
    <h2>Import Candidates</h2>
    <div class="card">
      <div class="card-body">

        <form method="post" enctype="multipart/form-data" action="import_candidates_post_action.php" onsubmit="return validateForm()">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Project Title</label>
                <select class="form-control select2" name="proj_id" id="proj" onchange="getPost()" required>
                  <option value="">Choose</option>
                  <?php
                  $fetchData = "SELECT * FROM projects WHERE status = '1' ORDER BY id DESC";
                  $run = mysqli_query($connection,$fetchData);
                  while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $name = $row['project_name'];
                  ?>
                  <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Posts</label>
                <select class="form-control select2" onchange="getApplicantData()" name="post_id" id="post_id" required>
                  <option value="0">First Select Project</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Excel File</label>
                <input type="file" required name="candidates" id="cand_file" />
              </div>
            </div>


          </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <input type="submit" class="btn btn-success" value="Upload Data">
                </div>
            </div>
        </form>


        </div>
      </div>
      <!-- card body end -->
    </div>
    <!-- card end -->
  </div>
</section>

<?php include('includes/footer.php') ?>
<script type="text/javascript">

  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'admin_ajax.php',
      data: {
          projId: projId
      },
      dataType: "html",
      success:function(result){
        $("#post_id").html(result);
      }
    }).done(function(){
      getApplicantData();
    });
  }


</script>


