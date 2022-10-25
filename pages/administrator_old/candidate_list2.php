<?php
include "includes/header.php";
?>
<style type="text/css">
  @media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    .printBlock
    {
      display: none;
    }
    .printColor
    {
      color: black !important;
      background: white !important;
    }
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Project Wise Candidate's List</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="d-none d-print-block">
      <div class="row m-0">
        <div class="col-md-2 text-center">
          <a class="navbar-brand" href="https://uts.com.pk">
            <img src="../../images/logo.png" alt="logo" width="90" height="85">
          </a>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5 text-center mt-4">
          <h3 style="color: #00008B">Universal Testing Services</h3>
          <h5 class="text-danger">Candidate's List</h5 class="text-danger">
        </div>
      </div>
    </div>
    <hr class="shadow mt-0">
    <form method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Project Title</label>
            <select class="form-control" id="proj" onchange="getCenter()"required name="projId">
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
        <div class="col-md-5">
          <div class="form-group">
            <label>City</label>
            <select class="form-control" name="cityId" id="city" onchange="getCenter()" required>
              <option value="">Choose</option>
              <?php
                $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";
                $result = mysqli_query($connection,$query);
                while ($row = mysqli_fetch_array($result))
                {
                  $id = $row['id'];
                  $c_name = $row['c_name'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $c_name ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Center</label>
            <select class="form-control" onchange="get_test_sesion()" id="center" name="centerId" required>
              <option value="">First Select City</option>
            </select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Session</label>
            <select class="form-control" onchange="getData()" id="sesion" name="sesionId" required>
              <option value="">First Select Post & Center</option>
            </select>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive"></div>
      </div>
    </div>
  </div>
  <div class="row printBlock">
    <div class="col-md-12">
      <div class="form-group text-center">
        <button class="btn btn-info shadow" onclick="dataPrint()">Print</button>
      </div>
    </div>
  </div>
</section>


<?php
  include "includes/footer.php";
?>

<script type="text/javascript">

function getCenter()
{
  var city = $("#city").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        city: city
    },
    dataType: "html",
    success:function(result){
      $("#center").html(result);
    }
  }).done(function(){
    get_test_sesion();
  });
}



function get_test_sesion()
{
  var center = $("#center").val();
  var post = $("#post").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        center: center,
        post_id: post
    },
    dataType: "html",
    success:function(result){
      $("#sesion").html(result);
    }
  }).done(function(){
    getData();
  });
}


function getData()
{
  var sesion = $("#sesion").val();
  var proj = $("#proj").val();
  if(sesion != '')
  {
    $.ajax({
      method:'POST',
      url:'candidate_list_ajax.php',
      data: {
          proj: proj,
          sesion2 : sesion
      },
      dataType: "html",
      success:function(result){
        $("#ajaxData").html(result);
        $(".datatable").DataTable();
      }
    });
  }
  else
  {
    $("#ajaxData").html("");
  }
}


function dataPrint()
{
  window.print();
}

</script>
