<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Projects Over/Under Age Report</h4>
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
<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <form method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Project Title</label>
            <select class="form-control select2" id="proj" onchange="getPost()" required>
              <option value="">Choose</option>
              <?php
              $fetchData = "SELECT * FROM projects ORDER BY id DESC";
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
            <select class="form-control select2" onchange="getApplicantData()" id="post_id" required>
              <option value="0">First Select Project</option>
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
        <div class="col-md-4">
           <div class="form-group">
            <label>Upto Date</label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" id="uptoDate" onchange="getApplicantData()" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
           <div class="form-group">
            <label>Age Status</label>
            <select class="form-control" onchange="getApplicantData()" id="ageStatus" required>
              <option value="Overage">Overage</option>
              <option value="Underage">Underage</option>
            </select>
          </div>
        </div>
      </div>
    </form>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive">
          <table class="table table-hover datatable bg-white" data-page-length="100" style="font-size: 11px">
            <thead class="bg-dark">
              <tr>
                <th width="6%">S.No</th>
                <th>Name</th>
                <th>Father/Guardian Name</th>
                <th>Gender</th>
                <th>CNIC No</th>
                <th>Contact No</th>
                <th>Test City</th>
                <th>Apply Date</th>
                <th>Application Status</th>
                <th>Status Details</th>
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
  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'report_overUnderAge_ajax.php',
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
  
  function getApplicantData()
  {
    let proj_id = $("#proj").val();
    let post_id = $("#post_id").val();
    let city_id = $("#city_id").val();
    let uptoDate = $("#uptoDate").val();
    let ageStatus = $("#ageStatus").val();

    if(ageStatus == 'Overage')
    {
      $("#preloader").fadeIn(100);
      
      $.ajax({
        method:'POST',
        url:'report_overUnderAge_ajax.php',
        data: {
            proj_id: proj_id,
            postId: post_id,
            city_id: city_id,
            uptoDate: uptoDate,
            Overage: ageStatus
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
    else
    {
      $("#preloader").fadeIn(100);
      $.ajax({
        method:'POST',
        url:'report_overUnderAge_ajax.php',
        data: {
            proj_id: proj_id,
            postId: post_id,
            city_id: city_id,
            uptoDate: uptoDate,
            Underage: ageStatus
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
  }
</script>

<script type="text/javascript">
function pic_view(id)
  {
    $("#preloader").fadeIn(100);

    var pic_name = $("#pic_name"+id).val();
    $.ajax({
      method:'POST',
      url:'applications_data_ajax.php',
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
function Data_Ajax1(id) {
  $("#preloader").fadeIn(100);
  var applyId = $("#applyId"+id).val();
  var autoInc = $("#autoInc"+id).val();
  $.ajax({
    method: 'POST',
    url: 'admin_ajax.php',
    data: {
      applyId_for_status: applyId,
      autoInc: autoInc
    },
    datatype: "html",
    success: function(data) {
      $(".modal_data").html(data);
      $("#preloader").fadeOut(10);
    }
  });
}

function insertData1(id)
{
  $.ajax({
    url: 'admin_ajax.php',
    type: 'POST',
    data: $('#form_submit1').serialize(),
    dataType: 'html',
    success: function(data){
    }
  }).done(function(){
    getApplicantData();
  });
}


function challan_view(id) {
  $("#preloader").fadeIn(100);
  var applyId = $("#applyId"+id).val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
      apply_id: applyId
    },
    datatype: "html",
    success:function(result){
      $(".modal_data").html(result);
      $("#preloader").fadeOut(10);
  }
  });
}

function applicant_view(id){
  $("#preloader").fadeIn(100);
  var cand_id = $("#cand_id"+id).val();
  $.ajax({
    method:'POST',
    url:'applicant_details_ajax.php',
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
    <div class="modal-content1">

    </div>
  </div>
</div>
<!-- Modal end -->

