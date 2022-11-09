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
        <h4 class="m-0 text-dark">Candidates Result</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Result</li>
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
          <select class="form-control" onchange="getApplicantData()" name="post" id="post_id" required>
            <option value="">First Select Project</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>District</label>
          <select class="form-control" id="dis_Id" onchange="getApplicantData()" required>
            <option value="all">All</option>
            <?php
            $fetchData = "SELECT * FROM district ORDER BY dis_name ASC";
            $run = mysqli_query($connection,$fetchData);
            while ($row = mysqli_fetch_array($run)) {
              $id = $row['id'];
              $name = $row['dis_name'];
            ?>
            <option value="<?php echo $id ?>"><?php echo $name ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Gender</label>
          <select class="form-control" id="gendr" onchange="getApplicantData()" required>
            <option value="all">Both</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Order By</label>
          <select class="form-control" id="order_by" onchange="getApplicantData()" required>
            <option value="Aggregate">Aggregate</option>
            <option value="Marks">Written Test Marks</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row printBlock">
      <div class="col-md-12">
        <div class="form-group text-right">
          <button type="button" class="btn btn-info shadow" onclick="export_all()">Export To CSV</button>
          <button class="btn btn-primary shadow" onclick="printData()">Print</button>
          <button class="btn btn-danger shadow" onclick="window.location.href = 'result.php'">Close</button>
        </div>
      </div>
    </div>

    <hr class="shadow">

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
      url:'result_ajax.php',
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
    let dis_Id = $("#dis_Id").val();
    let gendr = $("#gendr").val();
    let order_by = $("#order_by").val();

    if(proj_id != '' && post_id != '')
    {
      $("#preloader").fadeIn(100);
      
      $.ajax({
        method:'POST',
        url:'result_ajax.php',
        data: {
            proj_id: proj_id,
            postId: post_id,
            disId: dis_Id,
            gender: gendr,
            order_by: order_by
        },
        dataType: "html",
        success:function(result){
          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);
        }
      });
    }
  }
</script>

<script type="text/javascript">
function export_all()
{
  $('.dataTable').DataTable().destroy();
  $("#export_table").tableHTMLExport({
    type:'csv',
    filename:'Report_'+Math.floor((Math.random() * 10000000) + 1)+'.csv',
  });
  $('#export_table').DataTable();
}

function printData()
{
  $('#export_table').removeClass("table-responsive");
  $('.datatable').DataTable().destroy();
  $('#export_table').DataTable().destroy();
  window.print();
  getApplicantData();
}
</script>