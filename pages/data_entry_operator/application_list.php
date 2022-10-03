<?php
include "includes/header.php";

  $fetchDataG= "SELECT p.project_name, p.id FROM project_to_operator AS o INNER JOIN projects_posts AS pp ON pp.id = o.post_id INNER JOIN projects AS p ON p.id = pp.project_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
  $runDataG = mysqli_query($connection,$fetchDataG);
  $rowDataG = mysqli_fetch_array($runDataG);
  $idG         = $rowDataG['id'];
  $projectG    = $rowDataG['project_name'];
?>
<style>
  .modal { overflow: auto !important; }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-primary">Application Report</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Report</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <form method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Project Title</label>
            <select class="form-control" readonly id="proj" onchange="getPost()" required>
              <option value="<?php echo $idG ?>"><?php echo $projectG ?></option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control" onchange="getApplicantData()" name="post" id="post_id" required>
              <?php
              $fetch = "SELECT p.id, p.post_name, p.post_bps FROM project_to_operator AS o INNER JOIN projects_posts AS p ON p.id = o.post_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
              $run = mysqli_query($connection,$fetch);
              while ($row = mysqli_fetch_array($run))
              {
                $postId = $row['id'];
                $postname = $row['post_name'];
                $postbps = $row['post_bps'];
                echo "<option value='$postId'>$postname BPS($postbps)</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
           <div class="form-group">
            <label>City</label>
            <select class="form-control select2" onchange="getApplicantData()" id="city_id" required>
              <option value="all">All</option>
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
      </div>
    </form>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive">
          <table class="table table-hover table-bordered datatable bg-white" data-page-length="100" style="font-size: 11px">
            <thead class="bg-dark">
              <tr>
                <th width="6%">S.No</th>
                <th>Name</th>
                <th>Father/Guardian Name</th>
                <th>Gender</th>
                <th>CNIC NO</th>
                <th>Contact No</th>
                <th>Test City</th>
                <th>Apply Date</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  include "includes/footer.php";
?>

<script type="text/javascript">
  window.onload = function()
  {
    getApplicantData();
  }

  function getApplicantData()
  {
    let proj_id = $("#proj").val();
    let post_id = $("#post_id").val();
    let city_id = $("#city_id").val();

    $("#preloader").fadeIn(10);
    $.ajax({
      method:'POST',
      url:'report_ajax.php',
      data: {
          proj_id: proj_id,
          postId: post_id,
          city_id: city_id
      },
      dataType: "html",
      success:function(result){
        $("#ajaxData").html(result);
        $(".datatable").DataTable();
      }
    }).done(function(){
      $("#preloader").fadeOut(10);
    });
  }
</script>

<script type="text/javascript">
function pic_view(id)
{
  $("#preloader").fadeIn(100);
  var pic_name = $("#pic_name"+id).val();
  $.ajax({
    method:'POST',
    url:'report_ajax.php',
    data: {
      pic_name: pic_name
    },
    datatype: "html",
    success:function(result){

      $(".image_view").html(result);
  $("#preloader").fadeOut(10);

  }
  });
}

</script>

<!--Pic View Modal Start-->
<div class="modal fade" id="image_view" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width:450px" role="document">
    <div class="modal-content image_view">

    </div>
  </div>
</div>
<!-- Modal end -->

<script type="text/javascript">

function applicant_view(id){
  $("#preloader").fadeIn(100);
  var cand_id = $("#cand_id"+id).val();
  $.ajax({
    method:'POST',
    url:'report_ajax.php',
    data: {
      applicant_id: cand_id
    },
    datatype: "html",
    success:function(result){
      $(".info_appl").html(result);
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


<!-- Modal Start-->
<div class="modal fade" id="info_appl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-100 w-75" role="document" >
    <div class="modal-content info_appl" >

    </div>
  </div>
</div>
<!-- Modal end -->

<!-- Modal Start-->
<div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog bg-white" style="border: blue 2px solid; border-radius: 8px" role="document">
    <div class="modal-content modal-content1">

    </div>
  </div>
</div>
<!-- Modal end -->

