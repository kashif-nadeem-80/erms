<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }
  @media print{
    .printBlock
    {
      display: none;
    }
    .printColor
    {
      background: white !important;
      color: black !important;
    }
  }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Active Projects</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Posts</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Project Title</label>
          <select class="form-control" id="proj" onchange="getPost()" name="projectId" required>
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
          <select class="form-control" onchange="getApplicantData()" name="post" id="post_id" required>
            <option value="0">First Select Project</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Applicant CNIC</label>
          <input class="form-control" id="applicantId"> </input>
          <!-- <select class="form-control" onchange="getApplicantData()" id="candStatus" required>
            <option value="Pending">Pending</option>
            <option value="Accepted">Accepted</option>
            <option value="Inquiry">Inquiry</option>
            <option value="Rejected">Rejected</option>
          </select> -->
        </div>
      </div>
      <!-- <div class="col-md-6">
         <div class="form-group">
          <label>Test City</label>
          <select class="form-control" onchange="getApplicantData()" name="city" id="city_id" required>
            <option value="0">All</option>
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
      </div> -->
    </div>
    <div class="row printBlock">
      <div class="col-md-12">
        <div class="form-group text-right">
          <button type="button" class="btn btn-info shadow" onclick="export_all()">Export To CSV</button>
          <button class="btn btn-primary shadow" onclick="printData()">Print</button>
          <button class="btn btn-danger shadow" onclick="window.location.href = 'applications_active.php'">Close</button>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData">
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
  
  function getApplicantData()
  {

    var post_id = $("#post_id").val();
    var city_id = $("#city_id").val();
    var candStatus = $("#candStatus").val();

    if(post_id != '0' && city_id != '0')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'applications_data_ajax.php',
        data: {
            postId: post_id,
            city_id: city_id,
            candStatus: candStatus
        },
        dataType: "html",
        success:function(result){
          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);
          
        }
      });
    }
    else if(post_id != '0' && city_id == '0')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'applications_data_ajax.php',
        data: {
            post_id2: post_id,
            candStatus: candStatus
        },
        dataType: "html",
        success:function(result){

          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);

        }
      });
    }
    else if(post_id == '' && city_id == '0')
    {
      $("#ajaxData").html("");
    }
  }

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
    $("#preloader").fadeOut(100);

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
  }
  });
}

function applicant_view(id){
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


<script type="text/javascript">
function export_all()
{
  // $('.dataTable').DataTable().destroy();
  $("#export_table").tableHTMLExport({
    type:'csv',
    filename:'Report_'+Math.floor((Math.random() * 10000000) + 1)+'.csv',
  });
  // $('#export_table').DataTable();
}

function printData()
{
  $('.datatable').DataTable().destroy();
  window.print();
  getApplicantData();
}
</script>