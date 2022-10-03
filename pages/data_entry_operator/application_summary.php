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
        <h4 class="m-0 text-primary">Application Summarize Report</h4>
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
            <select class="form-control" readonly id="proj" onchange="getApplicantData()" required>
              <option value="<?php echo $idG ?>"><?php echo $projectG ?></option>
            </select>
          </div>
        </div>
      </div>
    </form>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive">
          <table class="table table-hover table-bordered datatable bg-white" data-page-length="100">
            <thead class="bg-dark">
              <tr>
                <th width="6%" class="text-center">S.No</th>
                <th>Post</th>
                <th class="text-center">Total Applications Submitted</th>
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

    $("#preloader").fadeIn(100);
    $.ajax({
      method:'POST',
      url:'report_summarize_ajax.php',
      data: {
          proj_id: proj_id
      },
      dataType: "html",
      success:function(result){
        $("#ajaxData").html(result);
        $(".datatable").DataTable();
      }
    }).done(function(){
      $("#preloader").fadeOut(10);
      calculateTotal();
    });
  }

  function calculateTotal() {
    var sum = 0;
    //iterate through each td based on class and add the values
    $(".totalApp").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumtotal').text(sum);
  }
</script>